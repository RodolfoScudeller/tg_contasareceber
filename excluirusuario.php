<?php
    include('verificaLogin.php');
    $id= $_GET['id'];
    include('conexao.php');

    $consulta = "delete from tb_usuario where US_IDUSUARIO = $id";
    if($con->query($consulta) == TRUE){
        $acao = "Excluiu o usuário $id";
        include('registraMovimento.php'); 
        echo("<script>alert('Usuário excluído com sucesso!');window.close();</script>");
    }else{
        echo("<script>alert('Falha ao excluir usuário!');window.close();</script>");
    }
?>