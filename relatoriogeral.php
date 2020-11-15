<?php
    include('verificaLogin.php');
    session_start();
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
                Geral
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
        <div class="espaco-tabela">
            <table class="tabela">
            <thead id = "tabela_cabecalho">
                    <tr>
                        <th class='campos'>Nota Fiscal</th>
                        <th class='campos'>CNPJ</th>
                        <th class='campos'>Data Emissão</th>
                        <th class='campos'>Data Vencimento</th>
                        <th class='campos'>Valor</th>
                        <th class='campos'>Agência</th>
                        <th class='campos'>Banco</th>
                        <th class='campos'>Conta</th>
                        <th class='campos'>Situação</th>   
                    </tr>                 
                </thead>
                <?php
                    include("conexao.php");
                    $consulta_escrita = "select * from tb_contaareceber";
                    $consulta = mysqli_query($con, $consulta_escrita);
                    $linhas = mysqli_num_rows($consulta);
                    $cont = 0;
                    $id = 0;
                    $total = 0;

                    while($row_tbcontaareceber = mysqli_fetch_array($consulta)){
                        $idconta = $row_tbcontaareceber['CO_IDCONTA'];
                        $cnpj = $row_tbcontaareceber['CO_IDCLIENTE'];
                        $datae = (string)$row_tbcontaareceber['CO_DATAEMISSAO'];
                        $datae = (string)substr($datae,8,2) .'/'. (string)substr($datae,5,2) .'/'. (string)substr($datae,0,4);
                        $datav = $row_tbcontaareceber['CO_DATAVENCIMENTO'];
                        $datav = (string)substr($datav,8,2) .'/'. (string)substr($datav,5,2) .'/'. (string)substr($datav,0,4);
                        $valor = $row_tbcontaareceber['CO_VALOR'];
                        $valor = number_format($valor,2,',','');
                        $agencia = $row_tbcontaareceber['CO_AGENCIA'];
                        $banco = $row_tbcontaareceber['CO_BANCO'];
                        $conta = $row_tbcontaareceber['CO_CONTABANCARIA'];
                        $situacao = $row_tbcontaareceber['CO_SITUACAO'];
                        

                        echo ("<tr>");
                        echo ("<td class='campos'>$idconta</td>");
                        echo ("<td class='campos'>$cnpj</td>");
                        echo ("<td class='campos'>$datae</td>");
                        echo ("<td class='campos'>$datav</td>");
                        echo ("<td class='campos'>R$ $valor</td>");
                        echo ("<td class='campos'>$agencia</td>");
                        echo ("<td class='campos'>$banco</td>");
                        echo ("<td class='campos'>$conta</td>");
                        echo ("<td class='campos'>$situacao</td>"); 
                        echo ("</tr>");
                                                        
                    }
                ?>
            </table>
        </div>
    </body>
</html>