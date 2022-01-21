<?php 

require_once('../conexao.php');
require_once('verificar.php');

$hoje = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$dataInicioMes = $ano_atual."-".$mes_atual."-01";



$query = $pdo->query("SELECT * from clientes where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$clientesCadastrados = @count($res);

$query = $pdo->query("SELECT * from fornecedores where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$fornCadastrados = @count($res);

$query = $pdo->query("SELECT * from produtos where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produtosCadastrados = @count($res);

$query = $pdo->query("SELECT * from produtos where ativo = 'Sim' and estoque <= '$nivel_minimo_estoque'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoqueBaixo = @count($res);



$query = $pdo->query("SELECT * from contas_receber where vencimento < curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_receber_vencidas = @count($res);


$query = $pdo->query("SELECT * from contas_receber where vencimento = curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_receber_hoje = @count($res);


$query = $pdo->query("SELECT * from contas_pagar where vencimento < curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagar_vencidas = @count($res);


$query = $pdo->query("SELECT * from contas_pagar where vencimento = curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagar_hoje = @count($res);




$query = $pdo->query("SELECT * from vendas where (data_pgto >= '$dataInicioMes' and
data_pgto <= curDate()) and status = 'Concluída'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$subtotal = 0;
$subtotalF = 0;

$total_custo = 0;
$total_custoF = 0;

$lucroMes = 0;
$lucroMesF = 0;

for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}

	$subt = $res[$i]['subtotal'];
	$custo = $res[$i]['valor_custo'];

	$subtotal += $subt;
	$total_custo += $custo;	
	$lucroMes = $subtotal - $total_custo;
	$lucroMesF = number_format($lucroMes, 2, ',', '.');
	$subtotalF = number_format($subtotal, 2, ',', '.');


}




$totalPagarM = 0;
		$query = $pdo->query("SELECT * from contas_pagar where vencimento >= '$dataInicioMes' and vencimento <= curDate() and status = 'Pendente'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$pagarMes = @count($res);
		$total_reg = @count($res);
		if($total_reg > 0){ 

			for($i=0; $i < $total_reg; $i++){
				foreach ($res[$i] as $key => $value){	}

					$totalPagarM += $res[$i]['valor'];
				$pagarMesF = number_format($totalPagarM, 2, ',', '.');

			}
		}


		$totalReceberM = 0;
		$query = $pdo->query("SELECT * from contas_receber where vencimento >= '$dataInicioMes' and vencimento <= curDate() and status = 'Pendente'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$receberMes = @count($res);
		$total_reg = @count($res);
		if($total_reg > 0){ 

			for($i=0; $i < $total_reg; $i++){
				foreach ($res[$i] as $key => $value){	}

					$totalReceberM += $res[$i]['valor'];
				$receberMesF = number_format($totalReceberM, 2, ',', '.');

			}
		}



?>


<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/geral.css">
<link rel="stylesheet" href="../css/home.css">

<div class="container-fluid">
    <section id="minimal-statistics">
        <div class="row mb-2">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase">Estatísticas do Sistema</h4>

            </div>
        </div>




        <div class="row mb-4">

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body ">
                            <div class="row card-linha">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-box-seam text-success fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3> <span class="text-success"><?php echo @$produtosCadastrados ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu11 ?>"> <span>Produtos
                                            Cadastrados</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-people text-primary fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3> <span class="text-primary"><?php echo @$clientesCadastrados ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu2 ?>"> <span>Clientes
                                            Cadastrados</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-people text-dark fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3> <span class="text-dark"><?php echo @$fornCadastrados ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu13 ?>">
                                        <span>Fornecedores Cadastrados</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3><span class="text-danger"><?php echo @$estoqueBaixo ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu11 ?>&estoque=sim">
                                        <span>Produtos Estoque Baixo</span></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>






        <div class="row mb-4">

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-calendar2-check-fill text-warning fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3> <span class=""><?php echo @$contas_pagar_hoje ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu15 ?>"> <span>Contas à
                                            Pagar (Hoje)</span></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-calendar-x-fill text-danger fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3> <span class="">
                                            <?php echo @$contas_pagar_vencidas ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu15 ?>"> <span>Contas à
                                            Pagar Vencidas</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-calendar2-check-fill text-warning fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3> <span class=""><?php echo @$contas_receber_hoje ?></span></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu16 ?>"> <span>Contas à
                                            Receber (Hoje)</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card card-tam-edit">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="align-self-center col-3">
                                    <i class="bi bi-calendar-x-fill text-danger fs-1 float-start"></i>
                                </div>
                                <div class="col-9 text-end">
                                    <h3><?php echo @$contas_receber_vencidas ?></h3>
                                    <a class="link-rapido" href=" index.php?pag=<?php echo $menu16 ?>"> <span>Contas à
                                            Receber Vencidas</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </section>

    <section id="stats-subtitle">
        <div class="row mb-2">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase">Estatísticas Mensais</h4>

            </div>
        </div>

        <div class="row mb-4">

            <div class="col-xl-6 col-md-12">
                <div class="card overflow-hidden card-tam-ret">
                    <div class="card-content ">
                        <div class="card-body cleartfix">
                            <div class="row media align-items-stretch">
                                <div class="align-self-center col-1">
                                    <i class="bi-calendar2-date text-primary fs-1 mr-2"></i>
                                </div>
                                <div class="media-body col-6">
                                    <h4>Lucro no Mês</h4>
                                    <span>Total Arrecado este Mês</span>
                                </div>
                                <div class="text-end col-5">
                                    <h2><span class="text-success">R$ <?php echo @$lucroMesF ?></h2></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12">
                <div class="card overflow-hidden card-tam-ret">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="row media align-items-stretch">
                                <div class="align-self-center col-1">
                                    <i class="bi bi-calendar-week-fill text-danger fs-1 mr-2"></i>
                                </div>
                                <div class="media-body col-6">
                                    <h4>Contas à Pagar</h4>
                                    <span>Total de <?php echo @$pagarMes ?> Contas no Mês</span>
                                </div>
                                <div class="text-end col-5">
                                    <h2>R$ <?php echo @$pagarMesF ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row mb-4">

            <div class="col-xl-6 col-md-12">
                <div class="card overflow-hidden card-tam-ret">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="row media align-items-stretch">
                                <div class="align-self-center col-1">
                                    <i class="bi bi-calendar-week-fill text-success fs-1 mr-2"></i>
                                </div>
                                <div class="media-body col-6">
                                    <h4>Contas à Receber</h4>
                                    <span>Total de <?php echo @$receberMes ?> Contas no Mês</span>
                                </div>
                                <div class="text-end col-5">
                                    <h2>R$ <?php echo @$receberMesF ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12">
                <div class="card overflow-hidden card-tam-ret">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="row media align-items-stretch">
                                <div class="align-self-center col-1">
                                    <i class="bi bi-calendar2-plus-fill text-success fs-1 mr-2"></i>
                                </div>
                                <div class="media-body col-6">
                                    <h4>Total de Vendas</h4>
                                    <span>Vendas do Mês em R$</span>
                                </div>
                                <div class="text-end col-5">
                                    <h2>R$ <?php echo @$subtotalF ?></h2>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>


    <section id="stats-subtitle">
        <div class="row mb-2">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase">Modelo de Gráficos</h4>

            </div>
        </div>



        <style type="text/css">
        #principal {
            width: 100%;
            height: 100%;
            margin-left: 10px;
            font-family: Verdana, Helvetica, sans-serif;
            font-size: 14px;

        }

        #barra {
            margin: 0 2px;
            vertical-align: bottom;
            display: inline-block;
            padding: 5px;
            text-align: center;

        }

        .cor1,
        .cor2,
        .cor3,
        .cor4,
        .cor5,
        .cor6,
        .cor7,
        .cor8,
        .cor9,
        .cor10,
        .cor11,
        .cor12 {
            color: #FFF;
            padding: 5px;
        }

        .cor1 {
            background-color: #FF0000;
        }

        .cor2 {
            background-color: #0000FF;
        }

        .cor3 {
            background-color: #FF6600;
        }

        .cor4 {
            background-color: #009933;
        }

        .cor5 {
            background-color: #FF0000;
        }

        .cor6 {
            background-color: #0000FF;
        }

        .cor7 {
            background-color: #FF6600;
        }

        .cor8 {
            background-color: #009933;
        }

        .cor9 {
            background-color: #FF0000;
        }

        .cor10 {
            background-color: #0000FF;
        }

        .cor11 {
            background-color: #FF6600;
        }

        .cor12 {
            background-color: #009933;
        }
        </style>

        <div id="principal">
            <p>Lucros no Ano de <?php echo $ano_atual ?></p>
            <?php
            // definindo porcentagem
            //BUSCAR O TOTAL DE VENDAS POR MES NO ANO
            $total  = 12; // total de barras
            for ($i = 1; $i < 13; $i++) {


                $dataMesInicio = $ano_atual . "-" . $i . "-01";
                $dataMesFinal = $ano_atual . "-" . $i . "-31";
                $totalVenM = 0;
                $query = $pdo->query("SELECT * from vendas where data_pgto >= '$dataMesInicio'
                 and data_pgto <= '$dataMesFinal' and status = 'Concluída'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_vendas_mes = @count($res);
                if ($total_vendas_mes > 0) {

                    $subtotal = 0;
                    $subtotalF = 0;

                    $total_custo = 0;
                    $total_custoF = 0;

                    $lucroMes = 0;
                    $lucroMesF = 0;

                    for ($i2 = 0; $i2 < @count($res); $i2++) {
                        foreach ($res[$i2] as $key => $value) {
                        }

                        $subt = $res[$i2]['subtotal'];
                        $custo = $res[$i2]['valor_custo'];

                        $subtotal += $subt;
                        $total_custo += $custo;
                        $lucroMes = $subtotal - $total_custo;
                        $lucroMesF = number_format($lucroMes, 2, ',', '.');
                        $subtotalF = number_format($subtotal, 2, ',', '.');
                    }

                    $altura_barra = $lucroMes / 15;
                } else {
                    $altura_barra = $total_vendas_mes;
                    $lucroMesF = 0;
                }

                if ($i < 10) {
                    $texto = '0' . $i . '/' . $ano_atual;
                } else {
                    $texto = $i . '/' . $ano_atual;
                }


            ?>


            <div id="barra">
                <div class="cor<?php echo $i ?>" style="height:<?php echo $altura_barra + 25 ?>px">R$
                    <?php echo $lucroMesF ?> </div>
                <div><?php echo $texto ?></div>
            </div>

            <?php } ?>
        </div>
    </section>


</div>