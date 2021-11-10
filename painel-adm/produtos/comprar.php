<?php
require_once('../../conexao.php');
require_once('campos.php');
$id = @$_POST['id-comprar'];
$quantidade = @$_POST['quantidade'];
$cp5 = @$_POST[$campo5];
$cp6 = str_replace(',', '.', $cp5);
$cp7 = @$_POST[$campo7];
$cp11 = @$_POST[$campo11];


$total_estoque = 0;
//BUSCAR PARA TOTALIZAR PRODUTOS
$query_con = $pdo->query("SELECT * FROM $pagina   WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res_con[0]['estoque'];
$valor_venda = $res_con[0]['valor_venda'];

/*if ($cp11 == 0) {
    echo 'O valor % do lucro tem que ser maior que 0';
    exit();
}*/

if ($cp11 != "") {
    $novo_vlr_venda = $cp5 +  ($cp5 * $cp11 / 100);
} else {
    $novo_vlr_venda = $valor_venda;
}

$total_estoque = $estoque + $quantidade;

$query = $pdo->prepare("UPDATE  $pagina  SET estoque = :estoque , valor_compra = :valor_compra , fornecedores = :fornecedores, valor_venda = :valor_venda, lucro = :lucro WHERE id = '$id'");

$query->bindValue(":estoque", "$total_estoque");
$query->bindValue(":valor_compra", "$cp5");
$query->bindValue(":fornecedores", "$cp7");
$query->bindValue(":valor_venda", "$novo_vlr_venda");
$query->bindValue(":lucro", "$cp11");
$query->execute();
echo 'Comprado com Sucesso!';
