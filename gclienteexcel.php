<?php
    include('verificaLogin.php');
    $acao = "Gerou relatório por clientes em Excel";
    include('registraMovimento.php'); 
    $hoje = 'relatoriocliente' . date("d_m_Y_H_i_s") . '.xls';
    $arquivo = $hoje;
    ob_start();
    require __DIR__ . '/clienteexcel.php';
    $html = ob_get_clean();
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment, filename = $arquivo");
    echo $html;
    
?>