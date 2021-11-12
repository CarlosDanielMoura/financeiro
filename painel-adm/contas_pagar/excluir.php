<?php
require_once('../../conexao.php');
require_once('campos.php');

@session_start();

$cp3 = $_SESSION['id_usuario'];
$id = @$_POST['id-excluir'];

$query2 = $pdo->query("SELECT * FROM $pagina  WHERE id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_usu = $res2[0]['usuario_ab'];

if ($id_usu == $cp3) {
    $consulta = $pdo->query("DELETE FROM $pagina  WHERE id = '$id'");
    echo 'Excluído com Sucesso!';
} else {
    echo 'Só pode excluir o caixa o usuário que fez a abertura do mesmo!';
}
