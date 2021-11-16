<?php
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
    $pdo->query("DELETE from $pagina where id = '$id'");
    echo 'Excluído com Sucesso!';
} else {
    echo 'Dados Incorretos ou o usuário não é um Administrador!';
}
