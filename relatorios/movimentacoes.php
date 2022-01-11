<?php
require_once("../conexao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$tipo = @$_GET['tipo'];
$data_inicial = @$_GET['data_inicial'];
$data_final = @$_GET['data_final'];
$plano_conta = @$_GET['plano_conta'];
$sub_plano_conta = @$_GET['sub_plano_conta'];
$forma_pgto = @$_GET['forma_pgto'];
$tipo_mov = @$_GET['tipo_mov'];
$local_mov = @$_GET['local_mov'];

$tipo = str_replace('-', ' ', $tipo);
$plano_conta = str_replace('-', ' ', $plano_conta);
$sub_plano_conta = str_replace('-', ' ', $sub_plano_conta);
$forma_pgto = str_replace('-', ' ', $forma_pgto);
$local_mov = str_replace('-', ' ', $local_mov);

$tipoL = '%' . $tipo . '%';
if ($plano_conta != "") {
    $plano_contaL = '%' . $sub_plano_conta . ' - ' . $plano_conta . '%';
} else {
    $plano_contaL = '%%';
}
$forma_pgtoL = '%' . $forma_pgto . '%';
$tipo_movL = '%' . $tipo_mov . '%';

$data_inicialF = implode('/', array_reverse(explode('-', $data_inicial)));
$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

if ($tipo != "") {
    $titulo_rel = $tipo;
} else if ($tipo == "" and $plano_conta != "") {
    $titulo_rel = $plano_conta . ' / ' . $sub_plano_conta;
} else if ($tipo == "" and $plano_conta == "" and $forma_pgto != "") {
    $titulo_rel = 'Pagamento em ' . $forma_pgto;
} else {
    if ($tipo_mov != "") {
        $titulo_rel = 'Movimentações de ' . $tipo_mov;
    } else {
        $titulo_rel = 'Movimentações';
    }
}

if ($data_inicial == $data_final) {
    $apuracao = 'Data da Apuração: ' . $data_inicialF;
} else {
    $apuracao = 'Apuração: ' . $data_inicialF . ' à ' . $data_finalF;
}


if ($tipo == 'Compra') {
    $plano_contaL = 'Compra de Produtos';
    $tipoL = '%%';
}

if ($tipo == 'Venda') {
    $plano_contaL = 'Venda';
    $tipoL = '%%';
}




$total_saldo_geral = 0;
$total_saldo_geralF = 0;
//TRAZER O SALDO GERAL
$query_t = $pdo->query("SELECT * from movimentacoes where lancamento = '$local_mov' order by id desc");
$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
if (@count($res_t) > 0) {
    for ($it = 0; $it < @count($res_t); $it++) {
        foreach ($res_t[$it] as $key => $value) {
        }

        $data_primeiro_reg = $res_t[$it]['data'];

        if ($res_t[$it]['tipo'] == 'Entrada') {
            $total_saldo_geral += $res_t[$it]['valor'];
        } else {
            $total_saldo_geral -= $res_t[$it]['valor'];
        }
    }

    if ($total_saldo_geral < 0) {
        $classe_saldo_geral = 'text-danger';
    } else {
        $classe_saldo_geral = 'text-success';
    }

    $total_saldo_geralF = number_format($total_saldo_geral, 2, ',', '.');
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Movimentações</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <style>
        @page {
            margin: 0px;

        }

        body {
            margin-top: 0px;
            font-family: Times, "Times New Roman", Georgia, serif;
        }


        <?php if ($relatorio_pdf == 'Sim') { ?>.footer {
            margin-top: 20px;
            width: 100%;

            padding: 5px;
            position: absolute;
            bottom: 0;

        }

        <?php } else { ?>.footer {
            margin-top: 20px;
            width: 100%;
            background-color: #ebebeb;
            padding: 5px;

        }

        <?php } ?>.cabecalho {
            padding: 10px;
            margin-bottom: 30px;
            width: 100%;
            font-family: Times, "Times New Roman", Georgia, serif;

        }

        .titulo_cab {
            color: #0340a3;
            font-size: 16px;
        }



        .titulo {
            margin: 0;
            font-size: 28px;
            font-family: Arial, Helvetica, sans-serif;
            color: #6e6d6d;

        }

        .subtitulo {
            margin: 0;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            color: #6e6d6d;
        }

        .areaTotais {
            border: 0.5px solid #bcbcbc;
            padding: 15px;
            border-radius: 5px;
            margin-right: 25px;
            margin-left: 25px;
            position: absolute;
            right: 20;
        }

        .areaTotal {
            border: 0.5px solid #bcbcbc;
            padding: 15px;
            border-radius: 5px;
            margin-right: 25px;
            margin-left: 25px;
            background-color: #f9f9f9;
            margin-top: 2px;
        }

        .pgto {
            margin: 1px;
        }

        .fonte13 {
            font-size: 13px;
        }

        .esquerda {
            display: inline;
            width: 50%;
            float: left;
        }

        .direita {
            display: inline;
            width: 50%;
            float: right;
        }

        .table {
            padding: 15px;
            font-family: Verdana, sans-serif;
            margin-top: 20px;
        }

        .texto-tabela {
            font-size: 12px;
        }


        .esquerda_float {

            margin-bottom: 10px;
            float: left;
            display: inline;
        }


        .titulos {
            margin-top: 10px;
        }

        .image {
            margin-top: -10px;
        }

        .margem-direita {
            margin-right: 80px;
        }

        .margem-direita50 {
            margin-right: 50px;
        }

        hr {
            margin: 8px;
            padding: 0px;
        }


        .titulorel {
            margin: 0;
            font-size: 25px;
            font-family: Arial, Helvetica, sans-serif;
            color: #6e6d6d;

        }

        .margem-superior {
            margin-top: 30px;
        }

        .areaSubtituloCab {
            margin-top: 15px;
            margin-bottom: 15px;
        }




        .area-tab {

            display: block;
            width: 100%;
            height: 30px;

        }


        .area-cab {

            display: block;
            width: 100%;
            height: 10px;

        }


        .coluna {
            margin: 0px;
            float: left;
            height: 30px;
        }


        hr .hr-table {

            padding: 2px;
            margin: 0px;
        }

        .titulo-cardapio {
            width: 100%;
            background-color: #f7f7f7;
            padding: 3px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 10px;
        }
    </style>


</head>

<body>


    <section class="area-cab">
        <div class="cabecalho">
            <div class="coluna titulo_cab" style="width:70%"> <u>Relatório de <?php echo $titulo_rel ?> do <?php echo $local_mov ?></u></div>
            <div align="right" class="coluna" style="width:30%"> <?php echo mb_strtoupper($nome_sistema) ?></div>
        </div>
    </section>

    <br>

    <section class="area-cab">
        <div class="cabecalho">
            <div class="coluna" style="width:60%"><small> <small><?php echo $apuracao ?></small></small></div>
            <div align="right" class="coluna" style="width:40%"><small> <small><small> <?php echo mb_strtoupper($data_hoje) ?></small></small></small></div>
        </div>
    </section>

    <br>
    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>



    <div class="mx-2" style="padding-top:15px ">

        <div class="mb-2 mx-2 <?php echo $classe_saldo_geral ?>" align="right"><small><small>Saldo Total: R$ <?php echo $total_saldo_geralF ?></small></small></div>

        <small><small><small>
                    <section class="area-tab" style="background-color: #f5f5f5;">

                        <div class="linha-cab" style="padding-top: 5px;">
                            <div class="coluna" style="width:10%">DATA</div>
                            <div class="coluna" style="width:25%">MOVIMENTO</div>
                            <div class="coluna" style="width:10%">DOCUMENTO</div>
                            <div class="coluna" style="width:20%">PLANO CONTA</div>
                            <div class="coluna" style="width:15%">USUÁRIO</div>
                            <div class="coluna" style="width:10%">VALOR</div>
                            <div class="coluna" style="width:10%">SALDO</div>


                        </div>

                    </section><small></small>

                    <div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
                    </div>

                    <?php

                    $query = $pdo->query("SELECT * from movimentacoes where (data >= '$data_inicial' and data <= '$data_final') and documento LIKE '$forma_pgtoL' and lancamento = '$local_mov' and tipo LIKE '$tipo_movL' and movimento LIKE '$tipoL' and plano_conta LIKE '$plano_contaL' order by data asc, id asc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $totalItens = @count($res);

                    if ($totalItens == 0) {
                        echo 'Não possui movimentações nesse período';
                    }

                    $total_saldo = 0;
                    $total_saldoF = 0;

                    $total_entradas = 0;
                    $total_entradasF = 0;

                    $total_saidas = 0;
                    $total_saidasF = 0;

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
                        $contador = $i + 1;

                        //TRAZER O SALDO GERAL
                        $query_t = $pdo->query("SELECT * from movimentacoes where lancamento = '$local_mov' and data >= '$data_primeiro_reg' and data <= '$cp6' order by data asc, id asc");
                        $res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res_t) > 0) {
                            for ($it = 0; $it < @count($res_t) and $id != $res_t[$it]['id']; $it++) {
                                foreach ($res_t[$it] as $key => $value) {
                                }

                                if ($res_t[$it]['tipo'] == 'Entrada') {
                                    $total_saldo_periodo += $res_t[$it]['valor'];
                                } else {
                                    $total_saldo_periodo -= $res_t[$it]['valor'];
                                }
                            }
                        }


                        if ($cp1 == 'Entrada') {
                            $classe = 'text-success';
                            $total_saldo += $cp4;
                            $total_saldo_periodo = $total_saldo_periodo + $cp4;
                            $classe_linha = '';
                            $total_entradas += $cp4;
                        } else {
                            $classe = 'text-danger';
                            $classe_linha = 'text-danger';
                            $total_saldo -= $cp4;
                            $total_saldo_periodo = $total_saldo_periodo - $cp4;
                            $total_saidas += $cp4;
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
                        $total_entradasF = number_format($total_entradas, 2, ',', '.');
                        $total_saidasF = number_format($total_saidas, 2, ',', '.');


                    ?>

                        <section class="area-tab" style="padding-top:5px">

                            <div class="linha-cab <?php echo $classe_linha ?>">

                                <div class="coluna" style="width:10%"><?php echo $data ?> </div>
                                <div class="coluna" style="width:25%"><?php echo $cp2 ?> <small>(<?php echo $cp3 ?>)</small> </div>

                                <div class="coluna" style="width:10%"><?php echo $cp9 ?> </div>
                                <div class="coluna" style="width:20%"><?php echo $cp8 ?> </div>

                                <div class="coluna" style="width:15%"><?php echo $nome_usu ?> </div>
                                <div class="coluna <?php echo $classe ?>" style="width:10%">R$ <?php echo $valor ?> </div>
                                <div class="coluna <?php echo $classe_saldo_periodo ?>" style="width:10%">R$ <?php echo $total_saldo_periodoF ?> </div>




                            </div>
                        </section>
                        <div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
                        </div>

                    <?php } ?>


                </small></small>



    </div>


    <div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
    </div>

    <small><small><small>
                <div class="linha-cab p-2">

                    <div class="coluna" style="width:25%">TOTAL DE MOVIMENTAÇÕES: <?php echo @$totalItens ?> </div>
                    <div class="coluna text-success" style="width:25%">ENTRADAS: R$ <?php echo @$total_entradasF ?> </div>

                    <div class="coluna text-danger" style="width:25%">SAÍDAS: R$ <?php echo @$total_saidasF ?> </div>
                    <div class="coluna <?php echo $classe_saldo ?>" style="width:25%">SALDO PERÍODO: R$ <?php echo @$total_saldoF ?> </div>
                </div>
            </small></small></small>



    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>

    <br>

</body>

</html>