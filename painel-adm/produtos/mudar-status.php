<?php

require_once('../../conexao.php');
require_once('campos.php');

$id = @$_POST['id'];
$ativo = @$_POST['ativar'];

$consulta = $pdo->query("UPDATE  $pagina SET ativo = '$ativo' where id = '$id'");
echo 'Alterado com Sucesso!';
