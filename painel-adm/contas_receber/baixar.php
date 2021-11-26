<?php
require_once("../../conexao.php");
require_once("campos.php");
session_start();
$id_usuario = @$_SESSION['id_usuario'];

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



//SELECIONANDO A PAGINA
$query = $pdo->query("SELECT * from $pagina where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);


$id = $res[0]['id'];
$cp1 = $res[0]['descricao'];
$cp2 = $res[0]['cliente'];
$cp3 = $res[0]['entrada'];
$cp4 = $res[0]['documento'];
$cp5 = $res[0]['plano_conta'];
$cp9 = $res[0]['valor'];
$cp13 = $res[0]['status'];

$query3 = $pdo->query("SELECT * FROM clientes WHERE id = '$cp2'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
if (@count($res3) > 0) {
    $nome_forne = $res3[0]['nome'];
    $descricao_conta = $cp1 . '-' . $nome_forne;
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
    echo 'O valor a ser pago não pode ser superior ao valor da conta! Valor da conta 
    atualmente é R$ ' . $cp9;
    exit();
}

if ($valor  <= 0) {
    echo 'O valor precisa se maior que 0 ';
    exit();
}

//SE O VALOR FOR TOTAL ELE JA DA BAIXA DIRETO
if ($valor == $cp9) {
    $pdo->query("UPDATE  $pagina set entrada = '$cp3', usuario_baixa = '$id_usuario', status = 'Paga',
    juros = '$valor_juros' , multa = '$valor_multa' , desconto = '$valor_desconto', subtotal = '$subtotal' , data_baixa = curDate() where id = '$id'");
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


    $pdo->query("INSERT INTO valor_parcial set id_conta = '$id', tipo = 'Pagar', 
    valor = '$subtotal', data = curDate(), usuario = '$id_usuario'");

    //ATUALIZANDO O RESIDUO
    $pdo->query("UPDATE $pagina set descricao = '$cp1', entrada = '$cp3', 
    usuario_baixa = '$id_usuario', status = 'Pendente', juros = '$valor_juros',
     multa = '$valor_multa', desconto = '$valor_desconto', valor = '$cp9', 
     subtotal = '$subtotal', data_baixa = curDate() where id = '$id'");
}


//LANCAR NAS MOVIMENTAÇÕES
$pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Conta à Receber', 
 descricao = '$descricao_conta', valor = '$subtotal', usuario = '$id_usuario', data = curDate(), 
 lancamento = '$cp3', plano_conta = '$cp5', documento = '$cp4', caixa_periodo = '$caixa_aberto'");

echo 'Baixado com Sucesso!';
