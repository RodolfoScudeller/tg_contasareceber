<?php
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    $nome = $_GET['nome'];
    $responsavel = $_GET['responsavel'];
    $endereco = $_GET['endereco'];
    $bairro = $_GET['bairro'];
    $cidade = $_GET['cidade'];
    $email = $_GET['email'];
    $pontuacao = $_GET['pontuacao'];
    $telefone = $_GET['telefone'];    
    $cep = $_GET['cep'];

    if(($cnpj == '')||($nome == '')||($responsavel == '')||($endereco == '')||($bairro == '')||($cidade == '')||($email == '')||($pontuacao == '')||($telefone == '')){
        echo("<script>alert('Por favor, preencha todos os campos!');window.close();</script>");
    }else{
        include("conexao.php");

        $pesquisa_cnpj_query = "select * from tb_cliente where cl_cnpj = '$cnpj'";    
        $consulta_cnpj = mysqli_query($con,$pesquisa_cnpj_query);
        $linhas_cnpj = mysqli_num_rows($consulta_cnpj);

        if($linhas_cnpj == 1){
            echo("<script>alert('CNPJ ja cadastrado!');window.close();</script>");
        }else if($linhas_cnpj == 0){
            $insercao = "insert into tb_cliente values ('$cnpj', '$nome', '$responsavel', '$endereco',$cep, $telefone, '$bairro', '$cidade', '$email', $pontuacao)";
            if(mysqli_query($con, $insercao) === TRUE){
                $acao = "Cadastrou o cliente $cnpj";
                include('registraMovimento.php'); 
                echo("<script>alert('Cliente cadastrado com sucessso!');window.close();</script>");
            }else{
                echo("<script>alert('Falha ao cadastrar cliente!');window.close();</script>");
            }
        }
    }       
?>