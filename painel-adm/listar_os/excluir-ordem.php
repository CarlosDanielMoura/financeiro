<?php
require_once("../../conexao.php");

@session_start();

$id = @$_POST['id-excluir-ordem'];

$consulta = $pdo->query("DELETE FROM ordem_servico  WHERE id = '$id'");
echo 'Excluído com Sucesso!';