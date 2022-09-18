<?php
require_once("../../conexao.php");
require_once("../verificar.php");
@session_start();
$nivel_usu = $_SESSION['nivel_usuario'];

$id = $_POST['id'];



$query = $pdo->query("SELECT * from contas_receber where  cliente = '$id'");
// $res = $query->fetchAll(PDO::FETCH_ASSOC);
// $json = json_encode($res);
// print_r($json);

echo <<<HTML
<table id="clientes_parcelas" class="table table-light table-hover my-4">
<thead>
<tr>
<th>Parcela</th>
<th>Vencimento</th>		
<th>Valor</th>	
<th>Vlr Pago</th>	
<th>Data Pag</th>	
<th>Venda</th>
<th>Status</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;

$total_valor = 0;
$total_valorF = 0;
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){} 

		$id = $res[$i]['id'];
		$id_venda = $res[$i]['id_venda'];
		$cp1 = $res[$i]['descricao'];
		$cp2 = $res[$i]['cliente'];
		$cp3 = $res[$i]['entrada'];
		$cp4 = $res[$i]['documento'];
		$cp5 = $res[$i]['plano_conta'];
		$cp6 = $res[$i]['data_emissao'];
		$cp7 = $res[$i]['vencimento'];
		$cp8 = $res[$i]['frequencia'];
		$cp9 = $res[$i]['valor'];
		$cp10 = $res[$i]['usuario_lanc'];
		$cp11 = $res[$i]['usuario_baixa'];
		$subtotal = $res[$i]['subtotal'];
		$arquivo = $res[$i]['arquivo'];
		
		$cp13 = $res[$i]['status'];
		$cp18 = $res[$i]['data_baixa'];

		if($cp13 == 'Paga'){
			$classe = 'text-success';
			$ocutar = 'd-none';
		}else{
			$classe = 'text-danger';
			$total_valor += $cp9;
			$total_valorF = number_format($total_valor, 2, ',', '.');
			$ocutar = '';
		}


	

		$query1 = $pdo->query("SELECT * from usuarios where id = '$cp10' ");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res1) > 0){
			$nome_usu_lanc = $res1[0]['nome'];
		}else{
			$nome_usu_lanc = 'Sem Usuário';
		}

		$query1 = $pdo->query("SELECT * from usuarios where id = '$cp11' ");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res1) > 0){
			$nome_usu_baixa = $res1[0]['nome'];
		}else{
			$nome_usu_baixa = 'Sem Usuário';
		}

		$descricao = $cp1;

		$query1 = $pdo->query("SELECT * from clientes where id = '$cp2' ");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res1) > 0){
			$nome_cliente = $res1[0]['nome'];
			$telefone_cliente = $res1[0]['telefone'];
			$classe_whats = '';
						
		}else{
			$nome_cliente = 'Sem Cliente';
			$classe_whats = 'd-none';
			$telefone_cliente = "";
		}

		if($descricao == ''){
			$descricao = $nome_cliente;
		}

	
		$data_emissao = implode('/', array_reverse(explode('-', $cp6)));
		$data_venc = implode('/', array_reverse(explode('-', $cp7)));
		$cp18 = implode('/', array_reverse(explode('-', $cp18)));

		$valor = number_format($cp9, 2, ',', '.');


		//PEGAR RESIDUOS DA CONTA
		$total_resid = 0;
		$valor_com_residuos = 0;
		$query2 = $pdo->query("SELECT * FROM valor_parcial WHERE id_conta = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){

		$descricao = '(Resíduo) - ' .$descricao;
	
		for($i2=0; $i2 < @count($res2); $i2++){
		foreach ($res2[$i2] as $key => $value){} 
			$id_res = $res2[$i2]['id'];
			$valor_resid = $res2[$i2]['valor'];
			$total_resid += $valor_resid;
		}


		$valor_com_residuos = $cp9 + $total_resid;
	}
		if($valor_com_residuos > 0){
			$vlr_antigo_conta = '('.$valor_com_residuos.')';
			$descricao_link = '';
			$descricao_texto = 'd-none';
		}else{
			$vlr_antigo_conta = '';
			$descricao_link = 'd-none';
			$descricao_texto = '';
		}
		
		
echo <<<HTML
	<tr>
	<td>
	<i class="bi bi-square-fill $classe"></i>
	<span class="{$descricao_link}">
	<a href="#" onclick="mostrarResiduos('{$id}')" class="text-dark" title="Ver Resíduos">{$descricao}</a>
	</span>
	<span class="{$descricao_texto}">
	{$descricao}
	</span>
	</td>		
	<td>{$data_venc}</td>	
	<td>R$ {$valor} <small><a href="#" onclick="mostrarResiduos('{$id}')" class="text-success" title="Ver Resíduos">{$vlr_antigo_conta}</a></small></td>	
	<td>{$subtotal}</td>	
		
	<td>{$cp18}</td>	
	<td>{$id_venda}</td>	
	<td>{$cp13}</td>						
	<td>
	<a href="#" onclick="baixar('{$id}' , '{$cp1}', '{$cp9}', '$cp3')" title="Dar Baixa">	<i class="bi bi-check-square text-success mx-1 {$ocutar}"></i> </a>
	</td>
	</tr>
HTML;
} 
echo <<<HTML
</tbody>
</table>
HTML;

?>

<script>
$(document).ready(function() {    
	$('#clientes_parcelas').DataTable({
			"ordering": false,
			 "stateSave": true,
		});

	$('#total_itens').text('R$ <?=$total_valorF?>');
} );


function mostrarResiduos(id){

    $.ajax({
    url: `clientes/listar-residuos.php`,
    method: 'POST',
    data: {id},
    dataType: "html",

    success:function(result){
        $("#listar-residuos-clientes").html(result);
    }
    });

var myModal = new bootstrap.Modal(document.getElementById('modalResiduosClientes'), {		});
myModal.show();
$('#mensagem').text('');
}
</script>
