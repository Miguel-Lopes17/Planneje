<?php
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];
    $entrar = $_POST['entrar'];
    include 'conexao.php';

    if($senha == $confirmarSenha) {
        $stmt = $con->prepare("SELECT * FROM tblCliente WHERE CliEmail = ? AND CLiSenha = ?");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $senha);
        $stmt->execute();
    }else {
        echo "As senhas não coincidem";
    }

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "Login bem-sucedido!";
    } else {
        echo "Email ou senha incorretos.";
    }

    $stmt->close();
    $mysqli->close();

    
?>