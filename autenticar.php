<?php
@session_start();

require_once("conexao.php");


// Autenticando Usuario

$email = $_POST['email'];
$senha = $_POST['senha'];

$consulta = $pdo->prepare("SELECT * from usuarios where email = :email and senha = :senha ");
$consulta->bindValue(":email", "$email");
$consulta->bindValue(":senha", "$senha");
$consulta->execute();
$res = $consulta->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    $nivel = $res[0]['nivel']; // Pegando na coluna

    //VARIAVEL DE SESSÃO
    $_SESSION['nivel_usuario'] = $res[0]['nivel'];
    $_SESSION['id_usuario'] = $res[0]['id'];
    $_SESSION['nome_usuario'] = $res[0]['nome'];

    if ($nivel == 'Administrador' || $nivel == 'Comum') {
        echo "<script>window.location='painel-adm' </script>";
    }
} else {
    echo "<script>window.alert('Usuário não encontrado')='painel-adm' </script>";
    echo "<script>window.location='index.php' </script>";
}
