<?php
require_once("../../conexao.php");
require_once("../verificar.php");
$json = file_get_contents('php://input');

$data = json_decode($json);

//Verificações
if (is_null($data)) {
    http_response_code(400);
    die("JSON invalido");
}
if (empty($data->produtos->valor_Total_produtos)) {
    http_response_code(400);
    die("JSON invalido do valor de produto");
}
if (empty($data->produtos->valor_entrada_cliente)) {
    $data->produtos->valor_entrada_cliente = 0;
}
if (empty($data->dadosPrincipal->cli_dados_princ)) {
    http_response_code(400);
    die("JSON invalido do id do cliente");
}

$obj = json_encode($data);
$valor_total = $data->produtos->valor_Total_produtos;
$entrada_cliente = $data->produtos->valor_entrada_cliente;
$id = $data->dadosPrincipal->cli_dados_princ;


if (!is_numeric($valor_total)) {
    http_response_code(400);
    die("valor_total não é numerico");
}
$valor_total = floatval($valor_total);
if ($valor_total <= 0) {
    http_response_code(400);
    die("valor_total <= 0");
}
if (!is_numeric($entrada_cliente)) {
    http_response_code(400);
    die("entrada_cliente não é numerico");
}
$entrada_cliente = floatval($entrada_cliente);
if ($entrada_cliente <= 0) {
    http_response_code(400);
    die("entrada_cliente <= 0");
}


//Inserindo no Banco 
$query = $pdo->prepare("INSERT INTO ordem_servico set obj = :obj, data_criacao = curDate(), 
valor_total = :valor_total, entrada_cliente = :entrada_cliente, id_cliente = :id");
$query->bindValue(":obj", "$obj");
$query->bindValue(":valor_total", "$valor_total");
$query->bindValue(":entrada_cliente", "$entrada_cliente");
$query->bindValue(":id", "$id");

header('Content-Type: application/json; charset=utf-8');
if ($query->execute()) {
    http_response_code(200);
    print_r(json_encode([
        "mensagem" => "Registro adicionado com sucesso!!!",
        "Valor Total" => $valor_total,
        "Entrada" => $entrada_cliente,
        "id" => $pdo->lastInsertId()
    ]), 0);
} else {
    http_response_code(500);
    print_r(json_encode([
        "mensagem" => "Erro SQL ao inserir",
        "info" => $query->errorInfo()
    ]), 0);
}
//print_r($data->dadosPrincipal->observacao_princ, 0);


// print_r($data->produtos, 0);
