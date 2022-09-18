<?php 



require_once("../../conexao.php");

@session_start();

if (!empty($_POST['ordem'])) {

    $id = $_POST['ordem'];
    $query = $pdo->query("SELECT * from ordem_servico where id = $id");
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