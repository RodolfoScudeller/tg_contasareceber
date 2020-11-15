<?php
    include('verificaLogin.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Adicionar Conta a Receber - Nacon</title>  
        <link rel="shortcut icon" href="img/empresa.ico">
        <link rel="shortcut icon" href="img/empresa.ico">        
        <link rel="stylesheet" href='css/adicionarconta.css'>
    </head>
    <body>
        <?php
            $cnpj = $_GET['cnpj'];
            $qtde = 0;
            //AQUI PRECISO COLOCAR SELECT NA CONTA BANCARIA DIRETO, COM IDCLIENTE DE LA//
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
            echo ("<div class='container-renegociacao'>
                    <span class='texto'> Nota Fiscal </span><input type='text' class='nf' id='nf'>
                    <span class='texto'> Data Vencimento </span><input type='date' class='txt-data' id='data'>
                    <span class='texto'> Valor </span><input type='text' id='valor'><br><br>
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
                        <br>
                        <button class='salvar' class='salvar' onclick='renegociar($cnpj)'>Adicionar</button>
                        <button class='cancelar' class='cancelar' onclick='fecha()'>Cancelar</button>
                    </div>
                    </div>
                    
                    ");
        ?>
        <script>
        function renegociar(y){
            var r=confirm("Tem certeza que deseja adicionar essa conta?");
            if (r==true)
            {
                var nf = document.getElementById("nf").value;
                var data = document.getElementById("data").value;
                var valor = document.getElementById("valor").value;
                valor = valor.replaceAll(",",".");
                var contaag = document.getElementById("banco").value;                        
                var banco = contaag.split("/");
                var conta = banco[0];
                var agencia = banco[1];
                var situacao = document.getElementById("situacao").value;
                
                window.location.replace("adicionarcontapagar_query.php?nf="+nf+"&data="+data+"&valor="+valor+"&conta="+conta+"&agencia="+agencia+"&situacao="+situacao+"&cnpj="+y);
            }
        }
        function fecha(){    
            window.close();
        }
        </script>
    </body>
</html>