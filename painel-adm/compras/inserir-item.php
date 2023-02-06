<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = @$_POST['id'];
$quant = @$_POST['quant'];

$query = $pdo->query("SELECT * from produtos where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];
$valor = $res[0]['valor_compra'];


$total = $valor * $quant;

//CONDIÇÃO DE Compra 
if ($quant == '' || $quant == 0) {
    echo 'A quantidade precisa ser superior a 0!';
    exit();
}

if ($valor <= 0) {
    echo 'É preciso colocar o valor de compra do produto! Ele não possui valor de custo';
    exit();
}

//abater prod no estoque
$novo_estoque = $estoque + $quant;
$query = $pdo->query("UPDATE produtos set estoque = '$novo_estoque' where id = '$id' ");

$query = $pdo->query("INSERT INTO itens_compra set id_compra = 0, produto = '$id', valor = '$valor', 
quantidade = '$quant', total = '$total', usuario = '$id_usuario'");

echo 'Inserido com Sucesso!';
