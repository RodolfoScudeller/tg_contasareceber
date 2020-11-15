<?php
    session_start();
?>
<!DOCTYPE html><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Contas a Receber - Nacon</title>  
    <link rel="shortcut icon" href="img/empresa.ico">
    <link rel="stylesheet" href='css/estilo_login.css'>
</head>
    <body>
        <div class='bg-image'></div>

        <div class='campos-login'>
            <div class='container-campos'>   
                <form action='validaLogin.php' method="POST">         
                    <input class='login' type='text' placeholder="Login" name="usuario">
                    <input class='senha' type='password' placeholder="Senha" name="senha">
                    <input class='submit' type="submit" value='Logar'>
                </form>
            </div>
            <?php
                if(isset($_SESSION['nao_autenticado'])):
                                
            ?>
                <div>
                    <p class='erro'>USUÁRIO OU SENHA INVÁLIDOS!!</p>
                </div>
            <?php                
                endif;
                unset($_SESSION['nao_autenticado']);
            ?>
        </div>
    </body>
</html>