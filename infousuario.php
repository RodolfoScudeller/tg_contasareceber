<?php
    include('verificaLogin.php');
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Renegociação - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/editarusuario.css'>
    
</head>
    <body>
        
        <?php
            include("conexao.php");
            $id = $_GET['id'];
            $userlogado = $_SESSION['usuario'];
            $acao = "Visualizou informações sobre o usuário $id";
            include('registraMovimento.php'); 

            $consulta_escrita = "select * from tb_usuario where US_IDUSUARIO = $id";
            $consulta = mysqli_query($con, $consulta_escrita);
            while($linhas_query = mysqli_fetch_assoc($consulta)){
                $nome = $linhas_query['US_NOME'];
                $login = $linhas_query['US_LOGIN'];
                $senha = $linhas_query['US_SENHA'];

                echo("
                        <div class='dados'>
                        <span class='campos'>Matrícula: </span><input type='text' class='campos' id='id' value='$id' readonly='false'>
                        <span class='campos'>Nome: </span><input type='text' class='campos' id='nome' value='$nome'>    
                        <span class='campos'>Login: </span><input type='text' class='campos' id='login' value='$login'>    
                        <span class='campos'>Senha: </span><input type='text' class='campos' id='senha' value='$senha'> 
                        </div>
                        <div class='botoes'>
                    ");
            }
            echo("
            <button class='salvar' onclick='salvar($id, $userlogado)'>Salvar</button>
            <button class='excluir' onclick='excluir($id, $userlogado)'>Excluir</button>
            <button class='cancelar' onclick='fecha()'>Cancelar</button>
            </div>");
            
        ?>
        <script>
                function fecha(){    
                    window.close();
                }                
                function excluir(y,z){
                    if(y == z){
                        alert('Impossível excluir usuário logado!');
                        window.close();
                    }else{
                        var r=confirm("Tem certeza que deseja excluir esse usuário?");
                        if (r==true)
                        {
                            window.open('excluirusuario.php?id='+y,'popup');
                        }                        
                    }                    
                }
                function salvar($id, $userlogado){
                    if($id == $userlogado){
                        alert('Impossível alterar usuário logado!');
                        window.close();
                    }else{
                        var r=confirm("Tem certeza que deseja alterar esse usuário?");
                        if (r==true)
                        {
                            $nome = document.getElementById('nome').value;
                            $login = document.getElementById('login').value;
                            $senha = document.getElementById('senha').value;

                            window.open('alterarusuario.php?id='+$id+'&nome='+$nome+'&login='+$login+'&senha='+$senha, 'popup');
                        }                                                  
                    }
                }
        </script>
</body>
</html>
