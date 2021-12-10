<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$saida = $_POST['lancamento-transf'];
$entrada = $_POST['lancamento-entrada'];
$valor = $_POST['valor-transf'];
$valor = str_replace(',', '.', $valor);

if ($saida == $entrada) {
    echo 'Você não pode transferir para o mesmo local!';
    exit();
}

$query = $pdo->prepare("INSERT INTO movimentacoes set tipo = 'Saída', movimento = 'Transferência', descricao = 'Transferência', valor = :valor, usuario = '$id_usuario', data = curDate(), lancamento = :saida, plano_conta = 'Transferência', documento = 'Dinheiro'");

$query->bindValue(":valor", "$valor");
$query->bindValue(":saida", "$saida");
$query->execute();



$query2 = $pdo->prepare("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Transferência', descricao = 'Transferência', valor = :valor, usuario = '$id_usuario', data = curDate(), lancamento = :entrada, plano_conta = 'Transferência', documento = 'Dinheiro'");

$query2->bindValue(":valor", "$valor");
$query2->bindValue(":entrada", "$entrada");
$query2->execute();


echo 'Salvo com Sucesso!';
