<?php
include('../conexao.php');

$id = $_GET['id'];

//BUSCAR AS INFORMAÇÕES DO PEDIDO
$query = $pdo->query("SELECT * from vendas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id = $res[0]['id'];
$cp1 = $res[0]['valor'];
$cp2 = $res[0]['usuario'];
$cp3 = $res[0]['pagamento'];
$cp4 = $res[0]['lancamento'];
$cp5 = $res[0]['data_lanc'];
$cp6 = $res[0]['data_pgto'];
$cp7 = $res[0]['desconto'];
$cp8 = $res[0]['acrescimo'];
$cp9 = $res[0]['subtotal'];
$cp10 = $res[0]['parcelas'];
$cp11 = $res[0]['status'];
$cp12 = $res[0]['cliente'];
$recebido = $res[0]['recebido'];
$troco = $recebido - $cp9;
$troco = number_format($troco, 2, ',', '.');

$data2 = implode('/', array_reverse(explode('-', $cp5)));


$res = $pdo->query("SELECT * from usuarios where id = '$cp2' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $dados[0]['nome'];


$query1 = $pdo->query("SELECT * from clientes where id = '$cp12' ");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if (@count($res1) > 0) {
    $nome_cliente = $res1[0]['nome'];
} else {
    $nome_cliente = 'Venda Rápida';
}

?>


<style type="text/css">
    * {
        margin: 0px;

        /*Espaçamento da margem da esquerda e da Direita*/
        padding: 0px;
        background-color: #ffffff;


    }

    .ttu {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 1.2em;
    }

    .printer-ticket {
        display: table !important;
        width: 100%;

        /*largura do Campos que vai os textos*/
        max-width: 400px;
        font-weight: light;
        line-height: 1.3em;

        /*Espaçamento da margem da esquerda e da Direita*/
        padding: 0px;
        font-family: Tahoma, Geneva, sans-serif;

        /*tamanho da Fonte do Texto*/
        font-size: 10px;



    }

    th {
        font-weight: inherit;

        /*Espaçamento entre as uma linha para outra*/
        padding: 5px;
        text-align: center;

        /*largura dos tracinhos entre as linhas*/
        border-bottom: 1px dashed #000000;
    }







    .cor {
        color: #000000;
    }


    .title {
        font-size: 1.5em;
    }

    /*margem Superior entre as Linhas*/
    .margem-superior {
        padding-top: 5px;
    }
</style>



<table class="printer-ticket">

    <tr>
        <th class="ttu" class="title" colspan="3"><?php echo $nome_sistema ?></th>

    </tr>
    <tr>
        <th colspan="3">
            <?php echo $endereco_site ?> <br />
            Contatos: <?php echo $telefone_whatsapp ?> e <?php echo $telefone_whatsapp ?> CNPJ <?php echo $cnpj_site ?>
        </th>
    </tr>

    <tr>
        <th colspan="3">Cliente <?php echo $nome_cliente ?> - Data: <?php echo $data2 ?>
            <br>
            Venda: <?php echo $id ?> - Status : <?php echo $cp11 ?>


        </th>
    </tr>

    <tr>
        <th class="ttu margem-superior" colspan="3">
            Comprovante de Venda <?php if ($cp11 == 'Cancelada') {
                                        echo ' Cancelada';
                                    } ?>

        </th>
    </tr>
    <tr>
        <th colspan="3">
            CUMPOM NÃO FISCAL

        </th>
    </tr>

    <tbody>

        <?php

        $res = $pdo->query("SELECT * from itens_venda where id_venda = '$id' order by id asc");
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        $linhas = count($dados);

        $sub_tot;
        for ($i = 0; $i < count($dados); $i++) {
            foreach ($dados[$i] as $key => $value) {
            }

            $id_produto = $dados[$i]['produto'];
            $quantidade = $dados[$i]['quantidade'];
            $valor = $dados[$i]['valor'];
            $total = $dados[$i]['total'];


            $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
            $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
            $nome_produto = $dados_p[0]['nome'];
            $codigo_produto = $dados_p[0]['codigo'];

            $valor = $dados_p[0]['valor_venda'];

            $total_item = $valor * $quantidade;





        ?>

            <tr>

                <td colspan="2" width="70%"> <?php echo $quantidade ?> - <?php echo $nome_produto ?>

                </td>


                <td align="right">R$ <?php

                                        @$total_item;
                                        @$sub_tot = @$cp1;
                                        @$sub_total = $sub_tot - $cp7 + $cp8;

                                        $sub_tot = number_format($sub_tot, 2, ',', '.');
                                        $sub_total = number_format($sub_total, 2, ',', '.');
                                        $total_item = number_format($total_item, 2, ',', '.');
                                        // $total = number_format( $cp1 , 2, ',', '.');




                                        echo $total_item;
                                        ?></td>
            </tr>

        <?php } ?>


    </tbody>
    <tfoot>

        <tfoot>

            <tr>
                <th class="ttu" colspan="3" class="cor">
                    <!-- _ _	_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ -->
                </th>
            </tr>


            <tr>
                <td colspan="2">Total</td>
                <td align="right">R$ <?php echo $sub_tot ?></td>
            </tr>

            <?php if ($cp7 != 0) { ?>
                <tr>
                    <td colspan="2">Desconto</td>
                    <td align="right">R$ <?php echo $cp7 ?></td>
                </tr>
            <?php } ?>



            <?php if ($cp8 != 0) { ?>
                <tr>
                    <td colspan="2">Acréscimo</td>
                    <td align="right">R$ <?php echo $cp8 ?></td>
                </tr>
            <?php } ?>


            </tr>

            <tr>
                <td colspan="2">SubTotal</td>
                <td align="right">R$ <?php echo $cp9 ?></td>
            </tr>

            <?php if ($recebido != 0) { ?>
                <tr>
                    <td colspan="2">Valor Recebido</td>
                    <td align="right">R$ <?php echo $recebido ?></td>
                </tr>
            <?php } ?>

            <?php if ($recebido != 0) { ?>
                <tr>
                    <td colspan="2">Troco</td>
                    <td align="right">R$ <?php echo $troco ?></td>
                </tr>
            <?php } ?>

            <tr>
                <th class="ttu" colspan="3" class="cor">
                    <!-- _ _	_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ -->
                </th>
            </tr>

            <tr>
                <td colspan="2">Lançamento</td>
                <td align="right"><?php echo $cp4 ?></td>
            </tr>

            <tr>
                <td colspan="2">Forma de Pagamento</td>
                <td align="right"><?php echo $cp3 ?></td>
            </tr>

            <?php if ($cp10 != 1) { ?>
                <tr>
                    <td colspan="2">Parcelas</td>
                    <td align="right"><?php echo $cp10 ?></td>
                </tr>
            <?php } ?>

        </tfoot>
</table>


<?php

if ($cp10 != 1) { ?>

    <table class="printer-ticket" style="margin-top:20px; margin-bottom: 20px">
        <tr>
            <th width="80px">Parcelas</th>
            <th width="80px">Valor</th>
            <th width="90px">Vencimento</th>
            <th width="100px">Pago</th>
        </tr>

        <?php
        //BUSCAR AS INFORMAÇÕES DA CONTA A RECEBER
        $query = $pdo->query("SELECT * from contas_receber where id_venda = '$id' order by id asc ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }


            $id = $res[$i]['id'];
            $cp50 = $res[$i]['descricao'];
            $cp51 = $res[$i]['cliente'];
            $cp52 = $res[$i]['entrada'];
            $cp53 = $res[$i]['documento'];
            $cp54 = $res[$i]['plano_conta'];
            $cp55 = $res[$i]['data_emissao'];
            $cp56 = $res[$i]['vencimento'];
            $cp57 = $res[$i]['frequencia'];
            $cp58 = $res[$i]['valor'];

            $cp59 = $res[$i]['usuario_lanc'];
            $cp60 = $res[$i]['usuario_baixa'];
            $cp61 = $res[$i]['status'];
            $cp62 = $res[$i]['data_recor'];
            $cp63 = $res[$i]['juros'];

            $cp64 = $res[$i]['multa'];

            $cp65 = $res[$i]['desconto'];
            $cp66 = $res[$i]['subtotal'];
            $cp67 = $res[$i]['data_baixa'];
            $cp68 = $res[$i]['id_venda'];

            $cp58 = number_format($cp58, 2, ',', '.');

            $cp56 = implode('/', array_reverse(explode('-', $cp56)));


        ?>


            <tr>
                <td>
                    <?php echo $cp50 ?>
                </td>
                <td>
                    <center>R$ <?php echo $cp58 ?></center>
                </td>
                <td>
                    <center><?php echo $cp56 ?></center>
                </td>
                <td>
                    <center><?php echo $cp61 ?></center>
                </td>
            </tr>

    <?php
        }
    }

    ?>
    </table>


    <table style="width:100%">
        <tr>
            <td colspan="2"><b><small><small><small>VENDEDOR (A)</b></td>
            <td align="right" style="font-size:11px;"><?php echo mb_strtoupper($nome_usu) ?></small></small></small></td>
        </tr>


        <tr>
            <th class="ttu" colspan="3" class="cor">
                <!-- _ _	_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ -->
            </th>
        </tr>

        <?php if ($cp11 == 'Pendente') { ?>

            <tr>
                <th class="ttu" colspan="3" class="cor">
                    <br>
                    <br>
                    <br>
                    <br>


                    _________________________________________
                    <h6 align="center">Assinatura</h6>

                    <br>
                    <br>
                    <br>
                </th>
            </tr>

        <?php } ?>
    </table>