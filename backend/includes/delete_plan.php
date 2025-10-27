<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $planId = $_POST['planId'] ?? '';
    
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        
        // Verificar se o plano pertence ao usuário
        $stmt = $con->prepare("
            SELECT p.IdPlano 
            FROM tblPlano p 
            JOIN tblCliente c ON p.plaIdCliente = c.IdCliente 
            WHERE p.IdPlano = ? AND c.CliEmail = ?
        ");
        $stmt->execute([$planId, $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Excluir o plano
            $stmt = $con->prepare("DELETE FROM tblPlano WHERE IdPlano = ?");
            if ($stmt->execute([$planId])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao excluir plano']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Plano não encontrado ou não pertence ao usuário']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    }
}
?>