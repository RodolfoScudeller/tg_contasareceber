<?php
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    $nf = $_GET['nf'];
    $datae = $_GET['datae'];
    $datav = $_GET['datav'];
    $valor = $_GET['valor'];
    $agencia = $_GET['agencia'];
    $conta = $_GET['conta'];
    $situacao = $_GET['situacao'];
    include('conexao.php');

    $contacliente = array();
    $agenciacliente = array();
    $cont = 0;
    $verificaconta = 0;

    if(($nf == '')||($datae == '')||($datav == '')||($valor == '')||($agencia == '')||($conta == '')){
        echo("<script>alert('Campo em branco!');window.close();</script>");
    }else{
        $consulta_conta_query = "select cb_contabancaria from tb_contabancaria where cb_idcliente = '$cnpj'";
        $consulta_conta = mysqli_query($con, $consulta_conta_query);
       
        while($linhas_conta = mysqli_fetch_assoc($consulta_conta)){
            $contacliente[$cont] = $linhas_conta['cb_contabancaria'];
            $contapconsulta = $linhas_conta['cb_contabancaria'];
            
            $consulta_agencia_query = "select cb_agencia from tb_contabancaria where cb_contabancaria = '$contapconsulta'";
            $consulta_agencia = mysqli_query($con, $consulta_agencia_query);
            while($linhas_agencia = mysqli_fetch_assoc($consulta_agencia)){
                $agenciacliente[$cont] = $linhas_agencia['cb_agencia'];
                $cont++;
            }
        }
        
        $contapesquisa = array_search($conta, $contacliente);
        $agenciapesquisa = array_search($agencia, $agenciacliente);
        if(($contapesquisa == $agenciapesquisa)&&($agenciapesquisa > -1)&&($contapesquisa > -1)){
            
            $consulta_nf_escrita = "select * from tb_contaareceber where co_idconta = '$nf'";
            $consulta_nf = mysqli_query($con,$consulta_nf_escrita);
            $qtdelinhasnf = mysqli_num_rows($consulta_nf);
            
            if($qtdelinhasnf == 0){
                $insercao = "insert into tb_contaareceber values ('$nf', '$cnpj','$datae','$datav', '$valor','$agencia', 431, '$conta', '$situacao')";
                echo("<script>alert('$insercao');</script>");
                if($con->query($insercao) == TRUE){
                    $acao = "Cadastrou a conta $nf";
                    include('registraMovimento.php'); 
                    echo("<script>alert('Conta cadastrada com sucesso!')</script>");
                }else{
                    echo("<script>alert('Falha ao cadastrar conta!')</script>");
                }
            }else if($qtdelinhasnf > 0){
                echo("<script>alert('Falha ao cadastrar conta. Conta já existe!')</script>");
            }
        }   
    }   
?>