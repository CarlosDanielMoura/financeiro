<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$cp4 = $_SESSION['id_usuario'];

$cp1 = $_POST[$campo1];
$cp2 = $_POST[$campo2];
$cp3 = $_POST[$campo3];
$cp5 = $_POST[$campo5];
$cp6 = $_POST[$campo6];
$cp7 = $_POST[$campo7];
$cp8 = $_POST[$campo8];

$cp2 = str_replace(',', '.', $cp2);

$cp7 = $cp7 . ' - ' . $_POST['cat_despesas'];

$id = @$_POST['id'];

if ($cp8 == "" and $cp1 == "") {
	echo 'Selecione um Fornecedor ou Coloque uma descrição!';
	exit();
}

if ($cp2 == "") {
	echo 'Preencha o Valor';
	exit();
}


if ($cp1 == "") {
	$query1 = $pdo->query("SELECT * from fornecedores where id = '$cp8' ");
	$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
	if (@count($res1) > 0) {
		$cp1 = $res1[0]['nome'];
	}
}


//RECUPERAR O CAIXA QUE ESTÁ ABERTO (CASO TENHA ALGUM)
$query2 = $pdo->query("SELECT * FROM caixa WHERE status = 'Aberto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
	$caixa_aberto = $res2[0]['id'];
} else {
	$caixa_aberto = 0;
}


if ($id == "") {

	$query = $pdo->prepare("INSERT INTO $pagina set descricao = :campo1, valor = :campo2, data = :campo3, usuario = :campo4, lancamento = :campo5, documento = :campo6, plano_conta = :campo7, fornecedor = :campo8");
} else {


	$query = $pdo->prepare("UPDATE $pagina set descricao = :campo1, valor = :campo2, data = :campo3, usuario = :campo4, lancamento = :campo5, documento = :campo6, plano_conta = :campo7, fornecedor = :campo8 WHERE id = '$id'");
}

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "$cp2");
$query->bindValue(":campo3", "$cp3");
$query->bindValue(":campo4", "$cp4");
$query->bindValue(":campo5", "$cp5");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");

$query->execute();


if ($id == "") {
	$id_ult_reg = $pdo->lastInsertId();

	$pdo->query("INSERT INTO movimentacoes set tipo = 'Saída', movimento = 'Despesa', descricao = '$cp1', valor = '$cp2', usuario = '$cp4', data = '$cp3', lancamento = '$cp5', plano_conta = '$cp7', documento = '$cp6', caixa_periodo = '$caixa_aberto', id_mov = '$id_ult_reg'");
} else {
	$pdo->query("UPDATE movimentacoes set descricao = '$cp1', valor = '$cp2', usuario = '$cp4', lancamento = '$cp5', plano_conta = '$cp7', documento = '$cp6' where id_mov = '$id' and movimento = 'Despesa'");
}


echo 'Salvo com Sucesso!';
