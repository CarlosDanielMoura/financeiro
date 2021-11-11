<?php

require_once('../../conexao.php');
require_once('campos.php');

@session_start();

$id = @$_POST['id-fechar'];

$id_usuario = @$_SESSION['id_usuario'];
$ativo = @$_POST['ativar'];

$consulta = $pdo->query("UPDATE  $pagina SET data_fec = curDate() , status = 'Fechado' , usuario_fec = '$id_usuario' where id = '$id'");
echo 'Fechado com Sucesso!';
