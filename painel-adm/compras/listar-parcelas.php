<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = $pdo->query("SELECT * from contas_pagar where id_compra = '-1' and
 usuario_lanc = '$id_usuario' order by id asc ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {

	echo <<<HTML
<hr>
<table id="example-parc" class="table table-hover my-4">
<thead>
<tr>
<th>Parcela</th>
<th>Valor</th>	
<th>Vencimento</th>				
</tr>
</thead>
<tbody>
HTML;

	for ($i = 0; $i < @count($res); $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$valor = $res[$i]['valor'];
		$vencimento = $res[$i]['vencimento'];
		$vencimento = implode('/', array_reverse(explode('-', $vencimento)));
		$valor = number_format($valor, 2, ',', '.');

		echo <<<HTML
	<tr><td>{$res[$i]['descricao']}</td>	
	<td>R$ {$valor}</td>	
	<td>{$vencimento}</td>	
	</tr>
HTML;
	}
	echo <<<HTML
</tbody>
</table>
HTML;
}
