<?php
require_once("../../conexao.php");
@session_start();
$cp10 = $_SESSION['id_usuario'];

$cp2 = $_POST['movimento-edit'];
$cp3 = $_POST['descricao-edit'];
$cp4 = $_POST['valor-edit'];
$cp6 = $_POST['data-edit'];
$cp7 = $_POST['lancamento-edit'];
$cp8 = $_POST['plano-conta-edit'];
$cp9 = $_POST['documento-edit'];
$cp4 = str_replace(',', '.', $cp4);


if ($cp4 == "") {
    echo 'Preencha o Valor';
    exit();
}


$id = @$_POST['id'];


$query = $pdo->prepare("UPDATE movimentacoes set movimento = :campo2, descricao = :campo3, valor = :campo4, data = :campo6, lancamento = :campo7, plano_conta = :campo8, documento = :campo9, usuario = :campo10 WHERE id = '$id'");


$query->bindValue(":campo2", "$cp2");
$query->bindValue(":campo3", "$cp3");
$query->bindValue(":campo4", "$cp4");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");
$query->bindValue(":campo9", "$cp9");
$query->bindValue(":campo10", "$cp10");
$query->execute();


echo 'Salvo com Sucesso!';
