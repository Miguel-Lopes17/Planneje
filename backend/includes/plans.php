<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'conexao.php';
include 'alert.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destino = $_POST['destination'] ?? '';
    $data = $_POST['date'] ?? '';
    $descricao = $_POST['description'] ?? '';

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $stmt = $con->prepare("SELECT IdCliente FROM tblCliente WHERE CliEmail = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $id = $result['IdCliente'];

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
        } else {
            echo "<script> mostrarAlert('Usuário não encontrado.');setTimeout(() => {window.history.back();}, 1500);</script>";
            exit;
        }
    } else {
        echo "<script> mostrarAlert('Usuário não autenticado.');setTimeout(() => {window.location.href='../../view/login.php';}, 1500);</script>";
        exit;
    }
}
?>