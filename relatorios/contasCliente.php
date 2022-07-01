<?php 
require_once("../conexao.php"); 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$id_cliente = @$_GET['id'];
$status = @$_GET['status'];
$data_inicial = @$_GET['data_inicial'];
$data_final = @$_GET['data_final'];

$data_inicialF = implode('/', array_reverse(explode('-', $data_inicial)));
$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

if($status == ""){
$titulo_rel = 'Relatório de Contas';
}else if($status == "Debitos"){
	$titulo_rel = 'Relatório de Débitos';
}else if($status == "Pendente"){
	$titulo_rel = 'Relatório de Contas Pendentes';
}else if($status == "Paga"){
	$titulo_rel = 'Relatório de Contas Pagas';
}

if($data_inicial == $data_final){
	$apuracao = 'Data da Apuração: '.$data_inicialF;
}else if($data_inicial == '1980-01-01'){
	$apuracao = 'Apuração: Todo o Período';
}else if($status == 'Debitos' and $data_inicial != '1980-01-01'){
	$apuracao = 'Data da Apuração: '.$data_inicialF. ' até a presente data!';
}
else{
	$apuracao = 'Apuração: '.$data_inicialF.' à '.$data_finalF;
}


$query = $pdo->query("SELECT * from clientes where id = '$id_cliente' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = $res[0]['nome'];
$telefone_cliente = $res[0]['telefone'];
$email_cliente = $res[0]['email'];

if($email_cliente != ''){
    $email = $email_cliente;
}else{
     $email = 'Sem Email';
}

$total_saldo_geral = 0;
$total_saldo_geralF = 0;

$status = '%'.$status.'%';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Contas</title>
    <link rel="shortcut icon" href="../img/logo-150.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <style>
    @page {
        margin: 0px;

    }

    body {
        margin-top: 0px;
        font-family: Times, "Times New Roman", Georgia, serif;
    }


    <?php if($relatorio_pdf=='Sim') {
        ?>.footer {
            margin-top: 20px;
            width: 100%;

            padding: 5px;
            position: absolute;
            bottom: 0;

        }

        <?php
    }

    else {
        ?>.footer {
            margin-top: 20px;
            width: 100%;
            background-color: #ebebeb;
            padding: 5px;

        }

        <?php
    }

    ?>.cabecalho {
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
            <div class="coluna titulo_cab" style="width:70%"> <u><?php echo $titulo_rel ?></u></div>
            <div align="right" class="coluna" style="width:30%"> <?php echo mb_strtoupper($nome_sistema) ?></div>
        </div>
    </section>

    <br>

    <section class="area-cab">
        <div class="cabecalho">
            <div class="coluna" style="width:60%"><small> <small><?php echo $apuracao ?></small></small></div>
            <div align="right" class="coluna" style="width:40%"><small> <small><small>
                            <?php echo mb_strtoupper($data_hoje) ?></small></small></small></div>
        </div>
    </section>

    <br>
    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>



    <div class="mx-2" style="padding-top:15px ">

        <div class="mb-2 mx-2 " align="right">

            <small>
                <b>Cliente:</b> <?php echo $nome_cliente ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>Telefone:</b> <?php echo $telefone_cliente ?></small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
                    if($email != 'Sem Email'){
                     echo '<b>Email: </b>'.$email. '</small>';
                     }
                ?>

            <small>
            </small>

        </div>

        <small><small><small>
                    <section class="area-tab" style="background-color: #f5f5f5;">

                        <div class="linha-cab" style="padding-top: 5px;">
                            <div class="coluna" style="width:50%">DESCRIÇÃO</div>
                            <div class="coluna" style="width:20%">VENCIMENTO</div>
                            <div class="coluna" style="width:20%">VALOR</div>
                            <div class="coluna" style="width:10%">PAGA</div>

                        </div>

                    </section><small></small>

                    <div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
                    </div>

                    <?php 
		if($status == '%Debitos%'){
		$query = $pdo->query("SELECT * from contas_receber where vencimento >= '$data_inicial' and
         vencimento < curDate() and status = 'Pendente' and cliente = '$id_cliente' order by 
         vencimento asc, id asc ");
		}else{
			$query = $pdo->query("SELECT * from contas_receber where (vencimento >= '$data_inicial'
            and vencimento <= '$data_final') and status LIKE '$status' and cliente = '$id_cliente'
            order by vencimento asc, id asc ");
		}
		
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalItens = @count($res);

		if($totalItens == 0){
			echo 'Não possui contas nesse período';
		} 

		$total_saldo = 0;
		$total_saldoF = 0;

		$total_pagas = 0;
		$total_pagasF = 0;

		$total_pendentes = 0;
		$total_pendentesF = 0;
		
		for ($i=0; $i < @count($res); $i++) { 
			foreach ($res[$i] as $key => $value) {
			}
			
		$id = $res[$i]['id'];
		$descricao = $res[$i]['descricao'];
		$vencimento = $res[$i]['vencimento'];
		$valor = $res[$i]['valor'];
		$status = $res[$i]['status'];
		
		if($status == 'Pendente'){
			$texto_pago = 'Não';
			$classe_pago = 'text-danger';
			$total_pendentes += $valor;
		}else{
			$texto_pago = 'Sim';
			$classe_pago = '';
			$total_pagas += $valor;
		}

		$total_saldo += $valor;

		$total_saldo_periodo = 0;
		$total_saldo_periodoF = 0;
		$contador = $i + 1;

		
			


			$vencimento = implode('/', array_reverse(explode('-', $vencimento)));
			$total_saldoF = number_format($total_saldo, 2, ',', '.');
			$total_pendentesF = number_format($total_pendentes, 2, ',', '.');
			$total_pagasF = number_format($total_pagas, 2, ',', '.');
			$valor = number_format($valor, 2, ',', '.');
			

			?>

                    <section class="area-tab" style="padding-top:5px">

                        <div class="linha-cab <?php echo $classe_pago ?>">

                            <div class="coluna" style="width:50%"><?php echo $descricao ?> </div>
                            <div class="coluna" style="width:20%"><?php echo $vencimento ?> </div>

                            <div class="coluna" style="width:20%">R$ <?php echo $valor ?> </div>
                            <div class="coluna" style="width:10%"><?php echo $texto_pago ?> </div>





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
                <?php if(@$_GET['status'] == ""){ ?>
                <div class="linha-cab p-2">

                    <div class="coluna" style="width:25%">TOTAL DE CONTAS: <?php echo @$totalItens ?> </div>
                    <div class="coluna text-success" style="width:25%">PAGAS: R$ <?php echo @$total_pagasF ?> </div>

                    <div class="coluna text-danger" style="width:25%">PENDENTES: R$ <?php echo @$total_pendentesF ?>
                    </div>
                    <div class="coluna <?php echo $classe_saldo ?>" style="width:25%">TOTAL: R$
                        <?php echo @$total_saldoF ?> </div>
                </div>
                <?php }else{ ?>

                <div class="linha-cab p-2">

                    <div class="coluna" style="width:25%">TOTAL DE CONTAS: <?php echo @$totalItens ?> </div>

                    <div class="coluna" style="width:25%">TOTAL: R$ <?php echo @$total_saldoF ?> </div>
                </div>
                <?php } ?>
            </small></small></small>



    <div class="cabecalho" style="border-bottom: solid 1px #0340a3">
    </div>

    <br>
</body>

</html>