<?php
require_once('../../conexao.php');
require_once('campos.php');
$id = @$_POST['id-comprar'];
$quantidade = @$_POST['quantidade'];
$cp5 = @$_POST[$campo5];
$cp7 = @$_POST[$campo7];


$total_estoque = 0;
//BUSCAR PARA TOTALIZAR PRODUTOS
$query_con = $pdo->query("SELECT * FROM $pagina   WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res_con[0]['estoque'];


$total_estoque = $estoque + $quantidade;

$query = $pdo->prepare("UPDATE  $pagina  SET estoque = :estoque , valor_compra = :valor_compra , fornecedores = :fornecedores WHERE id = '$id'");

$query->bindValue(":estoque", "$total_estoque");
$query->bindValue(":valor_compra", "$cp5");
$query->bindValue(":fornecedores", "$cp7");
$query->execute();
echo 'Comprado com Sucesso!';
