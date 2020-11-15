<?php
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    include("conexao.php");
    $exclu = true;
    $exclui_contar = "delete from tb_contaareceber where co_idcliente = '$cnpj'";
    if($con->query($exclui_contar) === true){
        $exclui_contab = "delete from tb_contabancaria where cb_idcliente = '$cnpj'";
        if($con->query($exclui_contab) === true){
            $exclui_cliente = "delete from tb_cliente where cl_cnpj = '$cnpj'";
            if($con->query($exclui_cliente) === true){
                $acao = "Excluiu o cliente $cnpj";
                include('registraMovimento.php');
                echo("<script>alert('Cliente excluído com sucesso!');window.close();opener.location.href=opener.location.href;</script>");
            }else{
                echo("<script>alert('Falha ao excluir cliente!')window.close();</script>");
            }
        }else{
            echo("<script>alert('Falha ao excluir cliente!')window.close();</script>");
        }
    }else{
        echo("<script>alert('Falha ao excluir cliente!')window.close();</script>");
    }
?>