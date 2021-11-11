<?php
require_once("../../conexao.php");
require_once("campos.php");
session_start();
//Recuperando DADOS DOS CAMPOS
$cp2 = $_POST[$campo2];
$cp2 = str_replace(',', '.', $cp2);
$cp3 = $_SESSION['id_usuario'];


$id = @$_POST['id'];




if ($id == "") {
    $query = $pdo->prepare("INSERT INTO $pagina set data_ab = curDate(), valor_ab = :campo2, usuario_ab = :campo3, status = 'Aberto'");
    $query->bindValue(":campo3", "$cp3");
    $query->bindValue(":campo2", "$cp2");
    $query->execute();
} else {

    $query2 = $pdo->query("SELECT * FROM $pagina  WHERE id = '$id'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $id_usu = $res2[0]['usuario_ab'];

    if ($id_usu == $cp3) {
        $query = $pdo->prepare("UPDATE $pagina set valor_ab = :campo2 WHERE id = '$id'");
        $query->bindValue(":campo2", "$cp2");
        $query->execute();
    } else {
        echo 'Somente o usuário que fez abertura de caixa pode mudar o valor de caixa';
        exit();
    }
}


echo 'Salvo com Sucesso!';
