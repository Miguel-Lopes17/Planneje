<?php

session_start();
error_log("DEBUG: Email recebido - " . ($_POST['email'] ?? 'Nenhum'));
error_log("DEBUG: Ação - " . ($_POST['entrar'] ?? 'Nenhuma'));

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmarSenha'] ?? '';
$entrar = $_POST['entrar'] ?? '';

include 'conexao.php';

// Validações iniciais
if (empty($email) || empty($senha) || empty($confirmarSenha)) {
    $_SESSION['erro'] = "Todos os campos são obrigatórios!";
    error_log("DEBUG: Campos vazios - redirecionando para login");
    header("Location: ../../view/login.php");
    exit();
}

if ($senha != $confirmarSenha) {
    $_SESSION['erro'] = "As senhas não coincidem!";
    error_log("DEBUG: Senhas não coincidem - redirecionando para login");
    header("Location: ../../view/login.php");
    exit();
}

try {
    $stmt = $con->prepare("SELECT * FROM tblCliente WHERE CliEmail = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("DEBUG: Usuário encontrado: " . ($usuario ? 'Sim' : 'Não'));

    if ($usuario) {
        error_log("DEBUG: Senha no banco: " . $usuario['CliSenha']);
        
        // Verifica se a senha está hasheada ou em texto puro
        if (strlen($usuario['CliSenha']) < 60) {
            error_log("DEBUG: Verificando senha em texto puro");
            $loginValido = ($senha === $usuario['CliSenha']);
        } else {
            error_log("DEBUG: Verificando senha hasheada");
            $loginValido = password_verify($senha, $usuario['CliSenha']);
        }
        
        if ($loginValido) {
            error_log("DEBUG: Login bem-sucedido");
            $_SESSION['usuario'] = [
                'id' => $usuario['idCliente'],
                'email' => $usuario['CliEmail'],
                'nome' => $usuario['CliNome']
            ];
            
            header("Location: ../../view/inicio.php");
            exit();
        } else {
            error_log("DEBUG: Senha incorreta");
            $_SESSION['erro'] = "Email ou senha incorretos!";
            header("Location: ../../view/login.php");
            exit();
        }
        
    } else {
        error_log("DEBUG: Usuário não encontrado");
        $_SESSION['erro'] = "Email ou senha incorretos!";
        header("Location: ../../view/login.php");
        exit();
    }
    
} catch (PDOException $e) {
    error_log("DEBUG: Erro PDO: " . $e->getMessage());
    $_SESSION['erro'] = "Erro no sistema: " . $e->getMessage();
    header("Location: ../../view/login.php");
    exit();
}

?>