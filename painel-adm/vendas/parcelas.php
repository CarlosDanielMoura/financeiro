<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = $pdo->query("DELETE FROM contas_receber where id_venda = '-1' and usuario_lanc = '$id_usuario'");

$valor = $_POST['valor']; //trocar por valor
$data = $_POST['data'];
$parcelas = $_POST['parcelas'];

if ($data == '') {
    $data = date('Y-m-d');
}


if ($parcelas > 1) {
    $novo_valor = $valor / $parcelas;
    for ($i = 1; $i <= $parcelas; $i++) {
        $query = $pdo->prepare("INSERT INTO contas_receber set descricao = :descricao, 
		data_emissao = curDate(), vencimento = :data, frequencia = 'Uma Vez',  valor = :valor,
		 usuario_lanc = '$id_usuario', status = 'Pendente', id_venda = '-1'");

        $query->bindValue(":valor", "$novo_valor");
        $query->bindValue(":descricao", "Parcela " . $i);
        $query->bindValue(":data", "$data");
        $query->execute();

        $data = date('Y/m/d', strtotime("+1 month", strtotime($data)));
    }
}





echo 'Inserido com Sucesso!';
