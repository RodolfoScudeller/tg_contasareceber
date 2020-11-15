<?php
    include('verificaLogin.php');
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $login = $_GET['login'];
    $senha = $_GET['senha'];
    include('conexao.php');

    if(($id == '')||($nome == '')||($login == '')||($senha == '')){
        echo("<script>alert('Há campos em branco, todos os campos devem estar preenchidos!');window.close();</script>");
    }else{
        $busca = "select * from tb_usuario where us_idusuario = $id or us_login = '$login'";
        $busca_query = mysqli_query($con, $busca);
        $linhas_busca = mysqli_num_rows($busca_query);

        if($linhas_busca == 0){
            $insercao = "insert into tb_usuario values($id, '$nome', '$login', '$senha')";
            if(mysqli_query($con, $insercao) === TRUE){
                $acao = "Cadastrou o usuário $id";
                include('registraMovimento.php'); 
                echo("<script>alert('Usuário cadastrado com sucesso!');window.close();</script>");
            }else{
                echo("<script>alert('Falha ao cadastras usuário!');window.close();</script>");
            }
        }else if($linhas_busca != 0){
            echo("<script>alert('Id e/ou Login ja existem, devem ser únicos!');window.close();</script>");
        } 
    }

    
?>