<?php
require_once("../../conexao.php");
require_once("campos.php");




$cp1 = $_POST[$campo1];
$cp2 = $_POST[$campo2];

$id = @$_POST['id'];

//VALIDAR CAMPO
$query = $pdo->query("SELECT * from $pagina where nome = '$cp1'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];

if ($total_reg > 0 and $id_reg != $id) {
    echo 'Dia já está cadastrado!!';
    exit();
}



if ($id == "") {
    $query = $pdo->prepare("INSERT INTO $pagina set nome = :campo1, dias = :campo2 ");
} else {
    $query = $pdo->prepare("UPDATE $pagina set nome = :campo1, dias = :campo2 WHERE id = '$id'");
}

//Execuntando para salvar no banco o prepare

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "$cp2");
$query->execute();

echo 'Salvo com Sucesso!';
