<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario']; // ID do funcionario pela sessão
$id = @$_POST['id-confirma-os'];

/**Valores do Formulario */
$valor_total = $_POST['vlr_total_prods'];
$forma_pagamento = $_POST['form_payment'];
$entry_pagment = $_POST['entry_pagamenty'];
$data_pag = $_POST['data_payment'];
$desconto_os = $_POST['desconto_os'];
$parcelas = $_POST['parc_payment'];
$sub_total = $_POST['valor_payment_liquido'];
$id_clienteOs = $_POST['id_cliente_os'];
$client_entry_valor = $_POST['entrada_payment'];
$type_entry_client = $_POST['type_entry_client'];

$qtd_parcelasCart = $_POST['payment_cart_os'];






if ($forma_pagamento == 'Cartão de Crédito' && $parcelas == '') {
    echo 'Coloque pelo menos 1 na quantidade de parcelas.';
    exit();
}

if ($forma_pagamento == 'Carnê' && $parcelas <= 1) {
    echo 'Venda feita no carnê  a parcela tem que ser acima de 1';
    exit();
}

if ($forma_pagamento == 'Cartão de Crédito' && $entry_pagment != 'Cartão de Crédito') {
    echo 'Pagamento foi feito via cartão de crédito, por favor mudar o TIPO DE ENTRADA para cartão de crédito';
    exit();
}

if ($forma_pagamento == 'Cartão de Debito' && $entry_pagment != 'Cartão de Débito') {
    echo 'Pagamento foi feito via cartão de débito, por favor mudar o TIPO DE ENTRADA para cartão de débito';
    exit();
}



if ($forma_pagamento  == 'Cartão de Crédito' or $forma_pagamento == 'Cartão de Debito') {
    $status = 'Concluída';
    $parcelaFinal = $qtd_parcelasCart;
  
} else {
    $parcelaFinal = $parcelas;
    $status = 'Pendente';
}

if ($data_pag == '') {
    $data_pag = date('Y-m-d');
}


if ($client_entry_valor == '' || $client_entry_valor  < 0) {
    $client_entry_valor = 0;
}

if ($client_entry_valor == '') {
    $client_entry_valor = 0;
}

if($parcelas == ''){
    $parcelaFinal = 1;
}




$valor_final_venda =  (float)$sub_total - (float)$client_entry_valor;



$DateAndTime = date('Y-m-d', time());

if ($data_pag == date('Y-m-d') and $parcelas == '1') {
    $status = 'Concluída';
} else {
    $status = 'Pendente';
}

//RECUPERANDO USUARIO
$query_con = $pdo->query("SELECT * FROM clientes WHERE id = '$id_clienteOs'");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {
    $nome_cli = $res[0]['nome'];
} else {
    $nome_cli = 'Venda Rápida';
}

//RECUPERANDO O id VENDA DA OS ITENS VENDA
$total_venda = 0;
$query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = -2 
and usuario = '$id_usuario' order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $valor_total_item = $res[$i]['total'];
        $total_venda += $valor_total_item;
    }
} else {
    echo 'Não é possível fechar a venda sem itens';
    exit();
}


$query = $pdo->prepare("INSERT INTO vendas set valor = '$total_venda', usuario = '$id_usuario',
pagamento = :pagamento, lancamento = :lancamento, data_lanc = '$DateAndTime', data_pgto = :data,
desconto = :desconto, subtotal = :subtotal, parcelas = :parcelas, 
status = '$status', cliente = :cliente, recebido = '$client_entry_valor',tipoEntrada = :tipoEntrada");



$query->bindValue(":pagamento", "$forma_pagamento");
$query->bindValue(":lancamento", "$entry_pagment");
$query->bindValue(":data", "$data_pag");
$query->bindValue(":desconto", "$desconto_os");
$query->bindValue(":subtotal", "$valor_final_venda");
$query->bindValue(":parcelas", "$parcelaFinal");
$query->bindValue(":cliente", "$id_clienteOs");
$query->bindValue(":tipoEntrada", "$type_entry_client");
$query->execute();
$id_ult_registro = $pdo->lastInsertId();


$description_account = 'Venda Via OS - ' . $nome_cli;

if ($status == 'Concluída') {

    $pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Venda', 
	    descricao = '$description_account', valor = '$valor_final_venda', usuario = '$id_usuario', data = '$DateAndTime',
	    lancamento = '$entry_pagment', plano_conta = 'Venda', documento = '$forma_pagamento', id_mov = '$id_ult_registro'");
} else {
    if ($parcelas > 1) {
        $query = $pdo->query("UPDATE contas_receber set cliente = '$id_clienteOs', 
		    entrada = '$entry_pagment', documento = '$forma_pagamento', plano_conta = 'Venda', 
		    frequencia = 'Uma Vez', usuario_lanc = '$id_usuario', status = 'Pendente', 
		    data_recor = '$DateAndTime', id_venda = '$id_ult_registro' WHERE id_venda = '-1' and 
		    usuario_lanc = '$id_usuario'");
    } else {
        $query = $pdo->query("INSERT INTO contas_receber set descricao = '$description_account', 
            cliente = '$id_clienteOs', entrada = '$entry_pagment', documento = '$forma_pagamento', 
            plano_conta = 'Venda', data_emissao = '$DateAndTime', vencimento = '$data_pag', 
            frequencia = 'Uma Vez', valor = '$valor_final_venda', usuario_lanc = '$id_usuario', 
            status = 'Pendente', data_recor = '$DateAndTime', id_venda = '$id_ult_registro'");
    }
}

$query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = -2 and 
usuario = '$id_usuario' order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $pdo->query("UPDATE itens_venda set id_venda = '$id_ult_registro' 
	    where id_venda = -2 and usuario = '$id_usuario'");
    }
}



$pdo->query("UPDATE ordem_servico set status = 'Confirmada' where id = '$id'");

echo 'Salvo com Sucesso!';
