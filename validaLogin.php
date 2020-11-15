<?php
    include('verificaLogin.php');
    include("conexao.php");
    $login = (string)$_POST["usuario"];
    $senha = (string)$_POST["senha"];

            $consulta_escrita = "SELECT US_IDUSUARIO, US_NOME, US_LOGIN, US_SENHA FROM TB_USUARIO WHERE US_LOGIN = '$login'";
            $consulta = mysqli_query($con, $consulta_escrita);
            $linhas = mysqli_num_rows($consulta); 
            
                   
            if($linhas === 0){
                $_SESSION['nao_autenticado'] = true;
                header('location: index.php');
            }if($linhas != 0){
                while($row_consulta = mysqli_fetch_assoc($consulta)){
                    $qsenha = (string)$row_consulta['US_SENHA'];
                    $usuario =  $row_consulta['US_IDUSUARIO'];
                    $nome = $row_consulta['US_NOME'];


                    if($qsenha == $senha){
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['nome'] = $nome;
                        $acao = 'Login';
                        include('registramovimento.php');
                        header('location: menu.php');
                    }else{
                        $_SESSION['nao_autenticado'] = true;
                        header('location: index.php'); 
                    }
                    
                    
                }
            }
                    
?>