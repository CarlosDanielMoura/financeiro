<?php
include('../conexao.php');
$id = $_GET['id'];

@session_start();

$query = $pdo->query("SELECT * from ordem_servico where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id_os = $res[0]['id'];

$valor_total = $res[0]['valor_total'];
$nome_cliente = $res[0]['nome_cliente'];
$nome_func = $res[0]['nome_func'];
$data_entrada = $res[0]['data_criacao'];

$dataAtt = data($data_entrada);

$json = json_decode($res[0]['obj']);
$dataEntrega = data($json->dadosPrincipal->data_entrega);


if($json->produtos->qtde_parcelas == '' || $json->produtos->qtde_parcelas == 0 ){
    $ocultar = 'd-none';
}

if($json->produtos->valor_entrada_cliente == '' || $json->produtos->valor_entrada_cliente == 0){
    $ocultar = 'd-none';
}

//Função de formatar data
function data($data)
{
    return date("d/m/Y", strtotime($data));
}
?>





<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comprovante de Venda</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="shortcut icon" href="../img/logo-150.ico" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .container {
            width: 90%;
            border: 1px solid black;
            margin: 0 auto;

        }

        img {
            background-size: cover;

        }

        .protocol {
            background-color: #D3D3D3;
            color: black;
            margin-top: 5px;
            border-radius: 3px;
        }

        .title-protocol {
            text-align: center;
        }

        .row {
            margin-top: 3px;
        }
        .protocol-total{
            display: flex;
            justify-content: end;
            font-size: 20px;
        }

        .img-cab{
            max-width: 90%;
            margin-top: 5px;
        }
        img{
            max-width: 90%;
            background-size: cover;
        }
    </style>
</head>

<body style="background-color: white;">
    <div class="container mt-5">
        <div class="img-cab">
            <img src="../img/logo-Os.png" alt="">
        </div>
        <div class="protocol">
            <p class="title-protocol"> <strong> *** PROTOCOLO *** </strong></p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <span><strong>O.S Número:</strong></span><span> <?php echo $id_os ?></span>
            </div>
            <div class="col-md-4">
                <span><strong>Dt. Entrada: </strong></span><span><?php echo $dataAtt ?></span>
            </div>
            <div class="col-md-4">
                <span><strong>Prev. Entrega: </strong></span><span><?php echo $dataEntrega ?> - <?php echo $json->dadosPrincipal->hora_entrega ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <span><strong>Cliente: </strong></span><span><?php echo $nome_cliente ?></span>
            </div>
            <div class="col-md-4 " >
                <span class="<?php  echo $ocultar?>"><strong>Total parcelas: </strong></span><span class="<?php  echo $ocultar?>"><?php echo $json->produtos->qtde_parcelas ?></span>
            </div>
            <div class="col-md-4 ">
                <span  class="<?php echo $ocultar ?>"><strong>Entrada cliente: </strong></span><span class="<?php echo $ocultar ?>"> R$ <?php echo number_format($json->produtos->valor_entrada_cliente,2) ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <span><strong>Vendedor: </strong></span><span><?php echo $nome_func ?></span>
            </div>
        </div>

        
        <div class="row mt-3">
            <div style="border: 1px solid black;"></div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="tabela-produtos">

                    <tr>
                        <td style="width: 50%;"><strong>Código Prod - Nome produto</strong></td>
                        <td style="text-align: center; width: 10%;"><strong>Qtde</strong></td>
                        <td style="text-align: center; width: 14%;"><strong>Val. Unit(R$)</strong></td>
                        <td style="text-align: center; width: 10%;"><strong>Val. Total</strong></td>
                    </tr>


                    <?php foreach ($json->produtos->produtos_selecionados as $key => $value) { ?>
                        <?php
                        
                        @$valorQteTotal += $value->qtde;
                        @$valorTotalProds += $value->valTotal;
                        ?>
                        <tr>
                            <td style=""> <?php echo $value->codENome  ?> </td>
                            <td style="text-align: center;"><?php echo $value->qtde  ?></td>
                            <td style="text-align: center;"><?php echo number_format($value->valUnit,2)  ?></td>
                            <td style="text-align: center;"><?php echo number_format($value->valTotal,2) ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td style="text-align: end;"><strong>Quantidade total: </strong></td>
                        <td style="text-align: center;"><strong> <?php echo $valorQteTotal ?></strong></td>
                    </tr>
                </table>


            </div>
            <div class="protocol-total">
                <strong><span>Total:</span> <span> R$ <?php echo number_format($valorTotalProds,2)  ?> </span></strong>
            </div>
        </div>
    </div>
</body>

</html>