<?php 
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    include 'conexao.php';

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $stmt = $con->prepare("SELECT * FROM tblCliente WHERE CliEmail = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            echo "Usuário não encontrado.";
        }
    }

?>