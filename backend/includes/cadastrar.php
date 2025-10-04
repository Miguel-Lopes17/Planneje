<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $cpf = $_POST["cpf"];
        $senha = $_POST["senha"];
        $confirmarSenha = $_POST["confirmarSenha"];
        include 'conexao.php';

        if ($senha == $confirmarSenha) {
            try {
            $stmt = $con->prepare("INSERT INTO hubsap45_bd_unktravel.tblCliente (CliNome, CliEmail, CliTelefone, CliCpf, CliSenha) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $telefone);
            $stmt->bindParam(4, $cpf);
            $stmt->bindParam(5, $senha);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                header("location: ../../view/inicio.php");
                } else {
                echo "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            } catch (PDOException $erro) {
                echo "Erro: ". $erro->getMessage();
            }
        }else {
            echo "As senhas não coincidem.";
        }
    }    
?>