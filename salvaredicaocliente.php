<?php 
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    $responsavel = $_GET['responsavel'];
    $telefone = $_GET['telefone'];
    $endereco = $_GET['endereco'];
    $cidade = $_GET['cidade'];
    $bairro = $_GET['bairro'];
    $email = $_GET['email'];
    include("conexao.php");

    $update = "update tb_cliente set CL_RESPONSAVEL = '$responsavel', CL_ENDERECO = '$endereco', CL_TELEFONE = '$telefone', CL_BAIRRO = '$bairro', CL_EMAIL = '$email', CL_CIDADE = '$cidade' where cl_cnpj='$cnpj'";

    if($con->query($update) === TRUE){
        $acao = "Atualizou o cliente $cnpj";
        include('registraMovimento.php'); 
        echo ("<script>alert('Cliente atualizado com sucesso!');window.close();</script>");
    }else{
        echo ("<script>alert('Não foi possivel atualizar cliente!');</script>");
    }
?>