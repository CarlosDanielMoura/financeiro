<?php
require_once("../../conexao.php");
require_once("campos.php");

echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>{$campo8}</th>
<th>Data Abertura</th>		
<th>Vlr Abertura</th>	
<th>Usuário Ab</th>	
<th>Data Fecham</th>	

<th>Usuário Fec</th>	
<th>Saldo</th>
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

    $cp6 = $res[$i]['usuario_fec'];
    $cp7 = $res[$i]['saldo'];
    $cp8 = $res[$i]['status'];

    if ($cp8 == 'Aberto') {
        $classe = 'text-success';
    } else {
        $classe = 'text-danger';
    }


    //TOTALIZAR O SALDO
    $total_saldo = 0;
    $saldo_final = 0;
    $saldo_finalF = 0;
    $query2 = $pdo->query("SELECT * from movimentacoes where caixa_periodo = '$id'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res2) > 0) {
        for ($i2 = 0; $i2 < @count($res2); $i2++) {
            foreach ($res2[$i2] as $key => $value) {
            }
            $valor = $res2[$i2]['valor'];
            $tipo = $res2[$i2]['tipo'];

            if ($tipo == 'Entrada') {
                $total_saldo += $valor;
            } else {
                $total_saldo -= $valor;
            }
        }
    }

    $saldo_final =  $cp2 + $total_saldo;

    if ($saldo_final > 0) {
        $classe_saldo = 'text-success';
    } else if ($saldo_final < 0) {
        $classe_saldo = 'text-danger';
    } else {
        $classe_saldo = 'text-primary';
    }


    $query1 = $pdo->query("SELECT * from usuarios where id = '$cp3' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res1) > 0) {
        $nome_usu_ab = $res1[0]['nome'];
    } else {
        $nome_usu_ab = 'Sem Usuário';
    }

    $query1 = $pdo->query("SELECT * from usuarios where id = '$cp6' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res1) > 0) {
        $nome_usu_fec = $res1[0]['nome'];
    } else {
        $nome_usu_fec = 'Sem Usuário';
    }

    $data_ab = implode('/', array_reverse(explode('-', $cp1)));
    $data_fec = implode('/', array_reverse(explode('-', $cp4)));

    $valor_ab = number_format($cp2, 2, ',', '.');
    $saldo_finalF = number_format($saldo_final, 2, ',', '.');


    echo <<<HTML
	<tr>
	<td><i class="bi bi-square-fill $classe"></i></td>	
	<td>{$data_ab}</td>		
	<td>R$ {$valor_ab}</td>	
	<td>{$nome_usu_ab}</td>	
	<td>{$data_fec}</td>	
    <td>{$nome_usu_fec}</td>
	<td><a class="{$classe_saldo}" href="#" onclick="movimentos('{$id}' , '{$data_ab}')" title="Ver Movimentações">R$ {$saldo_finalF}</a></td>									
	<td>
	<a href="#" onclick="editar('{$id}', '{$cp2}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
	<a href="#" onclick="excluir('{$id}' , '{$data_ab}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i></a>
	<a href="#" onclick="fechar('{$id}' , '{$data_ab}')" title="Fechar Caixa">	<i class="bi bi-cash text-success"></i></a>
	<a href="#" onclick="movimentos('{$id}' , '{$data_ab}', '{$valor_ab}')" title="Ver Movimentações"><i class="bi bi-calendar-date mx-1 text-secondary"></i> </a>
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

        var myModal = new bootstrap.Modal(document.getElementById('modalFechar'), {});
        myModal.show();
        $('#mensagem-fechar').text('');
    }



    function movimentos(id, cp1, cp2) {

        $('#titulo-movimento').text(cp1);
        $('#valor-abertura').text(cp2);
        $('#id-caixa').val(id);

        $.ajax({
            url: pag + "/listar-movimentos.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "html",

            success: function(result) {
                $("#listar-movimentos").html(result);
            }
        });

        var myModal = new bootstrap.Modal(document.getElementById('modalMovimentos'), {});
        myModal.show();

    }
</script>