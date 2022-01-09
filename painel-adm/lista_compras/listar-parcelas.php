<?php
require_once("../../conexao.php");
require_once("campos.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * from contas_pagar where id_compra = '$id' order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if (@count($res) > 0) {
	echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>Descrição</th>
<th>Valor</th>
<th>Vencimento</th>	
<th>Pago</th>	
</tr>
</thead>
<tbody>
HTML;


	$query = $pdo->query("SELECT * from contas_pagar where id_compra = '$id' order by id asc ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	for ($i = 0; $i < @count($res); $i++) {
		foreach ($res[$i] as $key => $value) {
		}

		$id = $res[$i]['id'];
		$descricao = $res[$i]['descricao'];
		$vencimento = $res[$i]['vencimento'];
		$valor = $res[$i]['valor'];
		$status = $res[$i]['status'];

		if ($status == 'Paga') {
			$classe = 'text-success';
		} else {
			$classe = 'text-danger';
		}

		$valor = number_format($valor, 2, ',', '.');

		$vencimento = implode('/', array_reverse(explode('-', $vencimento)));


		echo <<<HTML
	<tr>
	<td>
	<i class="bi bi-square-fill $classe"></i>
	{$descricao}
	</td>		
	<td>R$ {$valor}</td>	
	<td>{$vencimento}</td>	
	<td>{$status}</td>	
	</tr>
HTML;
	}
	echo <<<HTML
</tbody>
</table>
HTML;
}
