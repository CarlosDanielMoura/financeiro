<?php

$nome_sistema = 'ÓPTICA NÚCLEO DA VISÃO';
$url_sistema = 'http://localhost/financeiro/';
$email_adm = 'contato@carlos.com.br';
$nome_adm = 'Carlos Daniel';


$endereco_site = 'Rua. Arthur Bernades, 521 - Centro, Coromandel - MG CEP 38550-000';
$telefone_fixo = '(34) 9 9336-5163';
$telefone_whatsapp = '55 (34) 9 9336-5163';
$telefone_whatsapp_link = '55 (34) 9 9999-9999';
$cnpj_site = '39.226.470/0001-03';


// DADOS PARA O BANCO DE DADOS

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'financeiro';


//VARIAVEIS GLOBAIS

$nivel_minimo_estoque = 5; // A partir desse valor para baixo será nével baixo do estoque

//VARIAVEIS PARA CONTAS À RECEBER

$valor_multa = 2; //0.02 PARA 2% SE FOR 20% SERIA POR EXEMPLO 0.2
$valor_juros_dia = 0.15;
$dias_carencia = 0;

$frequencia_automatica = 'Não'; /* Caso utilize sim e tenha uma conta que foi lançada mensal, todo mês será 
gerada uma conta independente se a anterior foi paga*/

$relatorio_pdf = 'Sim'; /*Se estiver sim  o relatorio vai sair em PDF caso ao contrario será 
relatorio em html*/
