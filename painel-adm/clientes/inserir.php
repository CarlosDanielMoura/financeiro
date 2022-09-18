<?php
require_once("../../conexao.php");
require_once("campos.php");

$cp1 = $_POST[$campo1];
$cp2 = $_POST[$campo2];
$cp3 = $_POST[$campo3];
$cp4 = $_POST[$campo4];
$cp5 = $_POST[$campo5];
$cp6 = $_POST[$campo6];
$cp7 = $_POST[$campo7];
$cp8 = $_POST[$campo8];
$cp9 = $_POST[$campo9];
$cp10 = $_POST[$campo10];
$cp11 = $_POST[$campo11];

if ($cp9 == "" && $cp10 == "") {
    $cp8 = "";
}

$id = @$_POST['id'];

// //VALIDAR Email
// $query = $pdo->query("SELECT * from $pagina where email = '$cp11'");
// $res = $query->fetchAll(PDO::FETCH_ASSOC);
// $total_reg = @count($res);
// $id_reg = @$res[0]['id'];
// if ($total_reg > 0 and $id_reg != $id) {
//     echo 'Este registro já está cadastrado!!';
//     exit();
// }

//VALIDAR Documento
$query = $pdo->query("SELECT * from $pagina where doc = '$cp3'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if ($total_reg > 0 and $id_reg != $id) {
    echo 'Este registro já está cadastrado!!';
    exit();
}


if ($id == "") {
    $query = $pdo->prepare("INSERT INTO $pagina set nome = :campo1, pessoa = :campo2, doc = :campo3, 
    telefone = :campo4, endereco = :campo5, ativo = :campo6, obs = :campo7, data = curDate(), 
    banco = :campo8, agencia = :campo9, conta = :campo10, email = :campo11");
} else {
    $query = $pdo->prepare("UPDATE $pagina set nome = :campo1, pessoa = :campo2, doc = :campo3, 
    telefone = :campo4, endereco = :campo5, ativo = :campo6, obs = :campo7, data = curDate(), 
    banco = :campo8, agencia = :campo9, conta = :campo10, email = :campo11 WHERE id = '$id'");
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
$query->bindValue(":campo11", "$cp11");
$query->execute();

echo 'Salvo com Sucesso!';
