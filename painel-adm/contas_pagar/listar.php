<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$nivel_usu = $_SESSION['nivel_usuario'];

$dataInicial = @$_POST['dataInicial'];

$dataFinal = @$_POST['dataFinal'];

$status = '%' . @$_POST['status'] . '%';





//CONDIÇÃO PARA FAZER A FILTRAGEM DE DATAS
if ($dataInicial != "" || $dataFinal != "") {
    $query = $pdo->query("SELECT * from $pagina where (vencimento >= '$dataInicial' 
    and vencimento <= '$dataFinal') and status LIKE '$status' order by id desc ");
} else {
    $query = $pdo->query("SELECT * from $pagina order by id desc ");
}


echo <<<HTML
<table id="example2" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>Descrição</th>
<th>Saída</th>		
<th>Plano de Conta</th>	
<th>Emissão</th>	
<th>Vencimento</th>	
<th>Documento</th>	
<th>Valor</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;

$total_valor = 0;
$total_valorF = 0;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $id = $res[$i]['id'];
    $cp1 = $res[$i]['descricao'];
    $cp2 = $res[$i]['cliente'];
    $cp3 = $res[$i]['saida'];
    $cp4 = $res[$i]['documento'];
    $cp5 = $res[$i]['plano_conta'];
    $cp6 = $res[$i]['data_emissao'];
    $cp7 = $res[$i]['vencimento'];
    $cp8 = $res[$i]['frequencia'];
    $cp9 = $res[$i]['valor'];
    $cp10 = $res[$i]['usuario_lanc'];
    $cp11 = $res[$i]['usuario_baixa'];
    $cp12 = $res[$i]['caixa'];
    $cp13 = $res[$i]['status'];

    if ($cp13 == 'Paga') {
        $classe = 'text-success';
    } else if ($cp13 == 'Parcial') {
        $classe = 'text-warning';
    } else {
        $classe = 'text-danger';
        $total_valor += $cp9;
        $total_valorF = number_format($total_valor, 2, ',', '.');
    }



    $query1 = $pdo->query("SELECT * from usuarios where id = '$cp10' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res1) > 0) {
        $nome_usu_lanc = $res1[0]['nome'];
    } else {
        $nome_usu_lanc = 'Sem Usuário';
    }

    $query1 = $pdo->query("SELECT * from usuarios where id = '$cp11' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res1) > 0) {
        $nome_usu_baixa = $res1[0]['nome'];
    } else {
        $nome_usu_baixa = 'Sem Usuário';
    }

    $query1 = $pdo->query("SELECT * from clientes where id = '$cp2' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res1) > 0) {
        $nome_cliente = $res1[0]['nome'];
    } else {
        $nome_cliente = 'Sem Cliente';
    }


    $data_emissao = implode('/', array_reverse(explode('-', $cp6)));
    $data_venc = implode('/', array_reverse(explode('-', $cp7)));

    $valor = number_format($cp9, 2, ',', '.');



    echo <<<HTML
	<tr>
	<td>
	<i class="bi bi-square-fill $classe"></i>
	{$cp1}</td>		
	<td>{$cp3}</td>	
	<td>{$cp5}</td>	
	<td>{$data_emissao}</td>	
	<td>{$data_venc}</td>	
	<td>{$cp4}</td>	
	<td>R$ {$valor}</td>	
								
	<td>
	<a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}', '{$nome_cliente}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
	<a href="#" onclick="excluir('{$id}' , '{$cp1}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
	<a class="mx-1" href="#" onclick="mostrarDados('{$id}', '{$cp1}', '{$nome_cliente}', '{$cp3}', '{$cp4}', '{$cp5}', '{$data_emissao}', '{$data_venc}', '{$cp8}', '{$valor}', '{$nome_usu_lanc}', '{$nome_usu_baixa}', '{$cp13}')" title="Ver Dados da Conta">
    <i class="bi bi-exclamation-square text-success"></i></a>
    <a href="#" onclick="parcelar('{$id}' ,'{$cp1}' ,'{$cp9}')" title="Parcelar Conta">	<i class="bi bi-calendar-week text-dark"></i> </a>	
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
        $('#example2').DataTable({
            "ordering": false
        });

        $('#total_itens').text(' R$ <?= $total_valorF ?>');

    });


    function editar(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, nome) {
        $('#id').val(id);
        $('#<?= $campo1 ?>').val(cp1);
        //$('#<?= $campo2 ?>').val(cp2);
        $('#<?= $campo3 ?>').val(cp3);
        $('#<?= $campo4 ?>').val(cp4);

        $('#<?= $campo6 ?>').val(cp6);
        $('#<?= $campo7 ?>').val(cp7);
        $('#<?= $campo8 ?>').val(cp8);
        $('#<?= $campo9 ?>').val(cp9);

        $('#nome-cliente').val(nome);
        $('#id-cliente').val(cp2);


        var plano = cp5.split("-");

        $('#<?= $campo5 ?>').val(plano[0].trim());
        $('#cat_despesas').val(plano[1].trim());
        listarDespesas(plano[1].trim(), plano[0].trim());


        //VERIFICANDO NIVEL USUARIO PARA CAMPO FICAM TRUE OU FALSO
        var usuario = "<?= $nivel_usu ?>";
        if (usuario != 'Administrador') {
            document.getElementById("<?= $campo9 ?>").readOnly = true;
        }



        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');

        $('#<?= $campo1 ?>').val('');
        $('#<?= $campo9 ?>').val('');
        $('#id-cliente').val('');
        $('#nome-cliente').val('');
        $('#mensagem').text('');
        document.getElementById("<?= $campo9 ?>").readOnly = false;
        //LIMPANDO OS CAMPOS DE EXCLUSÃO
        $('#usuario_adm').val('');
        $('#senha_adm').val('');

    }


    function mostrarDados(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10, cp11, cp13) {

        $('#campo1').text(cp1);
        $('#campo2').text(cp2);
        $('#campo3').text(cp3);
        $('#campo4').text(cp4);
        $('#campo5').text(cp5);
        $('#campo6').text(cp6);
        $('#campo7').text(cp7);
        $('#campo8').text(cp8);
        $('#campo9').text(cp9);
        $('#campo10').text(cp10);
        $('#campo11').text(cp11);
        $('#campo13').text(cp13);



        var myModal = new bootstrap.Modal(document.getElementById('modalDadosContaPagar'), {});
        myModal.show();

    }



    /* function mostrarResiduos(id) {

         $.ajax({
             url: pag + "/listar-residuos.php",
             method: 'POST',
             data: {
                 id
             },
             dataType: "html",

             success: function(result) {
                 $("#listar-residuos").html(result);
             }
         });

         var myModal = new bootstrap.Modal(document.getElementById('modalResiduos'), {});
         myModal.show();
         $('#mensagem').text('');
     }*/
</script>