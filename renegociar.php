<?php
    include('verificaLogin.php');
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Renegociação - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/renegociar.css'>
    
</head>
<body>
<?php
    $nf = $_GET['nf'];
    include('conexao.php');
    $acao = "Visualizou informaçoes sobre a conta $nf";
    include('registraMovimento.php'); 
    
    $consulta_escrita = "SELECT * FROM TB_CONTAARECEBER WHERE CO_IDCONTA = '$nf'";
    $consulta = mysqli_query($con, $consulta_escrita);
    $linhas = mysqli_num_rows($consulta);

    while($row_consulta = mysqli_fetch_assoc($consulta)){
        $idconta = $row_consulta['CO_IDCONTA'];
        $cnpj = $row_consulta['CO_IDCLIENTE'];
        $datae = $row_consulta['CO_DATAEMISSAO'];
        $datav = $row_consulta['CO_DATAVENCIMENTO'];
        $valor = $row_consulta['CO_VALOR'];
        $valor = number_format($valor,2,',','.');
        $agencia = $row_consulta['CO_AGENCIA'];
        $banco = $row_consulta['CO_BANCO'];
        $contaban = (string)$row_consulta['CO_CONTABANCARIA'];
        settype($contaban, "string");
        $situação = $row_consulta['CO_SITUACAO'];
    }
    $qtde = 0;    
    $contas = array();
    $qtde = 0;
    $consultacontas = "select cb_contabancaria from tb_contabancaria where cb_idcliente = '$cnpj'";
    $consulta = mysqli_query($con, $consultacontas);
    while($row_consulta3 = mysqli_fetch_assoc($consulta)){
        $contas[$qtde] = $row_consulta3['cb_contabancaria'];
        $qtde++;
    }
    $qtde--;
    $combo=0;
    do{
        $ajuda = $contas[$qtde];
        $consultaagencia = "select cb_agencia from tb_contabancaria where cb_contabancaria = '$ajuda'";
        $consulta=mysqli_query($con, $consultaagencia);
        while($row_consulta4 = mysqli_fetch_assoc($consulta)){
            $teste = $row_consulta4['cb_agencia'];
            $contas[$qtde] = $contas[$qtde] .'/'. $teste;
            $combo++;
        }
        $qtde--;
    }while($qtde >= 0);
    $hoje = date('Y-m-d');
    echo ("<div class='container-renegociacao'>
            <span class='texto'> Nota Fiscal </span><input type='text'value='$nf' readonly=false class='nf' id='nf'>            
            <span class='texto'> Data Vencimento </span><input type='date' value='$datav' min='$hoje' class='txt-data' id='data'>
            <span class='texto'> Valor </span><input type='text' value='$valor' id='valor'><br><br>
            <span class='texto'> Conta Bancária/Agência </span><select name='contaag' id='banco'>");
            $combo--;
            do{
                $ajuda = $contas[$combo];
                echo("<option value='$ajuda' id='$ajuda' class='re_campo'>$ajuda</option>");
                $combo--;
            }while($combo > -1);
            echo("</select>
            <span class='texto'> Situação </span><select name='situacao' id='situacao'>
                <option value='Em Aberto' id='$ajuda'>Em Aberto</option>
                <option value='Atrasada' id='$ajuda'>Atrasada</option>
                <option value='Paga' id='$ajuda'>Paga</option>
                <option value='Aguardando Remessa' id='$ajuda'>Aguardando Remessa</option>
            </select>
            <div class='botao'>
                <button class='btn-ren' onclick='renegociar()'>Renegociar</button>                
                <button class='btn-excluir' onclick='excluir()'>Excluir</button>
                <button class='btn-cancelar' onclick='fecha()'>Cancelar</button>
            </div>
            </div>
            
            ");

?>
<script>
    function fecha(){    
                    window.close();
    }
    function renegociar(){
        var r=confirm("Tem certeza que deseja renegociar a conta?");
                    if (r==true)
                    {
                        var nf = document.getElementById("nf").value;
                        var data = document.getElementById("data").value;
                        var valor = document.getElementById("valor").value;
                        valor = valor.replaceAll(".","");
                        valor = valor.replaceAll(",",".");                        
                        var contaag = document.getElementById("banco").value;                        
                        var banco = contaag.split("/");
                        var conta = banco[0];
                        var agencia = banco[1];
                        var situacao = document.getElementById("situacao").value;
                        
                        window.location.replace("renegociar_query.php?nf="+nf+"&data="+data+"&valor="+valor+"&conta="+conta+"&agencia="+agencia+"&situacao="+situacao);
        }
    }
    function excluir(){
        var r=confirm("Tem certeza que deseja excluir a conta?");
            if (r==true)
            {
                var nf = document.getElementById("nf").value;
                window.location.replace("excluirconta.php?nf="+nf);
            }
    }
</script>
</body>
</html>