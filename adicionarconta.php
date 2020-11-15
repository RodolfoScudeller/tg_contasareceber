<?php
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    
    echo("
        Conta: <input type='text' id='conta' class='conta'><br>
        Agência: <input type='text' id='agencia' class='agencia'><br>
        Tipo: <input type='text' id='tipo' class='tipo'><br>
        <input type='submit' value='Adicionar' onclick=adiciona($cnpj) class='salvar'>
        <button onclick=volta() class='cancelar'>Cancelar</button>            
    ");   
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Conta Bancaria e Agencia - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/adicionarconta.css'>    
</head>
    <body>
<script>
function volta(){
        window.history.back();
    }
    function adiciona($cnpj){        
        var r=confirm("Tem certeza que deseja adicionar conta bancária?");
            if (r==true)
            {
                $conta = document.getElementById("conta").value;
                $agencia = document.getElementById("agencia").value;
                $tipo = document.getElementById("tipo").value;

                window.location.replace("adicionarconta_query.php?cnpj="+$cnpj+"&conta="+$conta+"&agencia="+$agencia+"&tipo="+$tipo);
            }
    }
</script>
    </body>
</html>