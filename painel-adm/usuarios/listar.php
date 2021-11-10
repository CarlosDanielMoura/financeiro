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
<th>Nível</th>
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
    $campoTd1 = $res[$i]['nome'];
    $campoTd2 = $res[$i]['email'];
    $campoTd3 = $res[$i]['nivel'];
    $campoTd4 = $res[$i]['senha'];
echo <<<HTML
            <tr>
            <td>{$campoTd1}</td>
            <td>{$campoTd2}</td>
            <td>{$campoTd3}</td>
            <td>
            <a href="#" onclick="editar('{$id}' , '{$campoTd1}' , '{$campoTd2}', '{$campoTd4}' , '{$campoTd3}')" title="Editar Registro"> <i class="bi bi-pencil-square text-primary"></i></a>
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

    function editar(id, nome, email, senha, nivel) {
        $('#id').val(id);
        $('#<?= $campo1 ?>').val(nome);
        $('#<?= $campo2 ?>').val(email);
        $('#<?= $campo3 ?>').val(senha);
        $('#<?= $campo4 ?>').val(nivel);

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

        $('#mensagem').text('');

    }
</script>