<?php 
require_once("../../conexao.php");
$id = $_POST['id'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$data = $_POST['data'];

$pdo->query("UPDATE contas_receber set vencimento = '$data', valor = '$valor' where id = '$id'");

echo 'Inserido com Sucesso!';
 ?>