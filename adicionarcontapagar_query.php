<?php
    include('verificaLogin.php');

    include("conexao.php");
    $nf = $_GET['nf'];
    $datav = $_GET['data'];
    $valor = $_GET['valor'];
    $conta = $_GET['conta'];
    $agencia = $_GET['agencia'];
    $situacao = $_GET['situacao'];
    $datae = date("Y-m-d");
    $cnpj = $_GET['cnpj'];

    if(($nf == '')||($datav == '')||($valor == '')||($conta == '')||($agencia == '')||($situacao == '')){
        echo("<script>alert('Há campos em branco!');window.close();</script>");
    }else{
        $consulta = "select * from tb_contaareceber where co_idconta = '$nf'";
        $consult = mysqli_query($con, $consulta);
        if(mysqli_num_rows($consult)!=0){
            echo ("<script>
                        alert('Falha ao Cadastrar Conta!Conta Ja Existe!');
                        window.close();    
                    </script>");
            
        }else if(mysqli_num_rows($consult)==0){
            $inserc = "insert into tb_contaareceber values ('$nf', '$cnpj','$datae', '$datav', $valor, '$agencia', 431, '$conta', '$situacao')";
                if(mysqli_query($con, $inserc) === TRUE){
                    $acao = "Adicionou a conta: $nf";
                    include('registraMovimento.php'); 
                    echo("<script>
                            alert('Conta Adicionada com Sucesso!');   
                            window.close();              
                        </script>");
                }else{
                    echo ("<script>
                                alert('Falha ao Cadastrar Conta!');
                                window.close();         
                            </script>");
                    }
        }
    }
        
?>
