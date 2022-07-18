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
    $apuracao = 'Período: ' . $data_inicialF . ' à ' . $data_finalF;
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
        }

        body {
            margin-top: 0px;

        }


        /* Css dos dados relatorios*/
        .row-vendas {
            background-color: #D3D3D3;
            color: black;
            margin-top: 5px;
            border-radius: 3px;
            text-align: center;
            align-items: center;
        }

        .periodo {
            font-size: 0.85rem;
            text-align: center;
        }

        .boxs-dados {
            align-items: center;
            text-align: center;
            display: flex;
            gap: 6px;

        }

        .box-resumo,
        .box-funcionario,
        .box-pagamento {
            border-radius: 5px;
            border: 1px solid #D3D3D3;
            width: 100%;
            margin-top: 20px;
            padding: 10px;
        }

        .box-resumo {
            display: flex;
            flex-direction: column;
            gap: 5px;

        }

        .box-resumo span {
            align-items: center;
        }
    </style>


</head>

<body>


    <section class="area-cab">
        cabeçalho
        <!-- <div class="cabecalho">
            <div class="coluna titulo_cab" style="width:70%"> <u>Relatórios de Vendas</u></div>
            <div align="right" class="coluna" style="width:30%"> <?php echo mb_strtoupper($nome_sistema) ?></div>
        </div> -->
    </section>

    <div class="container-fluid">
        <section class="">
            <div class="cabecalho">
                <div class="row-vendas">
                    <strong> <span>*** RELATÓRIO DE VENDAS ***</span></strong>
                </div>
                <div class="periodo">
                    <strong> <?php echo $apuracao ?></strong>
                </div>
            </div>
        </section>
    </div>



    <div class="container-fluid">
        <section class="boxs-dados">
            <div class="col-4">

                <?php
                $query = $pdo->query("SELECT COUNT(*), SUM(`valor`), SUM(`acrescimo`), SUM(`desconto`),SUM(`recebido`),SUM(`subtotal`) from vendas 
                where (data_lanc >= '$data_inicial' and data_lanc <= '$data_final')  and (status = 'Concluída' or status = 'Pendente') order by data_lanc asc, id asc ");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                //print_r($res[0]);
                $totalItens = $res[0]["COUNT(*)"];
                $totalBruto = $res[0]["SUM(`valor`)"];
                $totalDesconto = $res[0]["SUM(`desconto`)"];
                $totalAcrescimo = $res[0]["SUM(`acrescimo`)"];
                $totalRecebido = $res[0]["SUM(`recebido`)"];
                $totalLiquido = ($totalBruto - $totalDesconto) +  $totalAcrescimo;
                $valorSubTotal = $res[0]["SUM(`subtotal`)"];

                if ($totalItens  == 0) {
                    $tiqueteMedio = 0;
                } else {
                    $tiqueteMedio = $totalLiquido / $totalItens;
                }

                $totalRecebidoPeriodo = $totalLiquido - $totalRecebido;

                if ($totalItens == 0) {
                    echo 'Não possui vendas nesse período';
                }
                ?>

                <div class="box-resumo">
                    <strong><span>Números de Vendas : &nbsp;&nbsp;&nbsp;<?php echo $totalItens ?></span></strong>
                    <strong><span>Tíquete Médio: &nbsp;&nbsp;&nbsp;<?php echo 'R$ ' . number_format($tiqueteMedio, 2, '.', ','); ?></span></strong>
                    <strong><span>Total Bruto: &nbsp;&nbsp;&nbsp;<?php echo 'R$ ' .  number_format($totalBruto, 2, ',', '.')  ?> </span></strong>
                    <strong><span>Desconto: &nbsp;&nbsp;&nbsp;<?php echo 'R$ ' . number_format($totalDesconto, 2, ',', '.') ?> (-)</span></strong>
                    <strong><span>Acréscimo: &nbsp;&nbsp;&nbsp; <?php echo 'R$ ' .  number_format($totalAcrescimo, 2, ',', '.')  ?> (+)</span></strong>
                    <strong><span>Total Líquido: &nbsp;&nbsp;&nbsp; <?php echo 'R$ ' . number_format($totalLiquido, 2, ',', '.') ?> (=)</span></strong>
                    <hr>
                    <strong><span>Adiantamentos: &nbsp;&nbsp;&nbsp; <?php echo 'R$ ' . number_format($totalRecebido, 2, ',', '.') ?> (+)</span></strong>
                    <strong><span>Total recebido no período: &nbsp;&nbsp;<?php echo 'R$ ' . number_format($totalRecebidoPeriodo, 2, ',', '.') ?> </span></strong>
                </div>
            </div>
            <div class="col-4">

                <div class="box-funcionario">
                   
                </div>

            </div>


            <div class="col-4">

                <div class="box-pagamento">
                    sda
                </div>
            </div>



        </section>

    </div>

    <div class="container-fluid mt-5">
        <section>
            <div class="col-md-12">
                <table class="table table-borderless">

                    <tr>
                        <td style="text-align: center;"><strong>id Venda</strong></td>
                        <td style="text-align: center;"><strong>Cliente</strong></td>
                        <td style="text-align: center;"><strong>Funcionária</strong></td>
                        <td style="text-align: center;"><strong>Total</strong></td>
                        <td style="text-align: center;"><strong>Desconto</strong></td>
                        <td style="text-align: center;"><strong>Acréscimo</strong></td>
                        <td style="text-align: center;"><strong>SubTotal</strong></td>
                        <td style=""><strong>Tipo Pagamento</strong></td>
                        <td style="text-align: center;"><strong></strong></td>
                    </tr>


                    <?php

                    $query2 = $pdo->query("SELECT * from vendas where (data_lanc >= '$data_inicial'
                     and data_lanc <= '$data_final')  and (status = 'Concluída' or status = 'Pendente') order by data_lanc asc, id asc ");
                    $res = $query2->fetchAll(PDO::FETCH_ASSOC);
                    for ($i = 0; $i < @count($res); $i++) {
                        foreach ($res  as $key => $value) {
                        }

                        $id = $res[$i]['id'];
                        $valor_total = $res[$i]['valor'];
                        $desconto = $res[$i]['desconto'];
                        $acrescimo = $res[$i]['acrescimo'];
                        $subtotal = $res[$i]['subtotal'];
                        $pagamento = $res[$i]['pagamento'];
                        $parcelas = $res[$i]['parcelas'];


                        if ($pagamento == 'Carnê') {
                            $valorPag = $pagamento . ' (' . $parcelas . 'x' . ')';
                        } else {
                            $valorPag = $pagamento;
                        }


                        $id_nome = $res[$i]['cliente'];
                        $query1 = $pdo->query("SELECT * from clientes where id = '$id_nome'");
                        $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res1) > 0) {
                            $nome_cliente = $res1[0]['nome'];
                        } else {
                            $nome_cliente = 'Sem Cliente';
                        }

                        $id_func = $res[0]['usuario'];
                        $query4 = $pdo->query("SELECT * from usuarios where id = '$id_func'");
                        $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res4) > 0) {
                            $nome_func = $res4[0]['nome'];
                        } else {
                            $nome_func = 'Sem Cliente';
                        }

                        //Valores total somatorios



                    ?>
                       
                        <tr>
                            <td style="text-align: center;"><?php echo $id ?></td>
                            <td style="text-align: center;"><?php echo $nome_cliente ?></td>
                            <td style="text-align: center;"><?php echo $nome_func ?></td>
                            <td style="text-align: center;"><?php echo number_format($valor_total, 2, ',', '.') ?></td>
                            <td style="text-align: center;"><?php echo number_format($desconto, 2, ',', '.') ?></td>
                            <td style="text-align: center;"><?php echo number_format($acrescimo, 2, ',', '.') ?></td>
                            <td style="text-align: center;"><?php echo number_format($subtotal, 2, ',', '.') ?></td>
                            <td style="text-align: center;"><?php echo $valorPag ?></td>
                            <td style="text-align: center;"><?php echo number_format($subtotal, 2, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;"> <strong> <?php echo  number_format($totalBruto, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"> <strong> <?php echo  number_format($totalDesconto, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"><strong> <?php echo  number_format($totalAcrescimo, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"><strong> <?php echo  number_format($valorSubTotal, 2, ',', '.') ?></strong></td>
                        </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>