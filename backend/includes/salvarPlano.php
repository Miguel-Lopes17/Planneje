<?php
/*
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$modelo = (isset($_POST["modelo"]) && $_POST["modelo"] != null) ? $_POST["modelo"] : "";
$marca = (isset($_POST["marca"]) && $_POST["marca"] != null) ? $_POST["marca"] : "";
$preco = (isset($_POST["preco"]) && $_POST["preco"] != null) ? $_POST["preco"] : NULL;
include 'conexao.php';
try {
$stmt = $con->prepare("INSERT INTO carro (modelo, marca, preco) VALUES (?, ?, ?)");
$stmt->bindParam(1, $modelo);
$stmt->bindParam(2, $marca);
$stmt->bindParam(3, $preco);
if ($stmt->execute()) {
if ($stmt->rowCount() > 0) {
//echo "Dados cadastrados com sucesso!"; //echo '<meta http-equiv="refresh" content="0, url=index.php">';
header("location: index.php");
} else {
echo "Erro ao tentar efetivar cadastro";
}
} else {
throw new PDOException("Erro: Não foi possível executar a declaração sql");
}
} catch (PDOException $erro) {
echo "Erro: " . $erro->getMessage();
}
}
*/
?>