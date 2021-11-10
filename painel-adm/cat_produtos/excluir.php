<?php
require_once('../../conexao.php');
require_once('campos.php');

$id = @$_POST['id-excluir'];


$consulta = $pdo->query("SELECT * FROM produtos WHERE categoria = '$id'");
$res = $consulta->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg == 0) {
    $consulta = $pdo->query("DELETE FROM $pagina WHERE id = '$id'");
    echo 'Excluído com Sucesso!';
} else {
    echo 'Este categoria possui produtos associadas a ela, primeiro exclua estes produtos e depois exclua a categoria!';
}
