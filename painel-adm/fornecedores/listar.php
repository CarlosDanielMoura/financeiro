<?php

require_once("../../conexao.php");
require_once("campos.php");
//Variavies dos inputs



echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>{$campo1}</th>
<th>{$campo2}</th>
<th>CPF/CNPJ</th>
<th>{$campo11}</th>
<th>{$campo4}</th>
<th>{$campo6}</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;

$query = $pdo->query("SELECT * from $pagina order by id desc ");
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
        $icone = ' bi-check-square';
        $ativar = 'Não';
        $inativa = '';
    } else {
        $classe = 'text-danger';
        $ativo = 'Ativar Cliente';
        $icone = ' bi-square';
        $ativar = 'Sim';
        $inativa = 'text-muted';
    }

echo <<<HTML
            <tr class="{$inativa}">
            <td>
            <i class="bi bi-square-fill $classe"></i>
            {$cp1}
            </td>
            <td>{$cp2}</td>
            <td>{$cp3}</td>
            <td>{$cp11}</td>
            <td>{$cp4}</td>
            <td>{$cp6}</td>
            <td>
            <a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}', '{$cp10}', '{$cp11}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
            <a href="#" onclick="excluir('{$id}' , '{$cp1}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
            <a href="#" onclick="mudarStatus('{$id}', '{$ativar}')" title="{$ativo}"><i class="bi {$icone} text-secondary"></i></a>
            <a href="#" class="mx-1" onclick="mostrarDados('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}', '{$cp10}', '{$cp11}')" title="Ver Dados do Cliente"><i class="bi bi-info-square"></i></i></a>
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
    function editar(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10, cp11) {
        $('#id').val(id);
        $('#<?= $campo1 ?>').val(cp1);
        $('#<?= $campo2 ?>').val(cp2);
        $('#<?= $campo3 ?>').val(cp3);
        $('#<?= $campo4 ?>').val(cp4);
        $('#<?= $campo5 ?>').val(cp5);
        $('#<?= $campo6 ?>').val(cp6);
        $('#<?= $campo7 ?>').val(cp7);


        if (cp8 != "") {
            $('#<?= $campo8 ?>').val(cp8);
        }

        $('#<?= $campo9 ?>').val(cp9);
        $('#<?= $campo10 ?>').val(cp10);
        $('#<?= $campo11 ?>').val(cp11);

        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');
        $('#<?= $campo1 ?>').val('');

        $('#<?= $campo3 ?>').val('');
        $('#<?= $campo4 ?>').val('');
        $('#<?= $campo5 ?>').val('');

        $('#<?= $campo7 ?>').val('');

        $('#<?= $campo9 ?>').val('');
        $('#<?= $campo10 ?>').val('');
        $('#<?= $campo11 ?>').val('');

        $('#mensagem').text('');

    }



    /*Funcão Mostrar Dados Clientes */
    function mostrarDados(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10, cp11) {
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

        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();
        $('#mensagem').text('');
    }
</script>