<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include 'conexao.php';

    $destino = $_POST['destination'] ?? '';
    $data = $_POST['date'] ?? '';
    $descricao = $_POST['description'] ?? '';
    $funcao = $_POST['funcao'] ?? null;

    function idUsuario($con) {
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $stmt = $con->prepare("SELECT IdCliente FROM tblCliente WHERE CliEmail = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['IdCliente'] : null;
        }
        return null;
    }

    function adicionarPlano($con) {
        global $destino, $data, $descricao;

        $idCliente = idUsuario($con);
        if ($idCliente == null) {
            echo "
                <script>
                    alert('Usuário não autenticado!');
                    window.location.href = '../../view/login.php';
                </script>";
            exit;
        }

        try {
            $con->beginTransaction();

            $stmt = $con->prepare("
                INSERT INTO tblPlano (plaDestino, plaData, plaDescricao)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$destino, $data, $descricao]);

            $idPlano = $con->lastInsertId();


            $stmt2 = $con->prepare("
                INSERT INTO `tblDetCliente-Plano` (idCliente, idPlano)
                VALUES (?, ?)
            ");
            $stmt2->execute([$idCliente, $idPlano]);

            $con->commit();

            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        title: 'Plano Criado com Sucesso!',
                        icon: 'success',
                        showConfirmButton: true,
                        timer: 1800,
                        timerProgressBar: true
                    }).then(() => {
                        window.location.href = '../../view/plans.php';
                    });
                </script>";
            exit;
        } catch (Exception $e) {
            $con->rollBack();
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        title: 'Erro ao criar plano!',
                        text: '". addslashes($e->getMessage()) ."',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then(() => {window.history.back();});
                </script>";
            exit;
        }
    }

    function excluirPlano($con) {
        $idPlano = $_POST['idPlano'] ?? null;

        if (!$idPlano) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'ID do plano não informado']);
            exit;
        }

        $idCliente = idUsuario($con);
        if ($idCliente == null) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
            exit;
        }

        try {
            $con->beginTransaction();

            $stmt1 = $con->prepare("DELETE FROM `tblDetCliente-Plano` WHERE idCliente = ? AND idPlano = ?");
            $stmt1->execute([$idCliente, $idPlano]);


            $stmt2 = $con->prepare("DELETE FROM tblPlano WHERE idPlano = ?");
            $stmt2->execute([$idPlano]);

            $con->commit();

            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Plano excluído com sucesso!']);
        } catch (Exception $e) {
            $con->rollBack();
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao excluir o plano: ' . $e->getMessage()]);
        }
        exit;
    }


    $funcoesPermitidas = ['adicionarPlano','editarPlano','excluirPlano'];
    if ($funcao && in_array($funcao, $funcoesPermitidas)) {
        $funcao($con);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Função inválida']);
    }
?>
