<?php
    include('verificaLogin.php'); 
    $acao = "Inseriu Retorno";
    include('registraMovimento.php');
    $location = 'retorno/';
    

    if (isset($_FILES['file'])) {
        $name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];

        $error = $_FILES['file']['error'];
        if ($error !== UPLOAD_ERR_OK) {
            echo 'Erro ao fazer o upload:', $error;
        } elseif (move_uploaded_file($tmp_name, $location . $name)) {
            $arquivo = "$location$name";
            $arquivoAberto = fopen($arquivo, 'r');
            $tamanho = filesize($arquivo);
            include 'conexao.php';
            $nf = 0;
            $qtde = 0;

            while(!feof($arquivoAberto)){
                $linha = fgets($arquivoAberto, $tamanho);
                if($qtde == 1){
                    $nf = substr($linha, 36, 9); 
                }                
                $qtde++;   
                echo("<script>console.log($nf);</script>");                            
            }
            if($qtde != 0){
                $update = "update tb_contaareceber set CO_SITUACAO = 'Paga' where CO_IDCONTA = '$nf'";
                if($con->query($update) === TRUE){
                    $select_escrito = "select co_datavencimento, co_idcliente from tb_contaareceber where co_idconta = '$nf'";
                    $select = mysqli_query($con, $select_escrito);
                    while($resultados = mysqli_fetch_assoc($select)){
                        $data_vencimento = $resultados['co_datavencimento'];
                        $cliente = $resultados['co_idcliente'];
                    }
                    $pontuacao_cliente_escrita = "select cl_pontuacao from tb_cliente where cl_cnpj = '$cliente'";
                    $pontuacao_cliente_query = mysqli_query($con, $pontuacao_cliente_escrita);
                    while($linhas_pontuacao = mysqli_fetch_assoc($pontuacao_cliente_query)){
                        $pontuacao = $linhas_pontuacao['cl_pontuacao'];
                    }
                    if(($pontuacao >= 0) && ($pontuacao <= 1000)){
                        $data_hoje = date('Y-m-d');

                        // Calcula a diferença em segundos entre as datas
                        $diferenca = strtotime($data_vencimento) - strtotime($data_hoje);

                        //Calcula a diferença em dias e contabiliza os pontos
                        $dias = floor($diferenca / (60 * 60 * 24))*10;
                        if((($pontuacao + $dias) >= 0 ) ||(($pontuacao + $dias) <= 1000 )){
                            $update_pont = "update tb_cliente set cl_pontuacao = cl_pontuacao + $dias where cl_cnpj = '$cliente'";
                            if($con->query($update_pont)){
                               
                            }
                        }
                        $att_escrita = "update tb_contaareceber set co_situacao = 'Atrasada' where co_datavencimento < '$data_hoje' and co_situacao = 'Em Aberto'";
                        echo($att_escrita);
                        $con->query($att_escrita);
                        
                    }
                    

                    echo("<script>alert('Arquivo Retorno inserido com sucesso!');window.location.replace('arquivoretorno.php');</script>");                    
                }else{
                    echo("<script>alert('Falha ao inserir Arquivo Retorno')</script>");
                }
            }
        }
    } else {
        echo 'Selecione um arquivo para fazer upload';
    }
    
?>