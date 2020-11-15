<?php
    include 'conexao.php';

    $pesquisa_clicon_q = "select CC_IDCLIENTE, CC_CONTABANCARIA FROM TB_CONTACLIENTE";
    $pesquisa_clicon = mysqli_query($con, $pesquisa_clicon_q);
    while($linha_clicon = mysqli_fetch_assoc($pesquisa_clicon)){
        $cnpj = $linha_clicon['CC_IDCLIENTE'];
        $conta = $linha_clicon['CC_CONTABANCARIA'];

        $inse = "update tb_contabancaria set cb_idcliente = '$cnpj' where cb_contabancaria = '$conta'";
        if(mysqli_query($con, $inse)===true){
            echo("$cnpj foi a conta $conta<br>");
        }else{
            echo("$cnpj conta $conta deu erro<br>");
        }
    }

    //ESSE NAO É USADO NO SISTEMA//
?>