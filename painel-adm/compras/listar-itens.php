<?php
require_once("../../conexao.php");
$pagina = 'produtos';
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = $pdo->query("DELETE FROM contas_pagar where id_compra = '-1' and usuario_lanc = '$id_usuario'");


echo '<ul class="order-list">';

$total_venda = 0;
$total_vendaF = 0;
$query_con = $pdo->query("SELECT * FROM itens_compra WHERE id_compra = 0 and usuario = '$id_usuario' 
order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id_venda = $res[$i]['id'];
        $id_item = $res[$i]['produto'];
        $quantidade = $res[$i]['quantidade'];
        $valor = $res[$i]['valor'];
        $valor_total_item = $res[$i]['total'];
        $valor_total_itemF =  number_format($valor_total_item, 2, ',', '.');

        $total_venda += $valor_total_item;
        $total_vendaF =  number_format($total_venda, 2, ',', '.');




        $query2 = $pdo->query("SELECT * FROM produtos where id = '$id_item'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $valor_produto = $res2[0]['valor_venda'];
        $nome_produto = $res2[0]['nome'];
        $foto_produto = $res2[0]['foto'];


        echo '<li class="mb-1"><img src="../img/produtos/' . $foto_produto . '"><h4 class="cabH4">';

        echo $quantidade . ' - ' . mb_strtoupper($nome_produto) . ' <a href="#" onclick="excluirItem(' . $id_venda . ')" title="Excluir Item" style="text-decoration: none">
				<i class="bi bi-x text-danger mx-1"></i>
								</a> </h4><h5 class="cabH5">' . $valor_total_itemF . '</h5></li>';
    }
}

echo '</ul>';
echo '<h5 class="total mt-4">Total de Itens (' . $total_reg . ')</h5>';
echo '<div class="row"><div class="col-md-6"><h2>R$ <span id="sub_total">' . @$total_vendaF . '</span></h2></div>';

echo '<div class="col-md-6" align="right"> </a>';

echo '<a style="text-decoration:none" class="text-danger ml-2" href="#" onclick="ModalFecharVenda()" title=" (F4) Fechar Compra"><i class="bi bi-cash"></i> <small>(F4)Fechar Compra R$</small> </a></div>';
echo '<small><div id="mensagem-fec"></div></small>';



?>


<script type="text/javascript">
$(document).ready(function() {
    $('#total-da-venda').text('R$ <?= $total_vendaF ?>');
    $('#subtotal').val('<?= $total_venda ?>');
    $('#parcelas').val('1');
    $('#data').val('<?=$data_atual?>');


});


function totalizarVenda() {
    var valorTotal = '<?= $total_venda ?>';
    saldoTotal = parseFloat(valorTotal) - parseFloat(desconto) + parseFloat(acrescimo);
    saldoTotal = saldoTotal.toFixed(2);

    $('#subtotal').val(saldoTotal)
    criarParcelas();
}
</script>