<?php 
    session_start();
    // print_r($_REQUEST); //Traz as informações do login
    if(isset($_POST['submit']) && !empty($_POST['email']) &&!empty($_POST['senha']) ){
        
    
       //Caso a senha exista ele acessa
    include 'conexao.php';
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // print_r('Email: '.$email);
        // print_r('<br>');
        // print_r('Senha: '.$senha);

        $sql = "SELECT * FROM tblCliente WHERE CliEmail = '$email' AND cliSenha = '$senha' ";
        $result = $conexao -> query($sql);
        
        // print_r($sql);
        // print_r($result);

    if(mysqli_num_rows($result) <1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);

        $user = $result->fetch_assoc();
        $_SESSION['email'] = $user['usrEmail'];
        $_SESSION['login_message'] = [
            'type' => 'error',
            'title' => 'E-mail ou senha incorretos. ',
            'text' => 'Tente Novamente!.'
        ];
        $nomeCompleto = $user['usrNome'];
        $primeiroNome = explode(" ", $nomeCompleto)[0];
        $_SESSION['nome'] = $primeiroNome;
        
        header('Location: login.php');

        // header('Location: login.php');
    }else {
        
        $user = $result->fetch_assoc();
        $_SESSION['email'] = $user['usrEmail'];
        $_SESSION['login_message'] = [
            'type' => 'success',
            'title' => 'Login Bem-Sucedido',
            'text' => 'Você acessou sua conta.'
        ];
        $nomeCompleto = $user['usrNome'];
        $primeiroNome = explode(" ", $nomeCompleto)[0];
        $_SESSION['nome'] = $primeiroNome;
        
        header('Location: inicio.php');
    }
    
    }
    
?>




