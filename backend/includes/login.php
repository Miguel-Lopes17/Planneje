<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include 'conexao.php';
    include 'alert.php';
    
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
                echo " <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script> Swal.fire({
                title: 'Login bem-sucedido!',
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href='../../view/inicio.php';
            });</script>";
                exit;
            } else {
                echo " <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script> Swal.fire({
                title: 'Email ou Senha incorreto!',
                icon: 'error',
                confirmButtonText: 'Ok',
                timer: 1500,
                showConfirmButton: false
            }).then(() => { setTimeout(() => {window.history.back();}, 1300);
            }); </script>";
                exit;
            }

        } else {
            //echo "<script> mostrarAlert('Preencha todos os campos.');setTimeout(() => {window.history.back();}, 1500);</script>";
            exit;
        }

    }
?>
