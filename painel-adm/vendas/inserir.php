<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$pagamento = @$_POST['pagamento'];
$lancamento = @$_POST['lancamento'];
$data = @$_POST['data'];
$desconto = @$_POST['desconto'];
$acrescimo = @$_POST['acrescimo'];
$subtotal = @$_POST['subtotal'];
$parcelas = @$_POST['parcelas'];
$cliente = @$_POST['id-cli'];
$porcen = @$_POST['desc_porcen'];
@$entrada = @$_POST['recebido'];
$tipoEntrada = $_POST['tipo_entrada'];


$qtd_parcelasCart = $_POST['paymentCart'];



$DateAndTime = date( 'Y-m-d', time());


if ($entrada != '') {
	@$valor_entry = $entrada;
}else{
	@$valor_entry = 0;
}

if ($cliente == '') {
	echo 'Você precisa Selecionar um Cliente';
	exit();
}

if ($desconto != '') {
	$valor_final_porc = $desconto * 100;
	$valor_final = $valor_final_porc / $subtotal;
} else {
	$valor_final = 0;
}



$desconto = str_replace(',', '.', $desconto);
$acrescimo = str_replace(',', '.', $acrescimo);



if ($pagamento  == 'Cartão de Crédito') {
    $status = 'Concluída';
    $parcelaFinal = $qtd_parcelasCart;
} else {	
    $parcelaFinal = $parcelas;
    $status = 'Pendente';
}

if($parcelas == ''){
    $parcelaFinal = 1;
}



if($pagamento == 'Cartão de Crédito' && $qtd_parcelasCart == ''){
	echo 'Coloque pelo menos 1 na quantidade de parcelas.';
	exit();
}

if($pagamento == 'Carnê' && $parcelas <= 1 ){
	echo 'Venda feita no carnê  a parcela tem que ser acima de 1';
	exit(); 
} 

if($pagamento == 'Cartão de Crédito' && $lancamento != 'Cartão de Crédito'){
	echo 'Pagamento foi feito via cartão de crédito, por favor mudar o TIPO DE ENTRADA para cartão de crédito';
	exit();
}

if($pagamento == 'Cartão de Debito' && $lancamento != 'Cartão de Débito'){
	echo 'Pagamento foi feito via cartão de débito, por favor mudar o TIPO DE ENTRADA para cartão de débito';
	exit();
}


if ($data == date('Y-m-d') and $parcelas == '1') {
	$status = 'Concluída';
} else {
	$status = 'Pendente';
	
}

$query_con = $pdo->query("SELECT * FROM clientes WHERE id = '$cliente'");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {
	$nome_cli = $res[0]['nome'];
} else {
	$nome_cli = 'Venda Rápida';
}


$total_venda = 0;
$query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = 0 
and usuario = '$id_usuario' 
order by id desc");
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


//RECUPERAR O CAIXA QUE ESTÁ ABERTO (CASO TENHA ALGUM)
$query2 = $pdo->query("SELECT * FROM caixa WHERE status = 'Aberto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
	$caixa_aberto = $res2[0]['id'];
} else {
	$caixa_aberto = 0;
}





$query = $pdo->prepare("INSERT INTO vendas set valor = '$total_venda', usuario = '$id_usuario',
pagamento = :pagamento, lancamento = :lancamento, data_lanc = '$DateAndTime', data_pgto = :data,
desconto = :desconto, acrescimo = :acrescimo, subtotal = :subtotal, parcelas = :parcelas, 
status = '$status', cliente = :cliente, porcentagem = '$valor_final', recebido = '$valor_entry',
tipoEntrada = :tipoEntrada");



$query->bindValue(":pagamento", "$pagamento");
$query->bindValue(":lancamento", "$lancamento");
$query->bindValue(":data", "$data");
$query->bindValue(":desconto", "$desconto");
$query->bindValue(":acrescimo", "$acrescimo");
$query->bindValue(":subtotal", "$subtotal");
$query->bindValue(":parcelas", "$parcelaFinal");
$query->bindValue(":cliente", "$cliente");
$query->bindValue(":tipoEntrada", "$tipoEntrada");
$query->execute();
$id_ult_registro = $pdo->lastInsertId();


$descricao_entrada = 'Entrada '.$nome_cli; 

if($entrada > 0 && $tipoEntrada != ' '){
    $pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Venda', 
    descricao = '$descricao_entrada', valor = '$entrada ', usuario = '$id_usuario', data = '$DateAndTime',
    lancamento = 'Caixa', plano_conta = 'Venda', documento = '$tipoEntrada', 
    caixa_periodo = '$caixa_aberto', id_mov = '$id_ult_registro'");   
}


$descricao_conta = 'Venda - ' . $nome_cli;
if ($status == 'Concluída') {

	$pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Venda', 
	descricao = '$descricao_conta', valor = '$subtotal', usuario = '$id_usuario', data = '$DateAndTime',
	 lancamento = '$lancamento', plano_conta = 'Venda', documento = '$pagamento', 
	 caixa_periodo = '$caixa_aberto', id_mov = '$id_ult_registro'");
} else {
	if ($parcelas > 1) {
		$query = $pdo->query("UPDATE contas_receber set cliente = '$cliente', 
		entrada = '$lancamento', documento = '$pagamento', plano_conta = 'Venda', 
		frequencia = 'Uma Vez', usuario_lanc = '$id_usuario', status = 'Pendente', 
		data_recor = '$DateAndTime', id_venda = '$id_ult_registro' WHERE id_venda = '-1' and 
		usuario_lanc = '$id_usuario'");
	} else {
		$query = $pdo->query("INSERT INTO contas_receber set descricao = '$descricao_conta', 
		cliente = '$cliente', entrada = '$lancamento', documento = '$pagamento', 
		plano_conta = 'Venda', data_emissao = '$DateAndTime', vencimento = '$data', 
		frequencia = 'Uma Vez', valor = '$subtotal', usuario_lanc = '$id_usuario', 
		status = 'Pendente', data_recor = '$DateAndTime', id_venda = '$id_ult_registro'");
	}
}



$query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = 0 and 
usuario = '$id_usuario' order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
	for ($i = 0; $i < $total_reg; $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$pdo->query("UPDATE itens_venda set id_venda = '$id_ult_registro' 
		where id_venda = 0 and usuario = '$id_usuario'");
	}
}


echo 'Salvo com Sucesso!';
