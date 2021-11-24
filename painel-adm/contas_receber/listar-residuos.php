<?php
require_once("../../conexao.php");

$id = $_POST['id'];

echo <<<HTML
<table id="example_res" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>Valor</th>
<th>Data</th>								
<th>Usuário</th>
</tr>
</thead>
<tbody>
HTML;


$query = $pdo->query("SELECT * from valor_parcial where id_conta = '$id' order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $valor = $res[$i]['valor'];
    $data = $res[$i]['data'];
    $usuario = $res[$i]['usuario'];

    $query2 = $pdo->query("SELECT * from usuarios where id = '$usuario'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $nome_usuario = $res2[0]['nome'];

    $data = implode('/', array_reverse(explode('-', $data)));

    $valor = number_format($valor, 2, ',', '.');



    echo <<<HTML
	<tr>
	<td>R$ {$valor}</td>		
	<td>{$data}</td>							
	<td>{$nome_usuario}</td>	
	</tr>
HTML;
}
echo <<<HTML
</tbody>
</table>
HTML;

?>

<script>
    $(document).ready(function() {
        $('#example_res').DataTable({
            "ordering": false
        });

    });
</script>