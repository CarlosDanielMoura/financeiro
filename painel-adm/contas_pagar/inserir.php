<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$cp10 = $_SESSION['id_usuario'];

$cp1 = $_POST[$campo1];
$cp2 = $_POST[$campo2];
$cp3 = $_POST[$campo3];
$cp4 = $_POST[$campo4];
$cp5 = $_POST[$campo5];
$cp6 = $_POST[$campo6];
$cp7 = $_POST[$campo7];
$cp8 = $_POST[$campo8];
$cp9 = $_POST[$campo9];

$cp9 = str_replace(',', '.', $cp9);

$cp5 = $cp5 . ' - ' . $_POST['cat_despesas'];

//RECUPERAR O CAIXA QUE ESTÁ ABERTO (CASO TENHA ALGUM)
$query2 = $pdo->query("SELECT * FROM caixa WHERE status = 'Aberto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
    $cp12 = $res2[0]['id'];
} else {
    $cp12 = 0;
}


if ($cp9 == "") {
    echo 'Preencha o Valor';
    exit();
}

$id = @$_POST['id'];


if ($id == "") {

    $query = $pdo->prepare("INSERT INTO $pagina set descricao = :campo1, cliente = :campo2, saida = :campo3, documento = :campo4, plano_conta = :campo5, data_emissao = :campo6, vencimento = :campo7, frequencia = :campo8, valor = :campo9, usuario_lanc = :campo10, status = 'Pendente'");
} else {


    $query = $pdo->prepare("UPDATE $pagina set descricao = :campo1, cliente = :campo2, saida = :campo3, documento = :campo4, plano_conta = :campo5, data_emissao = :campo6, vencimento = :campo7, frequencia = :campo8, valor = :campo9, usuario_lanc = :campo10 WHERE id = '$id'");
}

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "$cp2");
$query->bindValue(":campo3", "$cp3");
$query->bindValue(":campo4", "$cp4");
$query->bindValue(":campo5", "$cp5");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");
$query->bindValue(":campo9", "$cp9");
$query->bindValue(":campo10", "$cp10");


$query->execute();


echo 'Salvo com Sucesso!';
