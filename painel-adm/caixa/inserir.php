<?php
require_once("../../conexao.php");
require_once("campos.php");
session_start();
//Recuperando DADOS DOS CAMPOS
$cp2 = $_POST[$campo2];
$cp2 = str_replace(',', '.', $cp2);
$cp3 = $_SESSION['id_usuario'];

if ($cp2 == "") {
    $cp2 = 0;
}



$id = @$_POST['id'];




if ($id == "") {
    // VERIFICAÇÃO DE ABERTURA DE CAIXA
    $query3 = $pdo->query("SELECT * FROM $pagina  WHERE status = 'Aberto'");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

    if (@count($res3) > 0) {
        echo 'Você precisa antes fechar o caixa aberto para realizar a abertura de outro!';
        exit();
    }


    //ADICIONANDDO CAIXA
    $query = $pdo->prepare("INSERT INTO $pagina set data_ab = curDate(), valor_ab = :campo2, usuario_ab = :campo3, status = 'Aberto', saldo = 0");
    $query->bindValue(":campo3", "$cp3");
    $query->bindValue(":campo2", "$cp2");
    $query->execute();
} else {
    //EDITANDO CAIXA
    $query2 = $pdo->query("SELECT * FROM $pagina  WHERE id = '$id'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $id_usu = $res2[0]['usuario_ab'];

    if ($id_usu == $cp3) {
        $query = $pdo->prepare("UPDATE $pagina set valor_ab = :campo2, saldo = :campo7 WHERE id = '$id'");
        $query->bindValue(":campo2", "$cp2");
        $query->bindValue(":campo7", "$saldo");
        $query->execute();
    } else {
        echo 'Somente o usuário que fez abertura de caixa pode mudar o valor de caixa';
        exit();
    }
}


echo 'Salvo com Sucesso!';
