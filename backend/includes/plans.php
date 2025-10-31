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

            $id = idUsuario($con);

            if ($id != null) {

                $stmt = $con->prepare("
                    INSERT INTO tblPlano (plaDestino, plaData, plaDescricao, plaIdCliente) 
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->bindParam(1, $destino);
                $stmt->bindParam(2, $data);
                $stmt->bindParam(3, $descricao);
                $stmt->bindParam(4, $id);

                if ($stmt->execute()) {
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
                } else {
                    echo "
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                        <script>
                            Swal.fire({
                                title: 'Erro ao criar plano!',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            }).then(() => {window.history.back();});
                        </script>";
                    exit;
                }
            }else {
                echo "
                    <script>
                        alert('Usuário não autenticado!')
                        window.location.href = '../../view/login.php';
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

        $idUsuario = idUsuario($con);
        if ($idUsuario == null) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
            exit;
        }

        $stmt = $con->prepare("DELETE FROM tblPlano WHERE idPlano = ? AND plaIdCliente = ?");
        if ($stmt->execute([$idPlano, $idUsuario])) {
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Plano excluído com sucesso!']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao excluir o plano.']);
        }
        exit;
}


    

    $funcoesPermitidas = ['adicionarPlano','editarPlano', 'excluirPlano'];
    if ($funcao && in_array($funcao, $funcoesPermitidas)) {
        $funcao($con);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Função inválida']);
    }
?>