<?php
    session_start();
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu do Sistema de Contas a Receber - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/estilo_menu.css'>
    <link rel="stylesheet" href='css/cadastracliente.css'>
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
                                        <li><div class='cad-conta'><a href="" class='link-adconta'>Contas<a></div></li>
                                        <li><div class="cad-cliente"><a href="" class='link-adcliente'>Clientes<a></div></li>
                                        <li><div class="cad-usuario"><a href="" class='link-adusuario'>Usuários<a></div></li>
                                    </ul>
                                </div>
                            </div>        
                            </li>
                            <li><div class='base'>Bases
                            <div class='opc-base'>
                                    <ul>
                                        <li><div class='base-conta'><a href="basecontas.php" class='link-baseconta'>Contas</a></div></li>
                                        <li><div class='base-cliente'><a href="" class='link-basecliente'>Clientes<a></div></li>
                                        <li><div class='base-usuario'><a href="" class='link-baseusuario'>Usuários<a></div></li>
                                    </ul>
                                </div>
                            </div>
                            </li>
                            <li><div class='arquivo'>Arquivos
                                <div class='opc-arquivo'>
                                <ul>
                                    <li><div class="arquivo-remessa"><a href='' class='link-remessa'>Remessa</a></div></li>
                                    <li><div class="arquivo-retorno"><a href='' class='link-retorno'>Retorno</a></div></li>
                                </ul>
                                </div>
                            </div>
                            </li>
                            <li><div class='relatorio'>Relatórios
                            <div class='opc-relatorio'>
                                    <ul>
                                        <li><div class="pdf"><a href='' class='link-pdf'>PDF</a>
                                            <ul>
                                                <li><div class="p-geral"><a href=''>Geral</a></div></li>
                                                <li><div class="p-situacao"><a href=''>Situação</a></div></li>
                                                <li><div class="p-cliente"><a href=''>Cliente</a></div></li>
                                            </ul>
                                            </div>
                                        </li>
                                        <li><div class="excel"><a href='' class='link-excel'>EXCEL</a>
                                        <ul>
                                            <li><div class="e-geral"><a href=''>Geral</a></div></li>
                                            <li><div class="e-situacao"><a href=''>Situação</a></div></li>
                                            <li><div class="e-cliente"><a href=''>Cliente</a></div></li>
                                        </ul>
                                        </div>
                                </li>
                                    </ul>
                                </div>
                            </div>
                            </li>
                            <li><a href=""><div class='notificar'>Notificações</div></a></li>
                            <li><a href=""><div class='historico'>Histórico</div></a></li>
                      </ul>  
                </div>
            </nav>
        <div class='container'>
            <div class='container-cadastro'>
                <span class='texto'>Cliente: </span>
                <select name="cnpj" id="cnpj">
                    <?php
                        include('conexao.php');
                        $consulta_escrita = 'select cl_cnpj, CL_NOME from tb_cliente';
                        $consulta = mysqli_query($con,$consulta_escrita);
                        while($linhas = mysqli_fetch_assoc($consulta)){
                            $cnpj = $linhas['cl_cnpj'] . ' - ' . $linhas['CL_NOME'];
                            echo("<option value='$cnpj'>$cnpj</option>");
                        }                       
                    ?>
                    
                </select>
                <span class='texto'>Nota Fiscal: </span>
                <input type='number' class='nf' id='nf' required="required">
                <span class='texto'>Parcela: </span>
                <input type='text' class='parcela' id='parcela' required="required">
                <span class='texto'>Data Emissão: </span>
                <input type='date' class='emissao' id='parcela' required="required">
                <span class='texto'>Data Vencimento: </span>
                <input type='date' class='vencimento' id='parcela' required="required">
            </div>
            
        </div>
        <script>
                
        </script>
    </body>
</html>