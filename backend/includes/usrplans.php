<?php
    $planos = [];

    try {
        $stmt = $con->prepare("
            SELECT p.*
            FROM tblPlano p
            INNER JOIN `tblDetCliente-Plano` dcp ON p.idPlano = dcp.idPlano
            WHERE dcp.idCliente = ?
            ORDER BY p.plaData DESC
        ");
        $stmt->execute([$id]);
        $planos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar planos: " . $e->getMessage();
    }
?>
