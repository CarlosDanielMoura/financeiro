<?php
require_once('../conexao.php');

$nome = $_POST['nome-usuario'];
$email = $_POST['email-usuario'];
$senha = $_POST['senha-usuario'];
$id = $_POST['id-usuario'];


//Validar email
$consulta = $pdo->query("SELECT * from usuarios where email = '$email' ");
$res = $consulta->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

$id_usu = @$res[0]['id'];

if ($total_reg > 0 and $id_usu != $id) {
    echo 'Este email já está cadastrado para usuário ' . $res[0]['nome'] . ' escolha outro email';
    exit();
}



$consulta = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = '$id' ");
$consulta->bindValue(":nome", "$nome");
$consulta->bindValue(":email", "$email");
$consulta->bindValue(":senha", "$senha");
$consulta->execute();

echo 'Salvo com Sucesso!';
