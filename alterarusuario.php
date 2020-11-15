<?php
    include('verificaLogin.php');
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $login = $_GET['login'];
    $senha = $_GET['senha'];
    include('conexao.php');

    $consulta_escrita = "update TB_USUARIO set US_NOME = '$nome', US_LOGIN = '$login', US_SENHA = '$senha' WHERE US_IDUSUARIO = '$id'";
    if($con->query($consulta_escrita) === TRUE){
        $acao = "Alterou o usuário: $id";
        include('registraMovimento.php'); 
        echo("<script>alert('Usuário alterado com sucesso!');window.opener.location.reload();window.close();</script>");
    }else{
        echo("<script>alert('Falha ao alterar usuário!');window.close();</script>");
    }
?>