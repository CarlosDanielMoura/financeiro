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
<th>{$campo3}</th>
<th>{$campo4}</th>
<th>{$campo5}</th>
<th>CPF / CNPJ</th>
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
    $campoTd1 = $res[$i]['banco'];
    $campoTd2 = $res[$i]['agencia'];
    $campoTd3 = $res[$i]['conta'];
    $campoTd4 = $res[$i]['tipo'];
    $campoTd5 = $res[$i]['pessoa'];
    $campoTd6 = $res[$i]['doc'];
echo <<<HTML
            <tr>
            <td>{$campoTd1}</td>
            <td>{$campoTd2}</td>
            <td>{$campoTd3}</td>
            <td>{$campoTd4}</td>
            <td>{$campoTd5}</td>
            <td>{$campoTd6}</td>
            <td>
            <a href="#" onclick="editar('{$id}' , '{$campoTd1}' , '{$campoTd2}', '{$campoTd3}' , '{$campoTd4}', '{$campoTd5}' , '{$campoTd6}')" title="Editar Registro"> <i class="bi bi-pencil-square text-primary"></i></a>
            <a href="#" onclick="excluir('{$id}' , '{$campoTd1}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
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

    function editar(id, cp1, cp2, cp3, cp4, cp5, cp6) {
        $('#id').val(id);
        $('#<?= $campo1 ?>').val(cp1);
        $('#<?= $campo2 ?>').val(cp2);
        $('#<?= $campo3 ?>').val(cp3);
        $('#<?= $campo4 ?>').val(cp4);
        $('#<?= $campo5 ?>').val(cp5);
        $('#<?= $campo6 ?>').val(cp6);

        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');
        $('#<?= $campo2 ?>').val('');
        $('#<?= $campo3 ?>').val('');
        $('#<?= $campo6 ?>').val('');

        $('#mensagem').text('');

    }
</script>