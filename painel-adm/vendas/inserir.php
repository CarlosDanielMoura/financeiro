<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$pagamento = $_POST['pagamento'];
$lancamento = $_POST['lancamento'];
$data = $_POST['data'];

$total_venda = 0;
$query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = 0 and usuario = '$id_usuario' order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $valor_total_item = $res[$i]['total'];
        $total_venda += $valor_total_item;
    }
} else {
    echo 'Não é possível fechar a venda sem itens!';
    exit();
}



$query = $pdo->prepare("INSERT INTO vendas set valor = '$total_venda', usuario = '$id_usuario',
 pagamento = :pagamento, lancamento = :lancamento, data_lanc = CurDate(), data_pgto = :data");


$query->bindValue(":pagamento", "$pagamento");
$query->bindValue(":lancamento", "$lancamento");
$query->bindValue(":data", "$data");
$query->execute();
$id_ult_registro = $pdo->lastInsertId();



$query_con = $pdo->query("SELECT * FROM itens_venda WHERE id_venda = 0 and usuario = '$id_usuario' order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $pdo->query("UPDATE itens_venda set id_venda = '$id_ult_registro' where id_venda = 0 and usuario = '$id_usuario'");
    }
}


echo 'Salvo com Sucesso!';
