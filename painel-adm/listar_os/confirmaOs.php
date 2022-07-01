<?php
require_once("../../conexao.php");

@session_start();

$id = @$_POST['id-confirma-os'];

$pdo->query("UPDATE ordem_servico set status = 'Confirmada' where id = '$id'");
echo 'Confirmado com Sucesso!';