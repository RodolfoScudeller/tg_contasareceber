<?php
    include('verificaLogin.php');
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
        <div class='titulo'>
                    <h1>Cadastro de Clientes</h1> 
                </div>
            <div class='container-cadastro'>
                
                <div class='opc'>
                    <span class='texto'>CNPJ: </span>
                    <input type='number' class='campos' id='cnpj' required="required">
                    <span class='texto'>Nome:</span>
                    <input type='text' class='campos' id='nome' required="required">
                    <span class='texto'>Representante:</span>
                    <input type='text' class='campos' id='responsavel' required="required">
                    <span class='texto'>Telefone:</span>
                    <input type='number' class='campos' id='telefone' required="required">
                    <span class='texto'>Endereço:</span>
                    <input type='text' class='campos' id='endereco' required="required">
                    <span class='texto'>Bairro:</span>
                    <input type='text' class='campos' id='bairro' required="required">
                    <span class='texto'>CEP:</span>
                    <input type='number' class='campos' id='cep' required="required">
                    <span class='texto'>Cidade:</span>
                    <input type='text' class='campos' id='cidade' required="required">
                    <span class='texto'>Email:</span>
                    <input type='email' class='campos' id='email' required="required">
                    <span class='texto'>Pontuação:</span>
                    <input type='number' class='campos' id='pontuacao' required="required">
                    <div class='botao'>
                        <button class='salvar' onclick='salvar()'>Salvar</button>
                    </div>
                    
                </div>    
            </div>
            
        </div>
        <script>
                function salvar() {
                    
                    $cnpj = document.getElementById('cnpj').value;
                    $nome = document.getElementById('nome').value;
                    $responsavel = document.getElementById('responsavel').value;
                    $endereco = document.getElementById('endereco').value;
                    $bairro = document.getElementById('bairro').value;
                    $cidade = document.getElementById('cidade').value;
                    $email = document.getElementById('email').value;
                    $pontuacao = document.getElementById('pontuacao').value;
                    $telefone = document.getElementById('telefone').value;
                    $cep = document.getElementById('cep').value;
                    
                    window.open('cadastracliente_query.php?cnpj='+$cnpj+'&nome='+$nome+'&responsavel='+$responsavel+'&endereco='+$endereco+'&bairro='+$bairro+'&cidade='+$cidade+'&email='+$email+'&pontuacao='+$pontuacao+'&telefone='+$telefone+'&cep='+$cep, 'popup', 'width=400,height=300,scrolling=auto,top=0,left=0');
                }
        </script>
    </body>
</html>
