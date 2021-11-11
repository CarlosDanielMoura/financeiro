<?php

require_once("../../conexao.php");
require_once("campos.php");
//Variavies dos inputs



echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>Status</th>
<th>Data Ab</th>
<th>Valor Ab</th>
<th>Usuário Ab</th>
<th>Data de Fech</th>
<th>Valor de Fech</th>
<th>{$campo7}</th>
<th>Usuário de fech</th>
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
    $cp1 = $res[$i]['data_ab'];
    $cp2 = $res[$i]['valor_ab'];
    $cp3 = $res[$i]['usuario_ab'];
    $cp4 = $res[$i]['data_fec'];
    $cp5 = $res[$i]['valor_fec'];
    $cp6 = $res[$i]['usuario_fec'];
    $cp7 = $res[$i]['saldo'];
    $cp8 = $res[$i]['status'];



    if ($cp8 == 'Aberto') {
        $classe = 'text-success';
    } else {
        $classe = 'text-danger';
    }

    if ($cp7 > 0) {
        $classe_saldo = 'text-success';
    } else if ($cp7 < 0) {
        $classe_saldo = 'text-danger';
    } else {
        $classe_saldo = 'text-primary';
    }

    //USUÁRIO ABERTURA
    $query2 = $pdo->query("SELECT * from usuarios where id = '$cp3'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res2) > 0) {
        $nome_usu_ab = $res2[0]['nome'];
    } else {
        $nome_usu_ab = 'Sem nome';
    }

    //USUÁRIO FECHAMENTO
    $query3 = $pdo->query("SELECT * from usuarios where id = '$cp6'");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res3) > 0) {
        $nome_usu_fec = $res3[0]['nome'];
    } else {
        $nome_usu_fec = 'Sem Usuário';
    }

    //CONVERTENDO DATA

    $data_ab = implode('/', array_reverse(explode('-', $cp1)));
    $data_fec = implode('/', array_reverse(explode('-', $cp4)));

    // Convertendo VALOR FORMATO

    $valor_ab = number_format($cp2, 2, ',', '.');
    $valor_fec = number_format($cp5, 2, ',', '.');
    $saldo = number_format($cp7, 2, ',', '.');

    echo <<<HTML
            <tr>
            <td><i class="bi bi-square-fill $classe"></i></td>	
            <td>{$data_ab}</td>
            <td>R$ {$valor_ab}</td>
            <td>{$nome_usu_ab}</td>
            <td>{$data_fec}</td>
            <td>R$ {$valor_fec}</td>
            <td class="{$classe_saldo}">R$ {$saldo}</td>
            <td>{$nome_usu_fec}</td>
            <td>
            <a href="#" onclick="editar('{$id}' , '{$cp2}')" title="Editar Registro"> <i class="bi bi-pencil-square text-primary"></i></a>
            <a href="#" onclick="excluir('{$id}' , '{$cp2}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
            <a href="#" onclick="fechar('{$id}' , '{$data_ab}')" title="Fechar Caixa">	<i class="bi bi-x-octagon-fill text-success"></i> </a>
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

    function editar(id, cp2) {
        $('#id').val(id);

        $('#<?= $campo2 ?>').val(cp2);

        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }



    function limparCampos() {
        $('#id').val('');
        $('#<?= $campo2 ?>').val('');

        $('#mensagem').text('');

    }


    function fechar(id, cp1) {

        $('#id-fechar').val(id);
        $('#data_abert').text(cp1);

        $('#tituloModal').text('Fechar Caixa');
        var myModal = new bootstrap.Modal(document.getElementById('modalFecharCaixa'), {});
        myModal.show();
        $('#mensagem-fechar').text('');
    }
</script>