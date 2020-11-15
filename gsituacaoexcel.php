<?php
    include('verificaLogin.php');
    $acao = "Gerou relatório por situação em Excel";
    include('registraMovimento.php'); 
    $hoje = 'relatoriosituacao' . date("d_m_Y_H_i_s") . '.xls';
    $arquivo = $hoje;
    ob_start();
    require __DIR__ . '/situacaoexcel.php';
    $html = ob_get_clean();
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment, filename = $arquivo");
    echo $html;
    
?>