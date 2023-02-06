<?php
require_once("../../conexao.php");

@session_start();

$id = @$_POST['id-excluir'];


$pdo->query("UPDATE ordem_servico set status = 'Cancelada' where id = '$id'");
echo 'Excluído com Sucesso!';
