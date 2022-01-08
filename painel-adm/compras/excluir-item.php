<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = @$_POST['id'];

$query = $pdo->query("SELECT * from itens_compra where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produto = $res[0]['produto'];
$quant = $res[0]['quantidade'];

$query = $pdo->query("SELECT * from produtos where id = '$produto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];


//Retirar prod no estoque
$novo_estoque = $estoque - $quant;
$query = $pdo->query("UPDATE produtos set estoque = '$novo_estoque' where id = '$produto' ");

$query = $pdo->query("DELETE from itens_compra where id = '$id'");

echo 'Excluído com Sucesso!';
