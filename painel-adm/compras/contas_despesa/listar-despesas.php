<?php

require_once("../../conexao.php");
require_once("campos.php");
$nome_cat = $_POST['cat'];
$despesa = @$_POST['despesa'];

$query = $pdo->query("SELECT * FROM cat_despesas where nome = '$nome_cat'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_cat = $res[0]['id'];

echo '<select class="form-select" aria-label="Default select example" name="' . $campo7 . '" id="' . $campo7 . '">';

$query = $pdo->query("SELECT * FROM despesas where cat_despesas = '$id_cat' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $id_item = $res[$i]['id'];
    $nome_item = $res[$i]['nome'];

    if ($despesa == $nome_item) {
        $selec = 'selected';
    } else {
        $selec = '';
    }

    echo '<option ' . $selec . ' value="' . $nome_item . '">' . $nome_item . '</option>';
}

echo '</select>';
