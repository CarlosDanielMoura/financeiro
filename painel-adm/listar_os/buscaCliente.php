<?php 

require_once("../../conexao.php");

@session_start();

if (!empty($_POST['id_cliente'])) {

    $id = $_POST['id_cliente'];
    $query = $pdo->query("SELECT * from clientes where id = $id");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res) > 0) {
        http_response_code(200);
        $json = json_encode($res);
        echo $json;
    } else {
        http_response_code(404);
        die();
    }
} else {
    http_response_code(404);
    die();
}
?>