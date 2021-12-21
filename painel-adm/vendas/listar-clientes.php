<?php
require_once("../../conexao.php");
require_once("../clientes/campos.php");
$pagina = 'clientes';

echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>{$campo1}</th>
<th>CPF / CNPJ</th>	
<th>{$campo11}</th>				
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;


$query = $pdo->query("SELECT * from $pagina where ativo = 'Sim' order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $id = $res[$i]['id'];
    $cp1 = $res[$i]['nome'];
    $cp2 = $res[$i]['pessoa'];
    $cp3 = $res[$i]['doc'];
    $cp4 = $res[$i]['telefone'];
    $cp5 = $res[$i]['endereco'];
    $cp6 = $res[$i]['ativo'];
    $cp7 = $res[$i]['obs'];
    $cp8 = $res[$i]['banco'];
    $cp9 = $res[$i]['agencia'];
    $cp10 = $res[$i]['conta'];
    $cp11 = $res[$i]['email'];

    if ($cp6 == 'Sim') {
        $classe = 'text-success';
        $ativo = 'Desativar Cliente';
        $icone = 'bi-check-square';
        $ativar = 'Não';
        $inativa = '';
    } else {
        $classe = 'text-danger';
        $ativo = 'Ativar Cliente';
        $icone = 'bi-square';
        $ativar = 'Sim';
        $inativa = 'text-muted';
    }

    echo <<<HTML
	<tr class="{$inativa}">
	<td>
	
	{$cp1}
	</td>		
	
	<td>{$cp3}</td>	
	<td>{$cp11}</td>	
							
	<td>
	
	<a href="#" onclick="selecionarCliente('{$id}', '{$cp1}')" title="Selecionar Cliente">
	<i class="bi bi-check-square-fill text-success"></i></a>
	
	</td>
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
        $('#example').DataTable({
            "ordering": false,
            "lengthMenu": [
                [5, 8, 10, -1],
                [5, 8, 10, "Todos"]
            ]
        });

    });


    function selecionarCliente(id, nome) {
        $('#id-cliente').val(id);
        var nomeTitle = nome.toUpperCase();
        $('#nome-cliente').text(nomeTitle);
        $('#nome-cliente-in').val(nome);

    }
</script>