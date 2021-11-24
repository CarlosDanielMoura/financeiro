<?php

$nome_sistema = 'ÓPTICA NÚCLEO DA VISÃO';
$url_sistema = 'http://localhost/financeiro/index.php';
$email_adm = 'contato@carlos.com.br';
$nome_adm = 'Carlos Daniel';

// DADOS PARA O BANCO DE DADOS

$servidor = 'localhost';
$usuario = 'root';
$senha = 'root';
$banco = 'financeiro';


//VARIAVEIS GLOBAIS

$nivel_minimo_estoque = 5; // A partir desse valor para baixo será nével baixo do estoque

//VARIAVEIS PARA CONTAS À RECEBER

$valor_multa = 0.02; //0.02 PARA 2% SE FOR 20% SERIA POR EXEMPLO 0.2
$valor_juros_dia = 0.15;
$dias_carencia = 0;
