<?php
    include('verificaLogin.php');
    $_checkbox = $_POST['permissao'];
    foreach($_checkbox as $_valor){
        echo$_valor;
    }
?>