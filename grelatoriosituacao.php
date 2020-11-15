<?php
    include('verificaLogin.php');
    $acao = "Gerou relatório por situação em PDF";
    include('registraMovimento.php'); 
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

    ob_start();
    require __DIR__ . '/relatoriosituacao.php';
    $mpdf->WriteHTML(ob_get_clean());

    $hoje = 'relatoriosituacao' . date("d_m_Y_H_i_s");
    $mpdf->Output($hoje.'.pdf', 'D');
?>