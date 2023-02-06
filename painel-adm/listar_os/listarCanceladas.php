<?php

/*
__TODO__
Fazer autenticação
*/

require_once("../../conexao.php");

@session_start();

$query = $pdo->query("SELECT * from ordem_servico where status = 'Cancelada' order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {
    http_response_code(200);

    $json = json_encode($res);
    echo $json;
} else {
    http_response_code(404);
    die();
}
