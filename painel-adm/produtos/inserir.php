<?php
require_once("../../conexao.php");
require_once("campos.php");



$cp1 = $_POST[$campo1];
$cp2 = $_POST[$campo2];
$cp3 = $_POST[$campo3];
$cp4 = @$_POST[$campo4];
$cp5 = $_POST[$campo5];
$cp5 = str_replace(',', '.', $cp5);
$cp6 = $_POST[$campo6];
$cp6 = str_replace(',', '.', $cp6);
$cp7 = "";
$cp8 = $_POST[$campo8];

$cp10 = $_POST[$campo10];

if($cp5 == ''){
    $cp5 = 0;
}

if($cp4 ==''){
    $cp4 = 0;
}

$id = @$_POST['id'];

//VALIDAR CAMPO
$query = $pdo->query("SELECT * from $pagina where nome = '$cp2'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if ($total_reg > 0 and $id_reg != $id) {
    echo 'Este registro já está cadastrado!!';
    exit();
}


$query = $pdo->query("SELECT * from $pagina where codigo = '$cp1'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if ($total_reg > 0 and $id_reg != $id) {
    echo 'Este registro já está cadastrado!!';
    exit();
}




//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') . '-' . @$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/', '-', $nome_img);

$caminho = '../../img/' . $pagina . '/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
    $imagem = "sem-foto.jpg";
} else {
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
    move_uploaded_file($imagem_temp, $caminho);
} else {
    echo 'Extensão de Imagem não permitida!';
    exit();
}



if ($id == "") {
    $query = $pdo->prepare("INSERT INTO $pagina set codigo = :campo1, nome = :campo2,
     descricao = :campo3, valor_compra = :campo5, valor_venda = :campo6,
      fornecedores = :campo7,  categoria = :campo8, foto = :campo9, ativo = :campo10");
    $query->bindValue(":campo9", "$imagem");
} else {

    if ($imagem == "sem-foto.jpg") {
        $query = $pdo->prepare("UPDATE $pagina set codigo = :campo1, nome = :campo2, 
        descricao = :campo3, valor_compra = :campo5, valor_venda = :campo6, fornecedores = :campo7,  
        categoria = :campo8, ativo = :campo10 WHERE id = '$id'");
    } else {

        //BUSCAR A IMAGEM PARA EXCLUIR DA PASTA
        $query_con = $pdo->query("SELECT * FROM produtos WHERE id = '$id'");
        $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
        $imagem_antiga = $res_con[0]['foto'];
        if ($imagem_antiga != 'sem-foto.jpg') {
            @unlink('../../img/produtos/' . $imagem_antiga);
        }

        $query = $pdo->prepare("UPDATE $pagina set codigo = :campo1, nome = :campo2, descricao = :campo3, 
        valor_compra = :campo5, valor_venda = :campo6, fornecedor = :campo7, categoria = :campo8,
        foto = :campo9, ativo = :campo10 WHERE id = '$id'");
        $query->bindValue(":campo9", "$imagem");
    }
}

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "$cp2");
$query->bindValue(":campo3", "$cp3");
$query->bindValue(":campo5", "$cp5");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");
$query->bindValue(":campo10", "$cp10");
$query->execute();

echo 'Salvo com Sucesso!';
