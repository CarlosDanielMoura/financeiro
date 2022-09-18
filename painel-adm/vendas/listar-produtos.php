<?php 
require_once("../../conexao.php");
$pagina = 'produtos';

echo <<<HTML
<table id="exampleProd" class="table  table-light table-hover my-4">
<thead>
<tr>
<th style="">Código</th>
<th style="width:35%">Nome</th>
<th style="text-align:center; width:20%">Valor</th>
<th style="text-align:center">Estoque</th>
<th style="text-align:center: width:10%">Tip. Produto</th>
<th style="text-align:center">Quantidade</th>
<th style="text-align:center">ADD</th>
</tr>
</thead>
<tbody>
HTML;


$query = $pdo->query("SELECT * from $pagina where ativo = 'Sim' order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){} 

		$id_reg = $res[$i]['id'];
		$codigo = $res[$i]['codigo'];
		$cp1 = $res[$i]['nome'];
		$cp2 = $res[$i]['descricao'];
		$cp3 = $res[$i]['estoque'];
		$cp4 = $res[$i]['valor_compra'];
		$cp5 = $res[$i]['valor_venda'];
		$cp6 = $res[$i]['fornecedores'];
		$cp7 = $res[$i]['categoria'];
		$cp8 = $res[$i]['foto'];
		$cp9 = $res[$i]['ativo'];
		$cp12 = $res[$i]['tipoProduto'];

		if($cp12 == 'Laboratorio'){
			$ocultar = 'hidden';
			$cp12 = 'laboratório' .' (Par)';
		}else{
			$ocultar = '';
		}

		
		$query2 = $pdo->query("SELECT * FROM cat_produtos where id = '$cp7'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome_cat = $res2[0]['nome'];

		$cp5 = number_format($cp5, 2, ',', '.');
		$cp4 = number_format($cp4, 2, ',', '.');

echo <<<HTML
	<tr>
	<td style="width:40%">{$codigo}</td>
	<td style="width:40%">{$res[$i]['nome']}</td>
	<td style="text-align:center; width:20%">R$ {$cp5}</td>
	<td style="text-align:center;"  ><span style="visibility: $ocultar ">{$res[$i]['estoque']}</span></td>
	<td style="text-align:center" >{$cp12}</td>
	<td style="text-align:center">
	<input class="form-control form-control-sm" value="1" type="number" id="qtd-{$id_reg}" >
	</td>
	<td style="text-align:center">
	<a href="" onclick="addProduto({$id_reg})" title="Add Produto">
		<i class="bi bi-check-square text-primary"></i></a>
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
	$('#exampleProd').DataTable({
		"ordering": false,
		"lengthMenu": [[5, 8, 10, -1], [5, 8, 10, "Todos"]]
	});

	$('#exampleProd_filter label input').focus();

} );


function addProduto(id){
	var quant = $('#qtd-'+id).val();
	 event.preventDefault();
	 $.ajax({
        url: "vendas/inserir-item.php",
        method: 'POST',
        data: {id, quant},
        dataType: "text",

        success: function (mensagem) {
        	$('#mensagem-itens').text('');
            $('#mensagem-itens').removeClass()
            if (mensagem.trim() == "Inserido com Sucesso!") {

                listarItens();
                listarProdutos();
            }else{
            	$('#mensagem-itens').addClass('text-danger')
                $('#mensagem-itens').text(mensagem)
            }               
        },

    });
}

</script>




