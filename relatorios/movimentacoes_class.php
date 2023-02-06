<?php

require_once('../config.php');

$tipo = @$_POST['tipo-rel'];
$data_inicial = @$_POST['data-inicial-rel'];
$data_final = @$_POST['data-final-rel'];
$plano_conta = @$_POST['cat-despesas-rel'];
$sub_plano_conta = @$_POST['sub-cat-plano'];
$forma_pgto = @$_POST['pgto-rel'];
$tipo_mov = @$_POST['tipo-mov'];
$local_mov = @$_POST['local-mov'];

$tipo = str_replace(' ', '-', $tipo);
$plano_conta = str_replace(' ', '-', $plano_conta);
$sub_plano_conta = str_replace(' ', '-', $sub_plano_conta);
$forma_pgto = str_replace(' ', '-', $forma_pgto);
$local_mov = str_replace(' ', '-', $local_mov);

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema . "relatorios/movimentacoes.php?tipo=$tipo&data_inicial=$data_inicial&data_final=$data_final&plano_conta=$plano_conta&sub_plano_conta=$sub_plano_conta&forma_pgto=$forma_pgto&tipo_mov=$tipo_mov&local_mov=$local_mov");

if ($relatorio_pdf != 'Sim') {
    echo $html;
    exit();
}


//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);

$pdf = new DOMPDF($options);

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
    'movimentacoes.pdf',
    array("Attachment" => false)
);
