<?php
require_once('../../conexao.php');
require_once('campos.php');

$id = @$_POST['id-excluir'];


//Consulta tabela DESPESAS para remover categoria
$query = $pdo->query("SELECT * from despesas where cat_despesas = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);


if ($total_reg == 0) {
    $consulta = $pdo->query("DELETE FROM $pagina WHERE id = '$id'");
    echo 'Excluído com Sucesso!';
} else {
    echo 'Este categoria possui despesas associadas a ela, primeiro exclua estas despesas e depois exclua a categoria!';
}
