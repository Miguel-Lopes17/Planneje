<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    include 'conexao.php';
    include 'alert.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nome = $_POST["nome"] ?? '';
        $email = $_POST["email"] ?? '';
        $telefone = $_POST["telefone"] ?? '';
        $cpf = $_POST["cpf"] ?? '';
        $senha = $_POST['senha'] ?? '';
        $confirmarSenha = $_POST['confirmarSenha'] ?? '';


        $dominio = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($dominio, "MX")) {
            die("Domínio de e-mail inválido!");
        }

        if ($senha !== $confirmarSenha) {
            die("As senhas não coincidem!");
        }

        try {
            $stmt = $con->prepare("SELECT CliEmail, CliCpf FROM tblCliente WHERE CliEmail = ? OR CliCpf = ?");
            $stmt->execute([$email, $cpf]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                if ($result['CliEmail'] === $email) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            title: 'Email já Cadastrado!',
                            icon: 'error',
                            showConfirmButton: true,
                            timer: 1800,
                            timerProgressBar: true
                        }).then(() => {
                            window.history.back();
                        });
                    </script>";
                    exit;
                } elseif ($result['CliCpf'] === $cpf) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            title: 'CPF ja Cadastrado!',
                            icon: 'error',
                            showConfirmButton: true,
                            timer: 1800,
                            timerProgressBar: true
                        }).then(() => {
                            window.history.back();
                        });
                    </script>";
                    exit;
                }
            }


            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $con->prepare("
                INSERT INTO hubsap45_bd_unktravel.tblCliente (CliNome, CliEmail, CliTelefone, CliCpf, CliSenha)VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $telefone);
            $stmt->bindParam(4, $cpf);
            $stmt->bindParam(5, $senhaHash);

            if ($stmt->execute()) {
                $_SESSION['email'] = $email;
                include 'usrdados.php';
                header("Location: ../../view/inicio.php");
                "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            title: 'Plano Criado com Sucesso!',
                            icon: 'success',
                            showConfirmButton: true,
                            timer: 1800,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.href = '../../view/inicio.php';
                        });
                    </script>";
                exit;
            } else {
                echo "Erro ao efetivar cadastro.";
            }

        } catch (PDOException $erro) {
            echo "Erro no banco de dados: " . $erro->getMessage();
        }

    }
?>