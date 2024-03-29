<?php

require_once('../config.php');

$id = $_GET['id'];

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema . "relatorios/ordemServicos.php?id=" . $id);

if ($relatorio_pdf == 'Sim') {
    echo $html;
    exit();
}


//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$pdf = new DOMPDF();
$pdf->set_option('isRemoteEnabled', TRUE);

//Definir o tamanho do papel e orientação da página
$pdf->set_paper(array(0, 0, 497.64, 700), 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
    'Comprovante-Ordem-Servico.pdf',
    array("Attachment" => false)
);
