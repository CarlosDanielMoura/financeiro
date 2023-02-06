<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$data_atual = date('Y-m-d');

$dia = date('d');
$mes = date('m');
$ano = date('Y');

$id = $_POST['id-baixar'];
$valor = $_POST['valor-baixar'];
$valor = str_replace(',', '.', $valor);



$valor_desconto = $_POST['valor-desconto'];
$valor_desconto = str_replace(',', '.', $valor_desconto);
$valor_juros = $_POST['valor-juros'];
$valor_juros = str_replace(',', '.', $valor_juros);
$valor_multa = $_POST['valor-multa'];
$valor_multa = str_replace(',', '.', $valor_multa);
$subtotal = $_POST['subtotal'];
$subtotal = str_replace(',', '.', $subtotal);

$saida = $_POST['saida-baixar'];

$query = $pdo->query("SELECT * from contas_receber where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id = $res[0]['id'];
$cp1 = $res[0]['descricao'];
$cp2 = $res[0]['cliente'];
$cp3 = $res[0]['entrada'];
$cp4 = $res[0]['documento'];
$cp5 = $res[0]['plano_conta'];
$cp7 = $res[0]['vencimento'];
$cp8 = $res[0]['frequencia'];
$cp9 = $res[0]['valor'];
$data_rec = $res[0]['data_recor'];
$id_venda = $res[0]['id_venda'];
$arquivo = $res[0]['arquivo'];

$query2 = $pdo->query("SELECT * FROM clientes WHERE id = '$cp2'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
    $nome_fornecedor = $res2[0]['nome'];
    $descricao_conta = $cp1 . ' - ' . $nome_fornecedor;
} else {
    $descricao_conta = $cp1;
}

//RECUPERAR O CAIXA QUE ESTÁ ABERTO (CASO TENHA ALGUM)
$query2 = $pdo->query("SELECT * FROM caixa WHERE status = 'Aberto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
    $caixa_aberto = $res2[0]['id'];
} else {
    $caixa_aberto = 0;
}

if ($valor > $cp9) {
    echo 'O valor a ser pago não pode ser superior ao valor da conta! O valor da conta é de R$ ' . $cp9;
    exit();
}

if ($valor <= 0) {
    echo 'O precisa ser maior que 0 ';
    exit();
}


if ($valor == $cp9) {

    $pdo->query("UPDATE contas_receber set entrada = '$saida', usuario_baixa = '$id_usuario', 
    status = 'Paga', juros = '$valor_juros', multa = '$valor_multa', desconto = '$valor_desconto', 
    subtotal = '$subtotal', data_baixa = '$data_atual' , arquivo = '$arquivo' where id = '$id'");


    //CRIAR A PRÓXIMA CONTA A PAGAR
    $frequencia = $cp8;
    $query1 = $pdo->query("SELECT * from frequencias where nome = '$frequencia' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    $dias_frequencia = $res1[0]['dias'];

    if ($dias_frequencia == 30 || $dias_frequencia == 31) {

        $data_recor = date('Y/m/d', strtotime("+1 month", strtotime($data_rec)));
        $nova_data_vencimento = date('Y/m/d', strtotime("+1 month", strtotime($cp7)));
    } else if ($dias_frequencia == 90) {

        $data_recor = date('Y/m/d', strtotime("+3 month", strtotime($data_rec)));
        $nova_data_vencimento = date('Y/m/d', strtotime("+3 month", strtotime($cp7)));
    } else if ($dias_frequencia == 180) {

        $data_recor = date('Y/m/d', strtotime("+6 month", strtotime($data_rec)));
        $nova_data_vencimento = date('Y/m/d', strtotime("+6 month", strtotime($cp7)));
    } else if ($dias_frequencia == 360) {

        $data_recor = date('Y/m/d', strtotime("+1 year", strtotime($data_rec)));
        $nova_data_vencimento = date('Y/m/d', strtotime("+1 year", strtotime($cp7)));
    } else {
        $data_recor = date('Y/m/d', strtotime("+$dias_frequencia days", strtotime($data_atual)));
        $nova_data_vencimento = date('Y/m/d', strtotime("+$dias_frequencia days", strtotime($cp7)));
    }


    if (@$dias_frequencia > 0) {
        $pdo->query("INSERT INTO contas_receber set descricao = '$cp1', cliente = '$cp2', 
        entrada = '$cp3', documento = '$cp4', plano_conta = '$cp5', data_emissao = '$data_atual',
         vencimento = '$nova_data_vencimento', frequencia = '$cp8', valor = '$cp9', 
         usuario_lanc = '$id_usuario', status = 'Pendente', data_recor = '$data_recor'");
        $id_ult_registro = $pdo->lastInsertId();

        $pdo->query("UPDATE contas_receber set data_recor = '' where id='$id'");
    }
} else {

    $descricao_conta = '(Resíduo) ' . $descricao_conta;
    //PEGAR RESIDUOS DA CONTA
    $total_resid = 0;
    $query = $pdo->query("SELECT * FROM valor_parcial WHERE id_conta = '$id'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res) > 0) {

        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $valor_resid = $res[$i]['valor'];
            $total_resid += $valor_resid;
        }
    }

    $cp9 = $cp9 - $subtotal;

    $pdo->query("INSERT INTO valor_parcial set id_conta = '$id', tipo = 'Pagar', valor = '$subtotal',
     data = curDate(), usuario = '$id_usuario'");

    $pdo->query("UPDATE contas_receber set entrada = '$saida', usuario_baixa = '$id_usuario', status = 'Pendente', 
    juros = '$valor_juros', multa = '$valor_multa', desconto = '$valor_desconto', valor = '$cp9',
     subtotal = '$subtotal', data_baixa = curDate() where id = '$id'");
}

//LANÇAR NAS MOVIMENTAÇÕES
$pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Conta à Receber',
 descricao = '$descricao_conta', valor = '$subtotal', usuario = '$id_usuario', data = '$data_atual',
  lancamento = '$saida', plano_conta = '$cp5', documento = '$cp4', caixa_periodo = '$caixa_aberto',
  id_mov = '$id_venda'");

//VERIFICAR SE A CONTA É DE UMA VENDA E SE ELA ESTÁ TOTALMENTE PAGA
$query = $pdo->query("SELECT * FROM contas_receber WHERE id_venda = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$paga = 'Sim';
for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $status = $res[$i]['status'];
    if ($status == 'Pendente') {
        $paga = 'Não';
    }
}
if ($paga == 'Sim') {
    $pdo->query("UPDATE vendas set status = 'Concluída' where id = '$id_venda'");
}



echo 'Baixado com Sucesso!';
