<?php 
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = @$_POST['id'];
$quant = @$_POST['quant'];



$query = $pdo->query("SELECT * from produtos where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];
$valor = $res[0]['valor_venda'];
$valor_custo = $res[0]['valor_compra'];
$tipoProduto = $res[0]['tipoProduto'];

$total = $valor * $quant;

if( $tipoProduto == 'Normal' && ( $quant  > $estoque)){
	echo 'Você não tem a quantidade de produtos suficiente para venda';
	exit();
}

if($quant == '' || $quant == 0){
	echo 'A quantidade precisa ser superior a 0';
	exit();
}

// if($valor_custo <= 0){
// 	echo 'É preciso colocar o valor de compra do produto! Ele não possui valor de custo.';
// 	exit();
// }

//abater prod no estoque
// 
if($estoque == 0){
	$novo_estoque = $estoque;
}else{
	$novo_estoque = $estoque - $quant;
}
$query = $pdo->query("UPDATE produtos set estoque = '$novo_estoque' where id = '$id' ");

$query = $pdo->query("INSERT INTO itens_venda set id_venda = 0, produto = '$id', valor = '$valor', quantidade = '$quant', total = '$total', usuario = '$id_usuario', 
valor_custo = '$valor_custo'");

echo 'Inserido com Sucesso!';

