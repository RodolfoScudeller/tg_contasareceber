<?php
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    $agencia = $_GET['agencia'];
    $conta = $_GET['conta'];
    $tipo = $_GET['tipo'];
    include("conexao.php");

    $consulta_conta_escrita = "select * from tb_contabancaria where cb_contabancaria = '$conta'";
    $consulta_conta = mysqli_query($con, $consulta_conta_escrita);
    $linhas = mysqli_num_rows($consulta_conta);

    if(($cnpj == '')||($agencia == '')||($conta == '')||($tipo == '')){
        echo("<script>alert('Há campos em branco!');window.history.back();</script>");
    }else{
        if($linhas != 0){
            echo("<script>alert('Conta já existe!');window.history.back();</script>");
        }else{
            $insere_conta = "insert into tb_contabancaria values ('$conta', '$cnpj', 431, '$agencia', $tipo)";
            if ($con->query($insere_conta) === TRUE) {                         
                echo("<script>alert('Conta cadastrada com sucesso!');
                    window.history.back();
                    opener.location.href=opener.location.href;
                    </script>");               
            }else{
                echo ("<script>
                        alert('Falha ao Cadastrar Conta!');  
                        window.history.back();          
                    </script>");
            }
        }
    }
                                                                               
?>