<?php
require_once('../../conexao.php');
require_once('campos.php');
$id = @$_POST['id-excluir'];


$consulta = $pdo->query("DELETE FROM $pagina  WHERE id = '$id'");
echo 'Excluído com Sucesso!';
