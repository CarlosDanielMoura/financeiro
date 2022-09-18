<?php

/*
__TODO__
Fazer autenticação
*/

require_once("../../conexao.php");

@session_start();
if (!isset($_GET) || empty($_GET) || $_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(400);
    die();
}
$idProd = @$_GET['idProd'];
$query = $pdo->prepare("SELECT * from produtos where ativo = 'Sim' and estoque >= 0 and id = :idProd ");
$query->bindValue(":idProd", $idProd);
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json; charset=utf-8');
if (@count($res) > 0) {
    http_response_code(200);
    $json = json_encode($res[0]);
    echo $json;
} else {
    http_response_code(404);
    die();
}
