<?php  
require_once("../../conexao.php");
require_once("../verificar.php");

header('Content-Type: application/json; charset=utf-8');
require_once("../../conexao.php");
require_once("../verificar.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

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


$obj = json_encode($data);
$valor_total = $data->produtos->valor_Total_produtos;
$entrada_cliente = $data->produtos->valor_entrada_cliente;
$id = $data->dadosPrincipal->cli_dados_princ;
$id_func = $data->dadosPrincipal->func_dados_princ;
$tipo_pagamento = $data->produtos->tipo_pagamento;
$id_os = $data->dadosPrincipal->id_ordem_servico;


if (!is_numeric($valor_total)) {
    http_response_code(400);
    die("valor_total não é numerico");
}

$valor_total = floatval($valor_total);
if ($valor_total <= 0) {
    http_response_code(400);
    die("valor_total <= 0");
}
// if (!is_numeric($entrada_cliente)) {
//     http_response_code(400);
//     die("entrada_cliente não é numerico");
// }

// Buscando cliente
$query1 = $pdo->query("SELECT * from clientes where id = $id ");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if (@count($res1) > 0) {
    $nome_cliente = $res1[0]['nome'];
} else {
    $nome_cliente = 'Cliente sem nome';
}

// Buscando funcionario
$query1 = $pdo->query("SELECT * from usuarios where id = $id_func ");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if (@count($res1) > 0) {
    $nome_func = $res1[0]['nome'];
} else {
    $nome_func = 'Sem funcionário';
}


//Inserindo no Banco 
$query = $pdo->prepare("UPDATE  ordem_servico set obj = :obj, data_criacao = curDate(), 
valor_total = :valor_total, entrada_cliente = :entrada_cliente, nome_cliente = :nome_cliente, status = 'Aberto', nome_func = :nome_func WHERE id = '$id_os'");
$query->bindValue(":obj", "$obj");
$query->bindValue(":valor_total", "$valor_total");
$query->bindValue(":entrada_cliente", "$entrada_cliente");
$query->bindValue(":nome_cliente", "$nome_cliente");
$query->bindValue(":nome_func", "$nome_func");
$id_ult_registro = $pdo->lastInsertId();


//Entrada cliente para as movimentações adicionar
//RECUPERAR O CAIXA QUE ESTÁ ABERTO (CASO TENHA ALGUM)
$DateAndTime = date( 'Y-m-d', time());

$query2 = $pdo->query("SELECT * FROM caixa WHERE status = 'Aberto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
	$caixa_aberto = $res2[0]['id'];
} else {
	$caixa_aberto = 0;
}
$descricao = 'Entrada '.$nome_cliente; 

if($entrada_cliente > 0 && $entrada_cliente != ' '){
    $pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Venda', 
    descricao = '$descricao', valor = '$entrada_cliente ', usuario = '$id_usuario', data = '$DateAndTime',
    lancamento = 'Caixa', plano_conta = 'Venda', documento = '$tipo_pagamento', 
    caixa_periodo = '$caixa_aberto', id_mov = '$id_ult_registro'");   
}


// $query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = 3 and 
// usuario = '$id_usuario' order by id desc");
// $res = $query_con->fetchAll(PDO::FETCH_ASSOC);
// $total_reg = @count($res);
// if ($total_reg > 0) {
// 	for ($i = 0; $i < $total_reg; $i++) {
// 		foreach ($res[$i] as $key => $value) {
// 		}
// 		$pdo->query("UPDATE itens_venda set id_venda = '$id_ult_registro' 
// 		where id_venda = 3 and usuario = '$id_usuario'");
// 	}
// }


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
?>