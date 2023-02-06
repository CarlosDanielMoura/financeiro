<?php

require_once("../../conexao.php");

@session_start();

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $query = $pdo->query("SELECT * from ordem_servico where id LIKE '%$data%' or nome_cliente  LIKE '%$data%' 
    or status LIKE '%$data%' order by id desc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res) > 0) {
        http_response_code(200);

        $json = json_encode($res);
        echo $json;
    } else {
        http_response_code(404);
        die();
    }
} else {
    http_response_code(404);
    die();
}
