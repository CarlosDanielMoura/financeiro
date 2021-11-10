<?php

date_default_timezone_set('America/Sao_Paulo');

require_once("config.php");

try {
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
    echo 'Não foi possível conectar o banco de dados' . $e;
}
