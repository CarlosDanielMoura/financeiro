<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$valor = $_POST['valor-fec'];
$valor = str_replace(',', '.', $valor);
$valor_dif = $_POST['valor-difer'];
$local = $_POST['local'];

if ($local == 'Caixa') {
    $doc = 'Dinheiro';
} else {
    $doc = $local;
}

if ($valor < 0 and $local == 'Cartão de Crédito' || $local == 'Cartão de Débito') {
    echo 'Seu valor está negativo! Não será possível realizar o fechamento até que seja positivo!';
    exit();
}

if ($valor <= 0) {
    echo 'Insira um valor maior que zero!';
    exit();
}



if ($valor_dif < 0) {
    echo 'Você não tem essa quantidade para retirar!';
    exit();
}

$query = $pdo->prepare("INSERT INTO movimentacoes set tipo = 'Saída', movimento = 'Fechamento',
 descricao = 'Retirada', valor = :valor, usuario = '$id_usuario', data = curDate(), lancamento = :saida, 
 plano_conta = 'Fechamento', documento = :documento");

$query->bindValue(":valor", "$valor");
$query->bindValue(":saida", "$local");
$query->bindValue(":documento", "$doc");
$query->execute();


echo 'Salvo com Sucesso!';
