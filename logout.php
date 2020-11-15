<?php    
    include("conexao.php");
    session_start();
    $acao = 'Logout';
    include('registramovimento.php');
    unset($_SESSION['usuario']);    
    header('location: index.php');
    exit();
?>