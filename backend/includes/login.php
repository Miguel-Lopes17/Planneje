<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    include 'conexao.php';

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';


        if (!empty($email) && !empty($senha)) {

            $stmt = $con->prepare("SELECT CliSenha FROM tblCliente WHERE CliEmail = ?");
            $stmt->bindParam(1, $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($senha, $result['CliSenha'])) {
                $_SESSION['email'] = $email;
                include 'usrdados.php';
                echo
                "<script>
                    window.location.href='../../view/inicio.php';
                </script>";
                exit;
            } else {
                echo "
                <script>
                    window.history.back();
                </script>";
                exit;
            }

        } else {
            echo "<script>
                window.history.back();
            </script>";
            exit;
        }

    }
?>
