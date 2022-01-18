<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = $pdo->query("SELECT * from contas_receber where id_venda = '-1' and
 usuario_lanc = '$id_usuario' order by id asc ");

$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {

	echo <<<HTML
<hr>
<table id="example-parc" class="table table-hover my-4">
<thead>
<tr>
<th style="width:30%" >Parcela</th>
<th style="width:42%">Valor</th>	
<th style="width:35%">Vencimento</th>				
</tr>
</thead>
<tbody>
HTML;

	for ($i = 0; $i < @count($res); $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$valor = $res[$i]['valor'];
		$vencimento = $res[$i]['vencimento'];
		$id = $res[$i]['vencimento'];
		//$vencimento = implode('/', array_reverse(explode('-', $vencimento)));
		//$valor = number_format($valor, 2, ',', '.');

		echo <<<HTML
	<tr><td>{$res[$i]['descricao']}</td>	
	<td><input class="form-control form-control-sm" type="text" name="valor" id="valor-da-parc{$i}" onkeyup="alterarParcela({$id}, {$i})" value="{$valor}" style="width:120px"></td>	
	<td><input class="form-control form-control-sm" type="date" name="data" id="data-da-parc{$i}" onchange="alterarParcela({$id}, {$i})" value="{$vencimento}" style="width:200px"></td>		
	</tr>
HTML;
	}
	echo <<<HTML
</tbody>
</table>
HTML;
}
