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
    $conta = $_GET['conta'];
    $agencia = $_GET['agencia'];
    $situacao = $_GET['situacao'];
    $datae = date("Y-m-d");

    $consulta_escrita = "update tb_contaareceber set co_dataemissao = '$datae', co_datavencimento = '$datav', co_valor = '$valor', co_agencia = '$agencia', co_contabancaria = '$conta', co_situacao = '$situacao' where co_idconta = '$nf'";
    
    if ($con->query($consulta_escrita) === TRUE) {
        $acao = "Renegociou a conta: $nf";
        include('registraMovimento.php'); 
        echo("<script>
                alert('Conta Renegociada com Sucesso!');
                window.close();
            </script>");
      } else {
        echo ("<script>
            alert('Falha ao Renegociar Conta');
            window.close();
        </script>");
      }
    
?>
</body>
</html>