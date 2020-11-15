<?php
    include('verificaLogin.php');
    date_default_timezone_set("Brazil/East");
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    $dia = date('D - d/m/Y');
    $hora = date('H:i:s');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/estilo_relatorio.css">
    </head>
    <body>
        <header class="cabecalho">
            <div class="espaco-logo">
                <img src="img/logo-relatorio.png" class="img-logo"> 
            </div>            
            <div class="titulo">
                Relatório de Contas a Receber<br>
                Por Cliente
            </div>
            <div class="data">
                <?php echo($_SESSION['nome']); ?><br>
                <?php 
                    echo($dia);
                    echo('<br>');
                    echo($hora);

                ?>
            </div>
        </header>
        <div class='relat-cliente'>
<?php
    include('conexao.php');
    //aqui eu pego o cnpj e nome dos clientes
    $consulta_escrita1 = "select cl_cnpj, cl_nome from tb_cliente";
    $consulta1 = mysqli_query($con, $consulta_escrita1);

    while($row_tbcontaareceber1 = mysqli_fetch_array($consulta1)){
        $cnpj = $row_tbcontaareceber1['cl_cnpj'];
        $nome = $row_tbcontaareceber1['cl_nome'];
        
            echo ("<p>CLIENTE: ");
            echo($cnpj .' - '. $nome .'</p>');
            echo("<table class='conta-cliente'>
                        <thead>
                            <tr>
                                <th class='campos'>Nota Fiscal</th>
                                <th class='campos'>Data Emissão</th>
                                <th class='campos'>Data Vencimento</th>
                                <th class='campos'>Valor</th>
                                <th class='campos'>Agencia</th>
                                <th class='campos'>Banco</th>
                                <th class='campos'>Conta Bancaria</th>
                                <th class='campos'>Situação</th>
                            </tr>                               
                        </thead>                                        
                ");

            $pesqui_conta_escrita = "select cb_contabancaria from tb_contabancaria where cb_idcliente = '$cnpj'";
            $pesqui_conta = mysqli_query($con,$pesqui_conta_escrita);
            while($linha_conta = mysqli_fetch_assoc($pesqui_conta)){
                $contabancaria = $linha_conta['cb_contabancaria'];

                $pesqui_contapg_escrita = "select * from tb_contaareceber where CO_CONTABANCARIA = '$contabancaria'";
                $pesquisa_contapg = mysqli_query($con, $pesqui_contapg_escrita);
                while($linhas_contapg = mysqli_fetch_assoc($pesquisa_contapg)){
                    $nf = $linhas_contapg['CO_IDCONTA'];
                    $datae = $linhas_contapg['CO_DATAEMISSAO'];
                    $datav = $linhas_contapg['CO_DATAVENCIMENTO'];
                    $valor = $linhas_contapg['CO_VALOR'];
                    $banco = $linhas_contapg['CO_BANCO'];
                    $conta = $linhas_contapg['CO_CONTABANCARIA'];
                    $agencia = $linhas_contapg['CO_AGENCIA'];
                    $situacao = $linhas_contapg['CO_SITUACAO'];

                echo("
                        <tbody>
                            <tr>
                                <td class='campos'>$nf</td>
                                <td class='campos'>$datae</td>
                                <td class='campos'>$datav</td>
                                <td class='campos'>R$ $valor</td>
                                <td class='campos'>$agencia</td>
                                <td class='campos'>$banco</td>
                                <td class='campos'>$conta</td>
                                <td class='campos'>$situacao</td>                               
                            </tr>                   
                    ");
                
                }
                
            }
        echo('</tbody>');
                echo("</table>");
    }   
?>  
    </div>
    </body>
</html>