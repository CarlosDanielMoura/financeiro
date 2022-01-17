<?php 
require_once("../../conexao.php");
require_once("campos.php");

$id = $_POST['id'];

echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-2">
<thead>
<tr>
<th>Codigo</th>
<th>Produto</th>
<th>Quantidade</th>
<th>Valor</th>
<th>Total</th>

</tr>
</thead>
<tbody>
HTML;




$query = $pdo->query("SELECT * from itens_venda where id_venda = '$id' order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){} 

		$id = $res[$i]['id'];
		$produto = $res[$i]['produto'];
		$quantidade = $res[$i]['quantidade'];		
		$valor = $res[$i]['valor'];
		$total = $res[$i]['total'];

	

		$valor = number_format($valor, 2, ',', '.');
		$total = number_format($total, 2, ',', '.');

			
		$res_cli = $pdo->query("SELECT * from produtos where id = '$produto'");
		$dados_cli = $res_cli->fetchAll(PDO::FETCH_ASSOC);
		$linhas_cli = count($dados_cli);
		$nome_produto = $dados_cli[0]['nome'];	

		$res_cli = $pdo->query("SELECT * from produtos where id = '$produto'");
		$dados_cli = $res_cli->fetchAll(PDO::FETCH_ASSOC);
		$linhas_cli = count($dados_cli);
		$nome_codigo = $dados_cli[0]['codigo'];			
			

			
echo <<<HTML
	<tr>
	<td>{$nome_codigo}</td>
	<td>{$nome_produto}</td>		
	<td>{$quantidade}</td>		
	<td>R$ {$valor}</td>	
	<td>R$ {$total}</td>	
	</tr>
HTML;
} 
echo <<<HTML
</tbody>
</table>
HTML;
