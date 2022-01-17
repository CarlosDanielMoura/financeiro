<?php
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$cp10 = $_SESSION['id_usuario'];

$cp1 = $_POST[$campo1];
$cp2 = @$_POST[$campo2];
$cp3 = $_POST[$campo3];
$cp4 = $_POST[$campo4];
$cp5 = 'Venda';
$cp6 = $_POST[$campo6];
$cp7 = $_POST[$campo7];
$cp8 = $_POST[$campo8];
$cp9 = $_POST[$campo9];


$cp9 = str_replace(',', '.', $cp9);

if ($cp2 == "" and $cp1 == "") {
    echo 'SELECIONE UM ClIENTE OU COLOQUE UMA DESCRIÇÃO';
    exit();
}




if ($cp9 == "") {
    echo 'PREENCHA O VALOR';
    exit();
}


//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') . '-' . @$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/', '-', $nome_img);

$caminho = '../../img/contas/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
    $imagem = "sem-foto.jpg";
} else {
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'JPG' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip') {
    move_uploaded_file($imagem_temp, $caminho);
} else {
    echo 'Extensão de Imagem não permitida!';
    exit();
}


$id = @$_POST['id'];


if ($id == "") {

    $query = $pdo->prepare("INSERT INTO $pagina set descricao = :campo1, cliente = :campo2, entrada = :campo3,
     documento = :campo4, plano_conta = :campo5, data_emissao = :campo6, vencimento = :campo7, 
     frequencia = :campo8, valor = :campo9, usuario_lanc = :campo10, status = 'Pendente', 
     data_recor = curDate(),arquivo = '$imagem'");
} else {

    $query = $pdo->query("SELECT * FROM $pagina where id = '$id'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $arquivo_reg = $res[0]['arquivo'];

    if (@$_FILES['imagem']['name'] == "") {
        $imagem = $arquivo_reg;
    } else {

        if ($arquivo_reg != "sem-foto.jpg") {
            @unlink('../../img/contas/' . $arquivo_reg);
        }
    }

    $query = $pdo->prepare("UPDATE $pagina set descricao = :campo1, cliente = :campo2, entrada = :campo3, 
    documento = :campo4, plano_conta = :campo5, data_emissao = :campo6, vencimento = :campo7, 
    frequencia = :campo8, valor = :campo9, usuario_lanc = :campo10, arquivo = '$imagem' WHERE id = '$id'");
}

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "$cp2");
$query->bindValue(":campo3", "$cp3");
$query->bindValue(":campo4", "$cp4");
$query->bindValue(":campo5", "$cp5");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");
$query->bindValue(":campo9", "$cp9");
$query->bindValue(":campo10", "$cp10");


$query->execute();


echo 'Salvo com Sucesso!';
