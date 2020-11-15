<?php
    include('verificaLogin.php');
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Informações de Cliente - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/editarcliente.css'>
    
</head>
    <body>
        <?php
            $cnpj = $_GET['cnpj'];
            include("conexao.php");
            

            $consulta_escrita = "select * from tb_cliente where cl_cnpj='$cnpj'";
            $consulta = mysqli_query($con, $consulta_escrita);

            while($row_consulta = mysqli_fetch_assoc($consulta)){
                $nome = $row_consulta['CL_NOME'];
                $responsavel = $row_consulta['CL_RESPONSAVEL'];
                $endereco = $row_consulta['CL_ENDERECO'];
                $telefone = $row_consulta['CL_TELEFONE'];
                $bairro = $row_consulta['CL_BAIRRO'];
                $cidade = $row_consulta['CL_CIDADE'];
                $email = $row_consulta['CL_EMAIL'];
                $pontuacao = $row_consulta['CL_PONTUACAO'];
                $acao = "Visualizou informaçoes do cliente $cnpj";
                include('registraMovimento.php'); 

                $contas = array();
                $qtde = 0;
                $consultacontas = "select cb_contabancaria from tb_contabancaria where cb_idcliente = '$cnpj'";
                $consulta = mysqli_query($con, $consultacontas);
                $linhascb = mysqli_num_rows($consulta);
                $contaagencia = '';
                if($linhascb != 0){
                    while($row_consulta3 = mysqli_fetch_assoc($consulta)){
                        $contas[$qtde] = $row_consulta3['cb_contabancaria'];
                        $qtde++;
                    }
                    $qtde--;
                    $combo=-1;
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
                    $contaagencia = '';
                    
                        $i = 0;
                        while($i <= $combo){
                            if($i==0){
                                $contaagencia = $contaagencia . $contas[$i];
                            }else{
                                $contaagencia = $contaagencia .', '. $contas[$i];
                            }                    
                            $i++;
                        }
                }
                
                echo("
                <div class='container-info'>
                    <div class='nome-empresa'>$nome</div>
                    <hr class='linha'>
                    <span class='texto'>CNPJ: </span>
                    <input type='text' readonly='false' value='$cnpj'>
                    <span class='texto'>Responsável: </span>
                    <input type='text' value='$responsavel' class='texto-nome' id='responsavel'>
                    <span class='texto'>Telefone: </span>
                    <input type='text' value='$telefone' id='telefone'>
                    <span class='texto'>Pontuação: </span>
                    <input type='text' value='$pontuacao' readonly='false'>
                    <span class='texto'>Endereço: </span>
                    <input type='text' class='texto-nome' value='$endereco' id='endereco'>
                    <span class='texto'>Bairro: </span>
                    <input type='text' value='$bairro' id='bairro'>
                    <span class='texto'>Cidade: </span>
                    <input type='text' value='$cidade' id='cidade'>
                    <span class='texto'>E-mail: </span>
                    <input type='text' value='$email' class='texto-email' id='email'>
                    <span class='texto'>Contas/Agências: </span>
                    <input type='text' class='texto-contas' value='$contaagencia' readonly='false'>
                    <br>
                    <button onclick='adicionar($cnpj)' class='add-conta'>Adicionar Conta e Agência</button>                    
                    <button onclick='salvar($cnpj)' class='salvar'>Salvar</button>
                    <button onclick='excluir($cnpj)' class='excluir'>Excluir</button>
                    <button onclick='fecha()' class='cancelar'>Cancelar</button>
                </div>
                ");
            }
        ?>
        <script>
                function adicionar($cnpj){
                    window.open('adicionarconta.php?cnpj='+$cnpj,'popup', 'width=100,height=100,scrolling=auto,top=0,left=0');
                }
                function fecha(){    
                    window.close();
                }
                function salvar($cnpj){
                    var r=confirm("Tem certeza que deseja alterar esse cliente?");
                    if (r==true)
                    {
                        $responsavel =  document.getElementById("responsavel").value;
                        $telefone =  document.getElementById("telefone").value;
                        $endereco =  document.getElementById("endereco").value;
                        $bairro =  document.getElementById("bairro").value;
                        $cidade =  document.getElementById("cidade").value;
                        $email =  document.getElementById("email").value;
                        
                        window.open('salvaredicaocliente.php?cnpj='+$cnpj+'&telefone='+$telefone+'&endereco='+$endereco+'&responsavel='+$responsavel+'&bairro='+$bairro+'&cidade='+$cidade+'&email='+$email,'popup');
                    }
                }
                function excluir(y){
                    var r=confirm("Tem certeza que deseja excluir esse cliente?");
                    if (r==true)
                    {
                        window.open('excluircliente.php?cnpj='+y,'popup');
                    }
                    
                }
                </script>
    </body>
</html>