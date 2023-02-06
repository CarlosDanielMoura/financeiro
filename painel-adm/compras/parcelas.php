<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = $pdo->query("DELETE FROM contas_pagar where id_compra = '-1' 
and usuario_lanc = '$id_usuario'");

$valor = $_POST['valor']; //trocar por valor
$data = $_POST['data'];
$parcelas = $_POST['parcelas'];

if ($data == '') {
	$data = date('Y-m-d');
}



if ($parcelas > 1) {
	$novo_valor = $valor / $parcelas;
	for ($i = 1; $i <= $parcelas; $i++) {

		$resto_conta = $valor - $novo_valor * $parcelas;

		if ($i == $parcelas) {
			$novo_valor = $novo_valor + $resto_conta;
		}


		$query = $pdo->prepare("INSERT INTO contas_pagar set descricao = :descricao,
		data_emissao = curDate(), vencimento = :data, frequencia = 'Uma Vez', 
		valor = :valor, usuario_lanc = '$id_usuario', status = 'Pendente', 
		id_compra = '-1', arquivo = 'sem-foto.jpg'");
		$query->bindValue(":valor", "$novo_valor");
		$query->bindValue(":descricao", "Parcela " . $i);
		$query->bindValue(":data", "$data");
		$query->execute();

		$data = date('Y/m/d', strtotime("+1 month", strtotime($data)));
	}
}

echo 'Inserido com Sucesso!';
