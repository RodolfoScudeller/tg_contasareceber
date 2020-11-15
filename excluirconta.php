<?php
    include('verificaLogin.php');
    include("conexao.php");
    $nf = $_GET['nf'];

    $consulta_escrita = "delete from tb_contaareceber where co_idconta = '$nf'";

    if ($con->query($consulta_escrita) === TRUE) {
        $acao = "Excluiu a conta $nf";
        include('registraMovimento.php'); 
        echo("<script>
                alert('Conta Excluída com Sucesso!');
                window.close();
            </script>");
      } else {
        echo ("<script>
            alert('Falha ao Excluir Conta');
            window.close();
        </script>");
      }
?>