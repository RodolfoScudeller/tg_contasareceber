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
                    echo("<script>alert('Arquivo Retorno inserido com sucesso!')</script>");
                    
                }else{
                    echo("<script>alert('Falha ao inserir Arquivo Retorno')</script>");
                }
            }
        }
    } else {
        echo 'Selecione um arquivo para fazer upload';
    }
    
?>