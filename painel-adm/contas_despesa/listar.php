<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$nivel_usu = $_SESSION['nivel_usuario'];

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$alterou_data = @$_POST['alterou_data'];

$data_hoje = date('Y-m-d');

if ($alterou_data == 'Sim') {

    $query = $pdo->query("SELECT * from $pagina where (data >= '$dataInicial' and data <= '$dataFinal') order by id desc ");
} else {
    $query = $pdo->query("SELECT * from $pagina order by id desc ");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {

    echo <<<HTML
<table id="example2" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>Descrição</th>
<th>Valor</th>		
<th>Data</th>	
<th>Usuário</th>	
<th>Lançamento</th>	
<th>Tipo PGTO</th>	
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;

    $total_valor = 0;
    $total_valorF = 0;

    for ($i = 0; $i < @count($res); $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id = $res[$i]['id'];
        $cp1 = $res[$i]['descricao'];
        $cp2 = $res[$i]['valor'];
        $cp3 = $res[$i]['data'];
        $cp4 = $res[$i]['usuario'];
        $cp5 = $res[$i]['lancamento'];
        $cp6 = $res[$i]['documento'];

        $total_valor += $cp2;
        $total_valorF = number_format($total_valor, 2, ',', '.');

        $query1 = $pdo->query("SELECT * from usuarios where id = '$cp4' ");
        $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        if (@count($res1) > 0) {
            $nome_usu = $res1[0]['nome'];
        }


        $data = implode('/', array_reverse(explode('-', $cp3)));
        $valor = number_format($cp2, 2, ',', '.');



        echo <<<HTML
	<tr>
	<td>{$cp1}</td>	
	<td>R$ {$valor}</td>	
	<td>{$data}</td>	
	<td>{$nome_usu}</td>	
	<td>{$cp5}</td>	
	<td>{$cp6}</td>
	<td>
	<a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
	<a href="#" onclick="excluir('{$id}' , '{$cp1}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
		
	</td>
	</tr>
HTML;
    }
    echo <<<HTML
</tbody>
</table>
HTML;
} else {
    echo '<div class="d-flex justify-content-center "><strong> Nenhum Registro foi Encontrado!</strong></div>';;
}
?>

<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "ordering": false
        });

        /* $('#total_itens').text('R$ <?= $total_valorF ?>');*/
    });


    function editar(id, cp1, cp2, cp3) {

        $('#id').val(id);
        $('#<?= $campo1 ?>').val(cp1);
        $('#<?= $campo2 ?>').val(cp2);
        $('#<?= $campo3 ?>').val(cp3);


        var usuario = "<?= $nivel_usu ?>";
        if (usuario != 'Administrador') {
            document.getElementById("<?= $campo2 ?>").readOnly = true;
        }



        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');

        $('#<?= $campo1 ?>').val('');
        $('#<?= $campo2 ?>').val('');

        document.getElementById("<?= $campo2 ?>").readOnly = false;
        listarClientes();

        //DEFINIR ABA A SER ABERTA
        var someTabTriggerEl = document.querySelector('#home-tab')
        var tab = new bootstrap.Tab(someTabTriggerEl);
        tab.show();
    }
</script>