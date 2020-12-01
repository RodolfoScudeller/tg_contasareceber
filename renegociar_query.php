<html>
    <head>

    </head>
    <body>
<?php
    include('verificaLogin.php');
    include("conexao.php");
    $nf = $_GET['nf'];
    $datav = $_GET['data'];
    $valor = $_GET['valor'];
    $valor = number_format($valor,2, '.','');
    $conta = $_GET['conta'];
    $agencia = $_GET['agencia'];
    $situacao = $_GET['situacao'];
    $datae = date("Y-m-d");

    $consulta_escrita = "update tb_contaareceber set co_dataemissao = '$datae', co_datavencimento = '$datav', co_valor = '$valor', co_agencia = '$agencia', co_contabancaria = '$conta', co_situacao = '$situacao' where co_idconta = '$nf'";
    
    if ($con->query($consulta_escrita) === TRUE) {
        $acao = "Renegociou a conta: $nf";
        include('registraMovimento.php');
        if($situacao == 'Em Aberto'){
            $select_escrito = "select co_datavencimento, co_idcliente from tb_contaareceber where co_idconta = '$nf'";
            $select = mysqli_query($con, $select_escrito);
            while($resultados = mysqli_fetch_assoc($select)){
                $data_vencimento = $resultados['co_datavencimento'];
                $cliente = $resultados['co_idcliente'];
            }
            $pontuacao_cliente_escrita = "select cl_pontuacao from tb_cliente where cl_cnpj = '$cliente'";
            $pontuacao_cliente_query = mysqli_query($con, $pontuacao_cliente_escrita);
            while($linhas_pontuacao = mysqli_fetch_assoc($pontuacao_cliente_query)){
                $pontuacao = $linhas_pontuacao['cl_pontuacao'];
            }
            if(($pontuacao >= 0) && ($pontuacao <= 1000)){
                if((($pontuacao - 500) >= 0 ) && (($pontuacao - 500) <= 1000 )){
                    $update_pont = "update tb_cliente set cl_pontuacao = cl_pontuacao - 500 where cl_cnpj = '$cliente'";
                    if($con->query($update_pont)){
                    
                    }
                }
            }
        
        }
            echo("<script>
                    alert('Conta Renegociada com Sucesso!');
                    window.close();
                </script>");
        
    }else{
        echo ("<script>
            alert('Falha ao Renegociar Conta');
            window.close();
        </script>");
    }

    
    
?>
</body>
</html>