<?php
    include('verificaLogin.php');
    $acao = "Visualizou base de remessas";
    include('registraMovimento.php'); 

    $path = "remessa/";
    $diretorio = dir($path);
    $qtde = -1;
    $download = 'DOWNLOAD';
    $iterator = new FileSystemIterator($path);
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Base de Contas a Receber - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/estilo_menu.css'>
    <link rel="stylesheet" href='css/estilo_bases.css'>
    <link rel="stylesheet" href='script/ordenacao/DataTables/css/jquery.dataTables.css'>
    <script src='script/ordenacao/DataTables/jquery.js'></script>
    <script src='script/ordenacao/DataTables/js/jquery.dataTables.js'></script>
</head>
    <body>
        <header class='cabecalho'>
            <div class='itens-cabecalho'>
            <img src="img/empresa.png" class='logo'>
                <div class='empresa'> NACON ENGENHARIA</div>
                <a href="index.php"><img src="img/sair.png" alt="LogOut" class='logout'></a>
                <div class='user'>
                    Bem Vindo(a), 
                    <?php
                        echo($_SESSION['nome']);
                    ?>
                </div>
            </div>            
        </header>             
        <nav class='navegacao'>
                <img src="img/menu.png" alt="" class='img-menu'>
                <div class='itens-menu'>          
                      <ul>
                            <li><div class='home'><a href='menu.php'>Home</a></div></li>
                            <li><div class='cadastro'>Cadastros
                                <div class='opc-cadastro'>
                                    <ul>
                                        <li><div class='cad-conta'><a href="cadastraconta.php" class='link-adconta'>Contas<a></div></li>
                                        <li><div class="cad-cliente"><a href="cadastracliente.php" class='link-adcliente'>Clientes<a></div></li>
                                        <li><div class="cad-usuario"><a href="cadastrausuario.php" class='link-adusuario'>Usuários<a></div></li>
                                    </ul>
                                </div>
                            </div>        
                            </li>
                            <li><div class='base'>Bases
                            <div class='opc-base'>
                                    <ul>
                                        <li><div class='base-conta'><a href="basecontas.php" class='link-baseconta'>Contas</a></div></li>
                                        <li><div class='base-cliente'><a href="baseclientes.php" class='link-basecliente'>Clientes<a></div></li>
                                        <li><div class='base-usuario'><a href="baseusuarios.php" class='link-baseusuario'>Usuários<a></div></li>
                                    </ul>
                                </div>
                            </div>
                            </li>
                            <li><div class='arquivo'>Arquivos
                                <div class='opc-arquivo'>
                                <ul>
                                    <li><div class="arquivo-remessa"><a href='arquivoremessa.php' class='link-remessa'>Remessa</a></div></li>
                                    <li><div class="arquivo-retorno"><a href='arquivoretorno.php' class='link-retorno'>Retorno</a></div></li>
                                </ul>
                                </div>
                            </div>
                            </li>
                            <li><div class='relatorio'>Relatórios
                            <div class='opc-relatorio'>
                                    <ul>
                                        <li><div class="pdf"><a href='' class='link-pdf'>PDF</a>
                                            <ul>
                                                <li><div class="p-geral"><a href='grelatoriogeral.php'>Geral</a></div></li>
                                                <li><div class="p-situacao"><a href='grelatoriosituacao.php'>Situação</a></div></li>
                                                <li><div class="p-cliente"><a href='grelatoriocliente.php'>Cliente</a></div></li>
                                            </ul>
                                            </div>
                                        </li>
                                        <li><div class="excel"><a href='' class='link-excel'>EXCEL</a>
                                        <ul>
                                            <li><div class="e-geral"><a href='ggeralexcel.php'>Geral</a></div></li>
                                            <li><div class="e-situacao"><a href='gsituacaoexcel.php'>Situação</a></div></li>
                                            <li><div class="e-cliente"><a href='gclienteexcel.php'>Cliente</a></div></li>
                                        </ul>
                                        </div>
                                </li>
                                    </ul>
                                </div>
                            </div>
                            </li>
                            <li><a href="notificacoes.php"><div class='notificar'>Notificações</div></a></li>
                            <li><a href="historico.php"><div class='historico'>Histórico</div></a></li>
                      </ul>  
                </div>
            </nav>
        <div class='container'>
            <h1>Contas Aguardando Remessa</h1>
            
            <div class='container-tabela'>
                <table id='tabela'>
                    <thead>
                        <tr>
                            <th>NF</th>
                            <th>CNPJ</th>
                            <th>VENCIMENTO</th>
                            <th>VALOR</th>
                            <th>SITUAÇÃO</th>
                            <th>GERAR REMESSA</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        include 'conexao.php';
                        $proc_esc = "select * from tb_contaareceber where co_situacao = 'Aguardando Remessa'";
                        $proc = mysqli_query($con, $proc_esc);
                        while($linhas_proc = mysqli_fetch_assoc($proc)){
                            $nf = $linhas_proc['CO_IDCONTA'];
                            $vencimento = $linhas_proc['CO_DATAVENCIMENTO'];
                            $situacao = $linhas_proc['CO_SITUACAO'];
                            $valor = $linhas_proc['CO_VALOR'];
                            $cnpj = $linhas_proc['CO_IDCLIENTE'];
                            echo ("
                                    <tr>
                                    <td>$nf</td>
                                    <td>$cnpj</td>
                                    <td>$vencimento</td>
                                    <td>$valor</td>
                                    <td>$situacao</td>
                                    <td><button class = 'addremessa' onclick='renegociar(this)'>GERAR REMESSA</a></button></td>
                                    </tr>
                                ");
                        }
                                                   
                ?> 
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#tabela").dataTable();
            });
            function renegociar(botao) {
                
                var tableData = $(botao).closest("tr").find("td:not(:last-child)").map(function(){
                    return $(this).text().trim();
                }).get();
                var nf = tableData[0];
                var parcela = tableData[1];
                
                 window.open('criar_remessa?nf='+nf,'popup','width=550,height=160,scrolling=auto,top=0,left=0');
            }
            function abrebase(){
                window.location.replace('basepremessa.php');
            }
            
        </script>
    </body>
</html>