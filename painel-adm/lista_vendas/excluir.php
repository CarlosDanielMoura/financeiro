<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$nivel_usu = $_SESSION['nivel_usuario'];

$id = @$_POST['id-excluir'];
$usuario_adm = @$_POST['usuario_adm'];
$senha_adm = @$_POST['senha_adm'];


$query = $pdo->prepare("SELECT * from usuarios where email = :email and senha = :senha and nivel = 'Administrador' ");
$query->bindValue(":email", "$usuario_adm");
$query->bindValue(":senha", "$senha_adm");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0 || $nivel_usu == 'Administrador') {

    //DEVOLVER OS PRODUTOS AO ESTOQUE
    $query = $pdo->query("SELECT * from itens_venda where id_venda = '$id' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < @count($res); $i++) {
        foreach ($res[$i] as $key => $value) {
        }
        $id_prod =  $res[$i]['produto'];
        $quant_prod =  $res[$i]['quantidade'];

        $query2 = $pdo->query("SELECT * from produtos where id = '$id_prod' ");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $estoque = $res2[0]['estoque'];
        $novo_estoque = $estoque + $quant_prod;
        $query = $pdo->query("UPDATE produtos set estoque = '$novo_estoque' where id = '$id_prod' ");
    }


    //EXCLUIR DAS CONTAS A RECEBER CASO EXISTA
    $pdo->query("DELETE FROM contas_receber where id_venda = '$id'");

    //EXCLUIR DAS MOVIMENTAÇÕES CASO EXISTA
    $pdo->query("DELETE FROM movimentacoes where id_mov = '$id' and plano_conta = 'Venda'");

    $pdo->query("UPDATE vendas set status = 'Cancelada' where id = '$id'");
    echo 'Excluído com Sucesso!';
} else {
    echo 'Dados Incorretos ou o usuário não é um Administrador!';
}
