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
    $apuracao = 'Data da Período: ' . $data_inicialF;
} else {
    $apuracao = 'Período: ' . $data_inicialF . ' à ' . $data_finalF;
}

//pegando subtotal

$query = $pdo->query("SELECT  SUM(`subtotal`) from vendas where (data_lanc >= '$data_inicial' 
and data_lanc <= '$data_final') and (status = 'Concluída' or status = 'Pendente') order by data_lanc asc, id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalLiquido = $res[0]["SUM(`subtotal`)"];


//Fazendo consulta de tipos de pagamentos
//Dinheiro
$query_dinheiro = $pdo->query("SELECT SUM(`subtotal`) from vendas 
where (data_lanc >= '$data_inicial' and data_lanc <= '$data_final')  and (status = 'Concluída' or status = 'Pendente') and pagamento = 'Dinheiro' order by data_lanc asc, id asc ");
$res = $query_dinheiro->fetchAll(PDO::FETCH_ASSOC);
$subtotalDinheiro = $res[0]["SUM(`subtotal`)"];

if ($subtotalDinheiro == '' || $subtotalDinheiro == 0) {
    $subtotalDinheiro = 0;
}

if($totalLiquido > 0){
    $porcenDinheiro = ($subtotalDinheiro / $totalLiquido) * 100;
}



//Carnê consulta
$query_carne = $pdo->query("SELECT SUM(`subtotal`) from vendas 
where (data_lanc >= '$data_inicial' and data_lanc <= '$data_final')  and 
(status = 'Concluída' or status = 'Pendente') and pagamento = 'Carnê' 
order by data_lanc asc, id asc ");
$res = $query_carne->fetchAll(PDO::FETCH_ASSOC);
$subtotalCarne = $res[0]["SUM(`subtotal`)"];

if ($subtotalCarne == '' || $subtotalCarne == 0) {
    $subtotalCarne = 0;
}

if($totalLiquido > 0){
    $porcenCarne = ($subtotalCarne / $totalLiquido) * 100;
}


//Cartão de Crédito
$query_credito = $pdo->query("SELECT SUM(`subtotal`) from vendas 
where (data_lanc >= '$data_inicial' and data_lanc <= '$data_final')  and 
(status = 'Concluída' or status = 'Pendente') and pagamento = 'Cartão de Crédito' 
order by data_lanc asc, id asc ");
$res = $query_credito->fetchAll(PDO::FETCH_ASSOC);
$subtotalCartaoCredito = $res[0]["SUM(`subtotal`)"];

if ($subtotalCartaoCredito == '' || $subtotalCartaoCredito == 0) {
    $subtotalCartaoCredito = 0;
}

if($totalLiquido > 0){
    $porcenCredito = ($subtotalCartaoCredito / $totalLiquido) * 100;
}


//Cartão de Débito
$query_debito = $pdo->query("SELECT SUM(`subtotal`) from vendas 
where (data_lanc >= '$data_inicial' and data_lanc <= '$data_final')  and 
(status = 'Concluída' or status = 'Pendente') and pagamento = 'Cartão de Débito' 
order by data_lanc asc, id asc ");

$res = $query_debito->fetchAll(PDO::FETCH_ASSOC);
$subtotalCartaoDebito = $res[0]["SUM(`subtotal`)"];

if ($subtotalCartaoDebito == '' || $subtotalCartaoDebito == 0) {
    $subtotalCartaoDebito = 0;
}

if($totalLiquido > 0){
    $porcenDebito = ($subtotalCartaoDebito / $totalLiquido) * 100;
}


//Cheque
$query_Cheque = $pdo->query("SELECT SUM(`subtotal`) from vendas 
where (data_lanc >= '$data_inicial' and data_lanc <= '$data_final')  and 
(status = 'Concluída' or status = 'Pendente') and pagamento = 'Cheque' 
order by data_lanc asc, id asc ");

$res = $query_Cheque->fetchAll(PDO::FETCH_ASSOC);
$subtotalCheque = $res[0]["SUM(`subtotal`)"];

if ($subtotalCheque == '' || $subtotalCheque == 0) {
    $subtotalCheque = 0;
}

if($totalLiquido > 0){
    $porcenCheque = ($subtotalCheque / $totalLiquido) * 100;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Lucro</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
            flex-direction: column;
            gap: 4px;

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
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5px;
            justify-content: center;
        }

        .box-resumo span {
            align-items: center;

        }

        .box-resumos-dados {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .box-resumos-resultados {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: 20px;
        }

        .box-cabecalho {
            margin-top: 15px;
            margin-bottom: 10px;
            border: 1px solid black;
            padding: 5px;
        }

        .box-cabecalho h3 {
            margin-left: 15px;
        }

        .box-cabecalho p {
            font-size: 16px;
            margin-left: 15px;
        }

        .box-pagamento {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .box-pagamentos-type {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .box-pagamentos-valor {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        /*Css barra de progresso */

        .outter {
            height: 8px;
            width: 100%;
            display: flex;
            flex-flow: column wrap;
        }

        .inner-Din {
            height: 7px;
            background: green;
            width: <?php echo $porcenDinheiro . '%' ?>;
            border-right: solid 1px green;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .inner-Carne {
            height: 7px;
            background: green;
            width: <?php echo $porcenCarne . '%' ?>;
            border-right: solid 1px green;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .inner-Credito {
            height: 7px;
            background: green;
            width: <?php echo $porcenCredito . '%' ?>;
            border-right: solid 1px green;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .inner-Debito {
            height: 7px;
            background: green;
            width: <?php echo $porcenDebito . '%' ?>;
            border-right: solid 1px green;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .inner-Cheque {
            height: 7px;
            background: green;
            width: <?php echo $porcenCheque . '%' ?>;
            border-right: solid 1px green;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
    </style>


</head>

<body>

    <div class="container-fluid">
        <section class="area-cab">
            <div class="box-cabecalho">
                <strong>
                    <h3>Núcleo da Visão</h3>
                </strong>
                <strong>
                    <p><?php echo $endereco_site ?></p>
                </strong>
            </div>
        </section>
    </div>


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
            <div class="col-5">

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
                $totalLiquido = $res[0]["SUM(`subtotal`)"];
                $valorSubTotal = $res[0]["SUM(`subtotal`)"];

                if ($totalItens  == 0) {
                    $tiqueteMedio = 0;
                } else {
                    $tiqueteMedio = $totalLiquido / $totalItens;
                }

                $totalRecebidoPeriodo = $totalLiquido - $totalRecebido;

                if ($totalItens == 0) {
                    echo '<h1>' . 'Não possui vendas nesse período' . '</h1>';
                    $ocultar = 'd-none';
                }
                ?>

                <div class="box-resumo <?php echo $ocultar; ?>">
                    <div class="box-resumos-dados">
                        <strong><span>Números de Vendas:</span> </strong>
                        <strong><span>Tíquete Médio: </span></strong>
                        <strong><span>Total Bruto: </span></strong>
                        <strong><span>Desconto: </span></strong>
                        <strong><span>Acréscimo: </span></strong>
                        <strong><span>Total Líquido: </span></strong>
                        <hr>
                        <strong><span>Adiantamentos: </span> </strong>
                        <strong><span>Total recebido no período:</span></strong>
                    </div>

                    <div class="box-resumos-resultados">
                        <strong><span><?php echo $totalItens ?></span></strong>
                        <strong><span><?php echo 'R$ ' . number_format($tiqueteMedio, 2, '.', ','); ?></span></strong>
                        <strong><span><?php echo 'R$ ' .  number_format($totalBruto, 2, ',', '.')  ?> </span></strong>
                        <strong><span><?php echo 'R$ ' . number_format($totalDesconto, 2, ',', '.') ?> (-)</span></strong>
                        <strong><span><?php echo 'R$ ' .  number_format($totalAcrescimo, 2, ',', '.')  ?> (+)</span></strong>
                        <strong><span><?php echo 'R$ ' . number_format($totalLiquido, 2, ',', '.') ?> (=)</span></strong>
                        <hr>
                        <strong><span><?php echo 'R$ ' . number_format($totalRecebido, 2, ',', '.') ?> (+)</span></strong>
                        <strong><span><?php echo 'R$ ' . number_format($totalRecebidoPeriodo, 2, ',', '.') ?> </span></strong>
                    </div>


                </div>
            </div>

            <?php
            $query2 = $pdo->query("SELECT * from vendas where (data_lanc >= '$data_inicial'
                        and data_lanc <= '$data_final')  and (status = 'Concluída' or status = 'Pendente') order by data_lanc asc, id asc ");
            $res = $query2->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < @count($res); $i++) {
                foreach ($res  as $key => $value) {
                }
                $id_funcionario = $res[0]['usuario'];
                $query_fun = $pdo->query("SELECT * from usuarios where id = '$id_funcionario'");
                $res_fun = $query_fun->fetchAll(PDO::FETCH_ASSOC);
                if (@count($res_fun) > 0) {
                    $nome_funcionario = $res_fun[0]['nome'];
                } else {
                    $nome_funcionario = 'Sem funcionario';
                }
            }
            ?>
            <div class="col-5">
                <div class="box-funcionario <?php echo $ocultar; ?>">
                    <div class="func-dados">
                        <div class="nome-func">
                            <strong> <span> <i class="bi bi-person-fill"></i> <?php echo $nome_funcionario ?></span></strong>
                        </div>
                        <div class="ganho-func">
                            <strong> <span> <?php echo 'R$ ' .  number_format($totalLiquido, 2, ',', '.') ?></span></strong>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-5">
                <div class="box-pagamento <?php echo $ocultar; ?>">
                    <div class="box-pagamentos-type">
                        <strong><span>Dinheiro</span></strong>
                        <!--Barra de progresso-->
                        <div class="outter">
                            <div class="inner-Din"></div>
                        </div>
                        <strong><span>Carnê</span></strong>
                        <!--Barra de progresso-->
                        <div class="outter">
                            <div class="inner-Carne"></div>
                        </div>
                        <strong><span>Cartão de Crédito</span></strong>
                        <!--Barra de progresso-->
                        <div class="outter">
                            <div class="inner-Credito"></div>
                        </div>
                        <strong><span>Cartão de Débito</span></strong>
                        <!--Barra de progresso-->
                        <div class="outter">
                            <div class="inner-Debito"></div>
                        </div>
                        <strong><span>Cheque</span></strong>
                        <!--Barra de progresso-->
                        <div class="outter">
                            <div class="inner-Cheque"></div>
                        </div>
                    </div>
                    <div class="box-pagamentos-valor">
                        <strong><span><?php echo 'R$ ' . number_format($subtotalDinheiro, 2, ',', '.') ?> (<?php echo number_format($porcenDinheiro, 2)  . '%'; ?>)</span></strong>
                        <div class="outter d-done">
                            <div class="inner-Carne d-none"></div>
                        </div>
                        <strong><span><?php echo 'R$ ' . number_format($subtotalCarne, 2, ',', '.') ?> (<?php echo number_format($porcenCarne, 2)  . '%'; ?>)</span></strong>
                        <div class="outter d-done">
                            <div class="inner-Carne d-none"></div>
                        </div>
                        <strong><span><?php echo 'R$ ' . number_format($subtotalCartaoCredito, 2, ',', '.') ?> (<?php echo number_format($porcenCredito, 2)  . '%'; ?>)</span></strong>
                        <div class="outter d-done">
                            <div class="inner-Carne d-none"></div>
                        </div>
                        <strong><span><?php echo 'R$ ' . number_format($subtotalCartaoDebito, 2, ',', '.') ?> (<?php echo number_format($porcenDebito, 2)  . '%'; ?>)</span></strong>
                        <div class="outter d-done">
                            <div class="inner-Carne d-none"></div>
                        </div>
                        <strong><span><?php echo 'R$ ' . number_format($subtotalCheque, 2, ',', '.') ?> (<?php echo number_format($porcenCheque, 2)  . '%'; ?>)</span></strong>
                    </div>

                </div>
            </div>



        </section>

    </div>

    <div class="container-fluid mt-5">
        <section>
            <div class="col-md-12 <?php echo $ocultar; ?>">
                <table class="table table-stripped">

                    <tr>
                        <strong></strong>
                        <td style="text-align: center;"><strong>id Venda</strong></td>
                        <td style="text-align: center;"><strong>Cliente</strong></td>
                        <td style="text-align: center;"><strong>Funcionária</strong></td>
                        <td style="text-align: center;"><strong>Total</strong></td>
                        <td style="text-align: center;"><strong>Desconto</strong></td>
                        <td style="text-align: center;"><strong>Acréscimo</strong></td>
                        <td style="text-align: center;"><strong>SubTotal</strong></td>
                        <td style=""><strong>Pagamento</strong></td>
                        <td style="text-align: center;"><strong></strong></td></strong>
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
                            <td style="text-align: center;"><strong><?php echo $id ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo $nome_cliente ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo $nome_func ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo number_format($valor_total, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo number_format($desconto, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo number_format($acrescimo, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo number_format($subtotal, 2, ',', '.') ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo $valorPag ?></strong></td>
                            <td style="text-align: center;"><strong><?php echo number_format($subtotal, 2, ',', '.') ?></strong></td>
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