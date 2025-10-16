<?php
    try {
        $con = new PDO("mysql:host=br612.hostgator.com.br;port=3306;dbname=hubsap45_bd_unktravel", "hubsap45_usrunktra", "@iR#siG!I0");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conectado";
    } catch (PDOException $erro) {
        echo "Erro de conexão: " . $erro->getMessage();
    }
?>
