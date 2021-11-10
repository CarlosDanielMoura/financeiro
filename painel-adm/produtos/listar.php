<?php

require_once("../../conexao.php");
require_once("campos.php");
//Variavies dos inputs

@session_start();

if (@$_SESSION['estoque'] == 'sim') {
    $query = $pdo->query("SELECT * from $pagina where estoque < '$nivel_minimo_estoque' order by id desc ");
} else {
    $query = $pdo->query("SELECT * from $pagina order by id desc ");
}


echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>{$campo2}</th>
<th>{$campo2}</th>
<th>Descrição</th>
<th>{$campo4}</th>	
<th>Valor Venda</th>
<th>{$campo7}</th>	
<th>{$campo8}</th>	
<th>{$campo9}</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;


$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $id = $res[$i]['id'];
    $cp1 = $res[$i]['codigo'];
    $cp2 = $res[$i]['nome'];
    $cp3 = $res[$i]['descricao'];
    $cp4 = $res[$i]['estoque'];
    $cp5 = $res[$i]['valor_compra'];
    $cp6 = $res[$i]['valor_venda'];
    $cp7 = $res[$i]['fornecedores'];
    $cp8 = $res[$i]['categoria'];
    $cp9 = $res[$i]['foto'];
    $cp10 = $res[$i]['ativo'];
    $cp11 = $res[$i]['lucro'];

    $valor_compra = number_format($cp5, 2, ',', '.');
    $valor_venda = number_format($cp6, 2, ',', '.');


    $query1 = $pdo->query("SELECT * from fornecedores where id = '$cp7' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res1) > 0) {
        $nome_forn = $res1[0]['nome'];
    } else {
        $nome_forn = 'Sem Fornecedor';
    }


    $query2 = $pdo->query("SELECT * from cat_produtos where id = '$cp8'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $nome_cat = $res2[0]['nome'];



    if ($cp10 == 'Sim') {
        $ativo = 'Desativar Produto';
        $icone = 'bi-check-square';
        $ativar = 'Não';
        $inativa = '';
    } else {
        $ativo = 'Ativar Produto';
        $icone = 'bi-square';
        $ativar = 'Sim';
        $inativa = 'text-muted';
    }

    if ($cp4 >= $nivel_minimo_estoque) {
        $classe = 'text-success';
    } else {
        $classe = 'text-danger';
    }
    echo <<<HTML
            <tr class="{$inativa}">
            <td><i class="bi bi-square-fill $classe"></i> {$cp1}</td>	
	        <td>{$cp2}</td>	
            <td>{$cp3}</td>	
	        <td>{$cp4}</td>	
	        <td>R$ {$cp6}</td>	
	        <td>{$nome_forn}</td>	
	        <td>{$nome_cat}</td>	
	        <td><img src="../img/{$pagina}/{$cp9}" width="40px"></td>	
            <td>
            <a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}', '{$cp10}')" title="Editar Registro"><i class="bi bi-pencil-square text-primary"></i></a>
            <a href="#" onclick="excluir('{$id}' , '{$cp2}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
            <a href="#" onclick="mudarStatus('{$id}', '{$ativar}')" title="{$ativo}"><i class="bi {$icone} text-secondary"></i></a>
            <a href="#" class="mx-1" onclick="mostrarDados('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$nome_forn}', '{$nome_cat}', '{$cp9}', '{$cp10}')" title="Ver Dados do Cliente"><i class="bi bi-info-square"></i></a>
            <a href="#" class="" onclick="comprarProduto('{$id}', '{$cp2}', '{$cp11}')" title="Comprar Produto"><i class="bi bi-cash text-success"></i></a>
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
            "ordering": false
        });
    });


    /*Funcão editar Usuário */

    function editar(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10) {
        $('#id').val(id);
        $('#<?= $campo1 ?>').val(cp1);
        $('#<?= $campo2 ?>').val(cp2);
        $('#<?= $campo3 ?>').val(cp3);


        $('#<?= $campo6 ?>').val(cp6);

        $('#<?= $campo8 ?>').val(cp8);
        $('#target').attr('src', '../img/' + pag + '/' + cp9);
        $('#<?= $campo10 ?>').val(cp10);


        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');
        $('#<?= $campo1 ?>').val('');
        $('#<?= $campo2 ?>').val('');
        $('#<?= $campo3 ?>').val('');
        $('#<?= $campo5 ?>').val('');
        $('#<?= $campo6 ?>').val('');
        $('#<?= $campo9 ?>').val('');
        $('#target').attr('src', '../img/' + pag + '/sem-foto.jpg');
        $('#quantidade').val('');
        $('#mensagem').text('');

    }



    function mostrarDados(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10) {

        $('#campo1').text(cp1);
        $('#campo2').text(cp2);
        $('#campo3').text(cp3);
        $('#campo4').text(cp4);
        $('#campo5').text(cp5);
        $('#campo6').text(cp6);
        $('#campo7').text(cp7);
        $('#campo8').text(cp8);
        $('#imagem_dados').attr('src', '../img/' + pag + '/' + cp9);
        $('#campo10').text(cp10);



        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();

    }



    function comprarProduto(id, lucro) {

        function comprarProduto(id, nome, lucro) {

            $('#id-comprar').val(id);
            $('#nome-comprar').text(nome);
            $('#<?= $campo11 ?>').val(lucro);

            var myModal = new bootstrap.Modal(document.getElementById('modalComp'), {});
            myModal.show();

            $('#mensagem-comprar').text('');
            limparCampos();
        }
    }
</script>