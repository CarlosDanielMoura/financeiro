<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$cp3 = $_SESSION['id_usuario'];
$nivel_usu = $_SESSION['nivel_usuario'];

$cp2 = $_POST[$campo2];
$cp2 = str_replace(',', '.', $cp2);

if($cp2 == ""){
	$cp2 = 0;
}

$id = @$_POST['id'];


if($id == ""){

	$query2 = $pdo->query("SELECT * FROM $pagina WHERE status = 'Aberto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		echo 'Você precisa antes fechar o caixa aberto para abrir outro!';
		exit();
	}

	$query = $pdo->prepare("INSERT INTO $pagina set data_ab = curDate(), valor_ab = :campo2, usuario_ab = :campo3, status = 'Aberto'");
	$query->bindValue(":campo3", "$cp3");
	$query->bindValue(":campo2", "$cp2");
	
	$query->execute();
}else{

	$query2 = $pdo->query("SELECT * FROM $pagina WHERE id = '$id'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$id_usu = $res2[0]['usuario_ab'];

	if($id_usu == $cp3 || $nivel_usu == 'Administrador'){
		$query = $pdo->prepare("UPDATE $pagina set valor_ab = :campo2 WHERE id = '$id'");
		$query->bindValue(":campo2", "$cp2");
		
		$query->execute();
	}else{
		echo 'Somente o usuário que abriu o caixa pode mudar o valor da abertura!';
		exit();
	}

	
}


echo 'Salvo com Sucesso!';
