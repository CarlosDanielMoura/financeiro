<?php
require_once("../conexao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


$data_inicial = @$_GET['data_inicial'];
$data_final = @$_GET['data_final'];

$data_inicialF = implode('/', array_reverse(explode('-', $data_inicial)));
$data_finalF = implode('/', array_reverse(explode('-', $data_final)));


if ($data_inicial == $data_final) {
    $apuracao = 'Data da Apuração: ' . $data_inicialF;
} else {
    $apuracao = 'Apuração: ' . $data_inicialF . ' à ' . $data_finalF;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Lucro</title>
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
            <div class="coluna titulo_cab" style="width:70%"> <u>Relatório de Lucro</u></div>
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



        <small><small><small>
                    <section class="area-tab" style="background-color: #f5f5f5;">

                        <div class="linha-cab" style="padding-top: 5px;">
                            <div class="coluna" style="width:20%; margin-left: 5px;">DATA PAGAMENTO</div>
                            <div class="coluna" style="width:15%">VALOR</div>
                            <div class="coluna" style="width:15%">DESCONTO</div>
                            <div class="coluna" style="width:15%">ACRÉSCIMO</div>
                            <div class="coluna" style="width:20%">SUBTOTAL</div>
                            <div class="coluna" style="width:15%">CUSTO</div>

                        </div>

                    </section><small></small>

                    <div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
                    </div>

                    <?php

                    $query = $pdo->query("SELECT * from vendas where (data_pgto >= '$data_inicial' and data_pgto <= '$data_final') and status = 'Concluída' order by data_pgto asc, id asc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $totalItens = @count($res);

                    if ($totalItens == 0) {
                        echo 'Não possui vendas nesse período';
                    }

                    $total_vlr_prod = 0;
                    $total_vlr_prodF = 0;

                    $total_desc = 0;
                    $total_descF = 0;

                    $total_acr = 0;
                    $total_acrF = 0;

                    $total_custo = 0;
                    $total_custoF = 0;

                    $subtotal = 0;
                    $subtotalF = 0;

                    $total_lucro = 0;
                    $total_lucroF = 0;

                    for ($i = 0; $i < @count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $id = $res[$i]['id'];
                        $valor = $res[$i]['valor'];
                        $desconto = $res[$i]['desconto'];
                        $acrescimo = $res[$i]['acrescimo'];
                        $subt = $res[$i]['subtotal'];
                        $custo = $res[$i]['valor_custo'];
                        $data = $res[$i]['data_pgto'];

                        $total_vlr_prod += $valor;
                        $total_desc += $desconto;
                        $total_acr += $acrescimo;
                        $subtotal += $subt;
                        $total_custo += $custo;
                        $total_lucro = $subtotal - $total_custo;

                        $data = implode('/', array_reverse(explode('-', $data)));
                        $total_vlr_prodF = number_format($total_vlr_prod, 2, ',', '.');
                        $total_descF = number_format($total_desc, 2, ',', '.');
                        $total_acrF = number_format($total_acr, 2, ',', '.');
                        $subtotalF = number_format($subtotal, 2, ',', '.');
                        $total_custoF = number_format($total_custo, 2, ',', '.');
                        $total_lucroF = number_format($total_lucro, 2, ',', '.');


                    ?>

                        <section class="area-tab" style="padding-top:5px; margin-left: 10px;">

                            <div class="linha-cab <?php echo $classe_linha ?>">

                                <div class="coluna" style="width:20%"><?php echo $data ?> </div>
                                <div class="coluna" style="width:15%">R$ <?php echo $valor ?> </div>

                                <div class="coluna" style="width:15%">R$ <?php echo $desconto ?> </div>
                                <div class="coluna" style="width:15%">R$ <?php echo $acrescimo ?> </div>

                                <div class="coluna" style="width:20%">R$ <?php echo $subt ?> </div>
                                <div class="coluna <?php echo $classe ?>" style="width:15%">R$ <?php echo $custo ?> </div>

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
                    <div class="coluna" style="width:20%">TOTAL DE VENDAS: <?php echo @$totalItens ?> </div>
                    <div class="coluna text-danger" style="width:20%">DESCONTOS: R$ <?php echo @$total_descF ?> </div>
                    <div class="coluna text-success" style="width:20%">ACRÉSCIMOS: R$ <?php echo @$total_acrF ?> </div>
                    <div class="coluna text-success <?php echo $classe_saldo ?>" style="width:20%">TOTAL VENDAS: R$ <?php echo @$total_vlr_prodF ?> </div>
                    <div class="coluna text-danger <?php echo $classe_saldo ?>" style="width:20%">TOTAL CUSTO: R$ <?php echo @$total_custoF ?> </div>
                </div>
            </small></small></small>

    <br><br>
    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>

    <small>
        <div class="linha-cab p-2">
            <div align="right" class="coluna mx-4" style="width:100%"><u>LUCRO: R$ <?php echo @$total_lucroF ?> </u> </div>
        </div>
    </small>



    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>

</body>

</html>