<?php
require_once("../../conexao.php");

$nivel = $_POST['nivel'];
$id = @$_POST['id'];


//Validar Campo
$consulta = $pdo->query("SELECT * from niveis where nivel = '$nivel' ");
$res = $consulta->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

$id_reg = @$res[0]['id'];

if ($total_reg > 0 and $id_reg != $id) {
    echo 'Este Nível já está cadastrado';
    exit();
}


if ($id == "") {
    $consulta = $pdo->prepare("INSERT INTO niveis set nivel = :nivel");
} else {
    $consulta = $pdo->prepare("UPDATE niveis set nivel = :nivel WHERE id = '$id'");
}


$consulta->bindValue(":nivel", "$nivel");
$consulta->execute();

echo 'Salvo com Sucesso!';
