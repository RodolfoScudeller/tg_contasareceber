<?php
    date_default_timezone_set('America/Sao_Paulo');
    $idusuario_sessao = $_SESSION['usuario'];
    $nome_sessao = $_SESSION['nome'];
    $datadehoje = date("Y-m-d H:i:s");

    $query_escrita = "INSERT INTO TB_MOVIMENTACAO (MO_IDUSUARIO, MO_USUARIO, MO_MOVIMENTACAO, MO_DATA) VALUES ($idusuario_sessao, '$nome_sessao', '$acao', '$datadehoje')";

    $con->query($query_escrita);
?>