<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = $pdo->query("DELETE from itens_venda where id_venda = -2");


$json = file_get_contents('php://input');

$data = json_decode($json);


foreach ($data as $v) {
    //Função para inserir
    $query = $pdo->query("SELECT * from produtos where id = '$v->id' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $estoque = $res[0]['estoque'];
    $valor = $res[0]['valor_venda'];
    $valor_custo = $res[0]['valor_compra'];
    $tipoProduto = $res[0]['tipoProduto'];
    $total = $valor * $v->qtde;
    $query = $pdo->query("INSERT INTO itens_venda set id_venda = -2, produto = '$v->id',
    valor = '$valor', quantidade = '$v->qtde', total = '$total', usuario = '$id_usuario',
    valor_custo = '$valor_custo'");
}