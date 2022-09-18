<?php 
require_once("../../conexao.php");
require_once("campos.php");
$id = $_POST['id'];

echo <<<HTML
<table id="example" class="table table-light table-hover my-4">
<thead>
<tr>
<th>Status</th>
<th>SubTotal</th>
<th>Pagamento</th>	
<th>Lançamento</th>	
<th>Vencimento</th>	
<th>Parcelas</th>
<th>Cliente</th>								
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;


$query = $pdo->query("SELECT * from vendas where cliente = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){} 

		$id = $res[$i]['id'];
		$cp1 = $res[$i]['valor'];
		$cp2 = $res[$i]['usuario'];
		$cp3 = $res[$i]['pagamento'];
		$cp4 = $res[$i]['lancamento'];
		$cp5 = $res[$i]['data_lanc'];
		$cp6 = $res[$i]['data_pgto'];
		$cp7 = $res[$i]['desconto'];
		$cp8 = $res[$i]['acrescimo'];
		$cp9 = $res[$i]['subtotal'];
		$cp10 = $res[$i]['parcelas'];
		$cp11 = $res[$i]['status'];
		$cp12 = $res[$i]['cliente'];
		$cp13 = $res[$i]['tipoEntrada'];
		$cp14 = $res[$i]['recebido'];

		if($cp11 == 'Concluída'){
			$classe = 'text-success';
			$ocultar = '';
			
		}else if($cp11 == 'Cancelada'){
			$classe = 'text-warning';
			$ocultar = 'd-none';
		}
		else{
			$classe = 'text-danger';
			$ocultar = '';
			}

			$cp1 = number_format($cp1, 2, ',', '.');
			$cp9 = number_format($cp9, 2, ',', '.');
			$cp14 = number_format($cp14, 2, ',', '.');
			$cp6 = implode('/', array_reverse(explode('-', $cp6)));
			$cp5 = implode('/', array_reverse(explode('-', $cp5)));

			$query1 = $pdo->query("SELECT * from clientes where id = '$cp12' ");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res1) > 0){
			$nome_cliente = $res1[0]['nome'];
						
		}else{
			$nome_cliente = 'Sem Cliente';
		}
		if($cp13 == ''){
			$cp13 = 'Sem Entrada';
		}

		$query1 = $pdo->query("SELECT * from usuarios where id = '$cp2' ");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		$nome_usuario = $res1[0]['nome'];


echo <<<HTML
	<tr>
	<td>
	<i class="bi bi-square-fill $classe"></i>
	</td>		
	<td>R$ {$cp1}</td>	
	<td>{$cp3}</td>	
	<td>{$cp4}</td>	
	<td>{$cp6}</td>	
	<td><a class="mx-1 text-dark" href="#" onclick="mostrarDados('{$id}', '{$cp1}', '{$nome_usuario}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}', '{$cp10}', '{$cp11}', '{$nome_cliente}', '{$cp13}', '{$cp14}')" title="Ver Dados da Venda">{$cp10}</a></td>		
	<td>{$nome_cliente}</td>									
	<td>
	<a class="mx-1" href="#" onclick="mostrarDados('{$id}', '{$cp1}', '{$nome_usuario}', '{$cp3}', '{$cp4}', '{$cp5}',  '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}', '{$cp10}', '{$cp11}', '{$nome_cliente}', '{$cp13}', '{$cp14}')" title="Ver Dados da Venda">
	<i class="bi bi-exclamation-square"></i></a>

	<a href="../relatorios/venda_class.php?id={$id}" title="Gerar Comprovante" target="_blank">	<i class="bi bi-file-earmark-check text-success"></i> </a>

	

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
	$('#example').DataTable({
		"ordering": false
	});

} );


function mostrarDados(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10, cp11, cp12,cp13, cp14){
	$('#campo1-cliente').text(cp1);
	$('#campo2-cliente').text(cp2);
	$('#campo3-cliente').text(cp3);
	$('#campo4-cliente').text(cp4);
	$('#campo5-cliente').text(cp5);
	$('#campo6-cliente').text(cp6);
	$('#campo7-cliente').text(cp7);
	$('#campo8-cliente').text(cp8);
	$('#campo9-cliente').text(cp9);
	$('#campo10-cliente').text(cp10);
	$('#campo11-cliente').text(cp11);
	$('#campo12-cliente').text(cp12);
	$('#campo13-cliente').text(cp13);
	$('#campo14-cliente').text(cp14);
	$('#subtot-cliente').text(cp9);
	$('#id-cliente').text(id);
	
	var myModal = new bootstrap.Modal(document.getElementById('modalDadosCliente'), {		});
	myModal.show();

	listarParcelas(id);
	listarProdutos(id);
	
}


function listarParcelas(id){
	$.ajax({
        url: "lista_vendas/listar-parcelas.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar-parcelas-cliente").html(result);
        }
    });
}


function listarProdutos(id){
	$.ajax({
        url:"lista_vendas/listar-produtos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar-produtos-cliente").html(result);
        }
    });
}
</script>