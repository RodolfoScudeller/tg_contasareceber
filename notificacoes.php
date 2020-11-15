<?php
    include('verificaLogin.php');
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Base de Clientes - Nacon</title>  
    <link rel="shortcut icon" href="img/icon.ico">
    <link rel="stylesheet" href='css/estilo_menu.css'>
    <link rel="stylesheet" href='css/estilo_notificacao.css'>
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
            <h1>Notificações</h1>
            <div class='container-tabela'>
                <table id='tabela'>
                    <thead>
                        <tr>
                            <th>CNPJ</th>
                            <th>NOTA FISCAL</th>
                            <th>VALOR</th>
                            <th>DATA VENCIMENTO</th>
                            <th>SITUAÇÃO</th>
                            <th>NOTIFICAR</th>
                        </tr>
                    </thead>
                    </tbody>
                        <?php
                            include("conexao.php");
                            $consulta_escrita = "select * from tb_contaareceber where co_situacao = 'Atrasada'";
                            $consulta = mysqli_query($con, $consulta_escrita);

                            while($row_consulta = mysqli_fetch_assoc($consulta)){
                                $nf = $row_consulta['CO_IDCONTA'];
                                $valor = $row_consulta['CO_VALOR'];
                                $datav = $row_consulta['CO_DATAVENCIMENTO'];
                                $situacao = $row_consulta['CO_SITUACAO'];
                                $contabancaria = $row_consulta['CO_CONTABANCARIA'];
                                $cnpj = $row_consulta['CO_IDCLIENTE'];                             
                                            
                                echo("
                                    <tr id='linha'>
                                        <td>$cnpj</td>
                                        <td>$nf</td>
                                        <td>$valor</td>
                                        <td>$datav</td>
                                        <td>$situacao</td>
                                        <td><button class='btn_info' onclick='maisInfo(this)'>NOTIFICAR</button></td>
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
            function maisInfo(botao) {
                
                var tableData = $(botao).closest("tr").find("td:not(:last-child)").map(function(){
                    return $(this).text().trim();
                }).get();
                var cnpj = tableData[0];
                var conta = tableData[1];
                var valor = tableData[2];

                var datav = tableData[3];
                
                
                 window.open('notificacliente.php?cnpj='+cnpj+'&nf='+conta+'&valor='+valor+'&datav='+datav,'popup','width=1105,height=185,scrolling=auto,top=0,left=0');
                }
            
        </script>
    </body>
</html>