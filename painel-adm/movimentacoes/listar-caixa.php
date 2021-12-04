<?php
require_once("../../conexao.php");
$pagina = 'movimentacoes';

$busca = @$_POST['busca'];
if ($busca == "") {
    $busca = 'Caixa';
}

$total_saldo_geral = 0;
$total_saldo_geralF = 0;

//TRAZER O  SALDO GERAL
$query_t = $pdo->query("SELECT * from $pagina  where lancamento = '$busca' order by id desc");
$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
if (@count($res_t) > 0) {
    for ($i_t = 0; $i_t < @count($res_t); $i_t++) {
        foreach ($res_t[$i_t] as $key => $value) {
        }
        $data_primeiro_reg = $res_t[$i_t]['data'];

        $total_saldo_geral +=  $res_t[$i_t]['valor'];
    }
    if ($total_saldo_geral < 0) {
        $classe_saldo_geral = 'text-danger';
    } else {
        $classe_saldo_geral = 'text-success';
    }
    $total_saldo_geralF = number_format($total_saldo_geral, 2, ',', '.');
}

$tipo = '%' . @$_POST['tipo'] . '%';
$movimento = '%' . @$_POST['movimento'] . '%';
$doc = '%' . @$_POST['status'] . '%';


$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$alterou_data = @$_POST['alterou_data'];

if ($dataInicial == "") {
    $dataInicial = date('Y-m-d');
}

if ($dataFinal == "") {
    $dataFinal = date('Y-m-d');
}


$query = $pdo->query("SELECT * from $pagina where (data >= '$dataInicial' and data <= '$dataFinal') 
and documento LIKE '$doc' and lancamento = '$busca' and tipo LIKE '$tipo' and movimento LIKE '$movimento'
 order by data asc, id desc ");


$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {

    echo <<<HTML
<table id="example2" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>Data</th>	
<th>Movimento</th>		
<th>Documento</th>
<th>Plano Conta</th>
<th>Usuário</th>
<th>Valor</th>		
<th>Saldo</th>	

</tr>
</thead>
<tbody>
HTML;

    $total_saldo = 0;
    $total_saldoF = 0;




    for ($i = 0; $i < @count($res); $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id = $res[$i]['id'];
        $cp1 = $res[$i]['tipo'];
        $cp2 = $res[$i]['movimento'];
        $cp3 = $res[$i]['descricao'];
        $cp4 = $res[$i]['valor'];
        $cp5 = $res[$i]['usuario'];
        $cp6 = $res[$i]['data'];
        $cp7 = $res[$i]['lancamento'];
        $cp8 = $res[$i]['plano_conta'];
        $cp9 = $res[$i]['documento'];


        $total_saldo_periodo = 0;
        $total_saldo_periodoF = 0;

        //TRAZER O SALDO GERAL
        $query_t = $pdo->query("SELECT * from $pagina where lancamento = '$busca' and data >= '$data_primeiro_reg' and data <= '$cp6' 
        order by data asc, id desc");
        $res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
        if (@count($res_t) > 0) {
            for ($i_t = 0; $i_t < @count($res_t) and $id != $res_t[$i_t]['id']; $i_t++) {
                foreach ($res_t[$i_t] as $key => $value) {
                }

                if ($res_t[$i_t]['tipo'] == 'Entrada') {
                    $total_saldo_periodo += $res_t[$i_t]['valor'];
                } else {
                    $total_saldo_periodo -= $res_t[$i_t]['valor'];
                }
            }
        }


        if ($cp1 == 'Entrada') {
            $classe = 'text-success';
            $total_saldo += $cp4;
            $total_saldo_periodo = $total_saldo_periodo + $cp4;
        } else {
            $classe = 'text-danger';
            $total_saldo -= $cp4;
            $total_saldo_periodo = $total_saldo_periodo - $cp4;
        }

        if ($total_saldo < 0) {
            $classe_saldo = 'text-danger';
        } else {
            $classe_saldo = 'text-success';
        }



        if ($total_saldo_periodo < 0) {
            $classe_saldo_periodo = 'text-danger';
        } else {
            $classe_saldo_periodo = 'text-success';
        }


        $query1 = $pdo->query("SELECT * from usuarios where id = '$cp5' ");
        $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        if (@count($res1) > 0) {
            $nome_usu = $res1[0]['nome'];
        }



        $data = implode('/', array_reverse(explode('-', $cp6)));
        $valor = number_format($cp4, 2, ',', '.');
        $total_saldoF = number_format($total_saldo, 2, ',', '.');
        $total_saldo_periodoF = number_format($total_saldo_periodo, 2, ',', '.');




        echo <<<HTML
	<tr>
    
	<td><i class="bi bi-square-fill $classe"></i>&nbsp;&nbsp;{$data}</td>	
	<td>{$cp2}</td>	
	<td>{$cp9}</td>	
	<td>{$cp8}</td>	
	<td>{$nome_usu}</td>
    <td class="{$classe}">R$ {$valor}</td>	
	<td class="{$classe_saldo_periodo}">R$ {$total_saldo_periodoF}</td>	
	</tr>
HTML;
    }
    echo <<<HTML
</tbody>
</table>
<div class="my-3 " align="right">
  <strong>  Saldo por Período:</strong>  <span class="$classe_saldo"> R$ {$total_saldoF}</span>
</div>
HTML;
} else {
    echo '<div class="d-flex justify-content-center"> <strong> Nenhum registro foi encontrado nessa data inserida!</strong></div>';
}
?>

<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "ordering": false
        });

        $('#total_itens').removeClass();
        $('#icone_total').removeClass();

        var classe_saldo_geral = '<?= $classe_saldo_geral ?>';

        $('#total_itens').addClass(classe_saldo_geral);
        $('#icone_total').addClass(classe_saldo_geral);
        $('#total_itens').text('R$ <?= $total_saldo_geralF ?>');
    });



    function mostrarDados(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9) {

        $('#campo1').text(cp1);
        $('#campo2').text(cp2);
        $('#campo3').text(cp3);
        $('#campo4').text(cp4);
        $('#campo5').text(cp5);
        $('#campo6').text(cp6);
        $('#campo7').text(cp7);
        $('#campo8').text(cp8);
        $('#campo9').text(cp9);


        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();

    }
</script>