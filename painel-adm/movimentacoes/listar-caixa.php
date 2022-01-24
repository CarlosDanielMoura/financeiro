<?php 
require_once("../../conexao.php");
$pagina = 'movimentacoes';
@session_start();
$nivel_usu = $_SESSION['nivel_usuario'];

$busca = @$_POST['busca'];
if($busca == ""){
	$busca = 'Caixa';
}

$total_saldo_geral = 0;
$total_saldo_geralF = 0;
//TRAZER O SALDO GERAL
$query_t = $pdo->query("SELECT * from $pagina where lancamento = '$busca' order by id desc");
$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_t)>0){
	for($it=0; $it < @count($res_t); $it++){
		foreach ($res_t[$it] as $key => $value){} 

			$data_primeiro_reg = $res_t[$it]['data'];	

		if($res_t[$it]['tipo'] == 'Entrada'){
			$total_saldo_geral += $res_t[$it]['valor'];
		}else{
			$total_saldo_geral -= $res_t[$it]['valor'];
		}
	}

	if($total_saldo_geral < 0){
		$classe_saldo_geral = 'text-danger';
	}else{
		$classe_saldo_geral = 'text-success';
	}

	$total_saldo_geralF = number_format($total_saldo_geral, 2, ',', '.');
}


$tipo = '%'.@$_POST['tipo'].'%';
$movimento = '%'.@$_POST['movimento'].'%';

$doc = '%'.@$_POST['status'].'%';
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$alterou_data = @$_POST['alterou_data'];
$todas = @$_POST['todas'];

if($dataInicial == ""){
	$dataInicial = date('Y-m-d');
}

if($dataFinal == ""){
	$dataFinal = date('Y-m-d');
}

if($todas != ""){
	$dataInicial = @$data_primeiro_reg;
}


if($busca == 'Caixa' || $busca == 'Cartão de Crédito' || $busca == 'Cartão de Débito'){
	$visivel = 'd-block';
}else{
	$visivel = 'd-none';
}

$query = $pdo->query("SELECT * from $pagina where (data >= '$dataInicial' and data <= '$dataFinal') and documento LIKE '$doc' and lancamento = '$busca' and tipo LIKE '$tipo' and movimento LIKE '$movimento' order by data asc, id asc ");


$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res)>0){

	echo <<<HTML
	<table id="{$pagina}" class="table  table-light table-hover my-4">
	<thead>
	<tr>
	<th>Data</th>
	<th>Movimento</th>		
	<th>Documento</th>
	<th>Plano Conta</th>
	<th>Usuário</th>
	<th>Valor</th>		
	<th>Saldo</th>	
	<th>Ações</th>	
	</tr>
	</thead>
	<tbody>
	HTML;

	$total_saldo = 0;
	$total_saldoF = 0;

	for($i=0; $i < @count($res); $i++){
		foreach ($res[$i] as $key => $value){} 

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
		$query_t = $pdo->query("SELECT * from $pagina where lancamento = '$busca' and data >= '$data_primeiro_reg' and data <= '$cp6' order by data asc, id asc");
		$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res_t)>0){
			for($it=0; $it < @count($res_t) and $id != $res_t[$it]['id']; $it++){
				foreach ($res_t[$it] as $key => $value){} 

					if($res_t[$it]['tipo'] == 'Entrada'){
						$total_saldo_periodo += $res_t[$it]['valor'];
					}else{
						$total_saldo_periodo -= $res_t[$it]['valor'];
					}
				}
			}


			if($cp1 == 'Entrada'){
				$classe = 'text-success';
				$total_saldo += $cp4;
				$total_saldo_periodo = $total_saldo_periodo + $cp4;
				$classe_linha = 'text-dark';

			}else{
				$classe = 'text-danger';
				$classe_linha = 'text-danger';
				$total_saldo -= $cp4;
				$total_saldo_periodo = $total_saldo_periodo - $cp4;
			}

			if($total_saldo < 0){
				$classe_saldo = 'text-danger';
			}else{
				$classe_saldo = 'text-success';
			}

			if($total_saldo_periodo < 0){
				$classe_saldo_periodo = 'text-danger';
			}else{
				$classe_saldo_periodo = 'text-success';
			}



			$query1 = $pdo->query("SELECT * from usuarios where id = '$cp5' ");
			$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
			if(@count($res1) > 0){
				$nome_usu = $res1[0]['nome'];
			}



			$data = implode('/', array_reverse(explode('-', $cp6)));
			$valor = number_format($cp4, 2, ',', '.');
			$total_saldoF = number_format($total_saldo, 2, ',', '.');
			$total_saldo_periodoF = number_format($total_saldo_periodo, 2, ',', '.');

			echo <<<HTML
			<tr class="{$classe_linha}">
			<td>{$data}</td>
			<td>{$cp2} <small>({$cp3})</small></td>	
			<td>{$cp9}</td>	
			<td>{$cp8}</td>	
			<td>{$nome_usu}</td>
			<td class="{$classe}">R$ {$valor}</td>		
			<td class="{$classe_saldo_periodo}">R$ {$total_saldo_periodoF}</td>
			<td>
			<a href="#" onclick="editar('{$id}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
			<a href="#" onclick="excluir('{$id}' , '{$cp3}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
			</td>
			</tr>
			HTML;
		} 
		echo <<<HTML
		</tbody>
		</table>
		<div class="row">
		<div class="col-md-6">
		<a title="Retirar Valores" class="text-success {$visivel}" href="#" onclick="fechamento()">
		<i class="bi bi-box-arrow-right mx-2"></i><span>Efetuar Fechamento</span>
		</a> 
		</div>

		<div class="col-md-6 my-3" align="right">


		Saldo do Período: <span class="{$classe_saldo}">R$ {$total_saldoF}</span><br>
		</div>
		</div>
		HTML;

	}else{
		echo 'Nenhum Registro foi Encontrado nessa data Inserida!';

		echo '<a title="Retirar Valores" class="text-success mx-4'.$visivel.'" href="#" onclick="fechamento()">
		<i class="bi bi-box-arrow-right mx-2"></i><span>Efetuar Fechamento</span>
		</a> ';
	}
	?>

	<script>
		$(document).ready(function() {    
			$('#<?=$pagina?>').DataTable({
			"ordering": false,
			 "stateSave": true,
		});

			$('#total_itens').removeClass();
			$('#icone_total').removeClass();

			var classe_saldo_geral = '<?=$classe_saldo_geral?>';
			
		

			$('#total_itens').addClass(classe_saldo_geral);
			$('#icone_total').addClass(classe_saldo_geral);
			$('#total_itens').text('R$ <?=$total_saldo_geralF?>');

			$('#valor-fec').val('<?=$total_saldo_geralF?>');

			calcularFechamento();
		} );




		function calcularFechamento(){
			var valorTotal = '<?=$total_saldo_geralF?>';
			var valorFec = $('#valor-fec').val();

			if(valorTotal > 999){
				valorFec = valorFec.replace(".", "");
				valorFec = valorFec.replace(",", ".");
			}else{
				valorFec = valorFec.replace(",", ".");
			}

			valorTotal = valorTotal.replace(".", "");
			valorTotal = valorTotal.replace(",", ".");
			
			if(valorFec == ""){
				valorFec = 0;
			}
			saldoTotal = parseFloat(valorTotal) -  parseFloat(valorFec);
			saldoTotalF = saldoTotal.toFixed(2);
			saldoTotalF = saldoTotalF.toString();
			saldoTotalF = saldoTotalF.replace(".", ",");
			$('#valor-dif').val('R$ ' + saldoTotalF);
			$('#valor-difer').val(saldoTotal);
			
		}


		function editar(id, cp2, cp3, cp4, cp6, cp7, cp8, cp9){

			$('#id').val(id);

			$('#movimento-edit').val(cp2);
			$('#descricao-edit').val(cp3);
			$('#valor-edit').val(cp4);
			$('#data-edit').val(cp6);
			$('#lancamento-edit').val(cp7);
			$('#plano-conta-edit').val(cp8);
			$('#documento-edit').val(cp9);


			var usuario = "<?=$nivel_usu?>";
			if(usuario != 'Administrador'){
				document.getElementById("valor-edit").readOnly = true;
				document.getElementById("data-edit").readOnly = true;
				document.getElementById("lancamento-edit").readOnly = true;
			}

			
			$('#tituloModal').text('Editar Registro');
			var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
			myModal.show();
			$('#mensagem').text('');
		}


	</script>