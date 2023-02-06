<?php

require_once("../../conexao.php");
require_once("campos.php");
//Variavies dos inputs
$query = $pdo->query("SELECT * from $pagina order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if (@count($res) > 0) {

    echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr >
<th >{$campo1}</th>
<th >Acões</th>
</tr>
</thead>
<tbody>
HTML;



    for ($i = 0; $i < @count($res); $i++) {
        foreach ($res[$i] as $key => $value) {
        }
        $id = $res[$i]['id'];
        $campoTd1 = $res[$i]['nome'];
        echo <<<HTML
            <tr>
            <td>{$campoTd1}</td>
            <td >
            <a href="#" onclick="editar('{$id}' , '{$campoTd1}')" title="Editar Registro"> <i class="bi bi-pencil-square text-primary"></i></a>
            <a href="#" onclick="excluir('{$id}' , '{$campoTd1}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
            </td class="">
            </tr>
HTML;
    }
    echo <<<HTML
</tbody>
</table>
HTML;
} else {
    echo '<div class="d-flex justify-content-center"> <strong> Nenhum Registro foi Encontrado!</strong></div>';
}
?>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false
        });
    });


    /*Funcão editar Usuário */

    function editar(id, nome) {
        $('#id').val(id);
        $('#<?= $campo1 ?>').val(nome);
        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');
        $('#<?= $campo1 ?>').val('');
        $('#mensagem').text('');

    }
</script>