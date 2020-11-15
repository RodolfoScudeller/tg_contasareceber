<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $banco = 'tg_contasareceber';
    

    $con = mysqli_connect($host,$user,$pass,$banco)or die();
    mysqli_set_charset($con,"utf8");
    $sdb = mysqli_select_db($con, $banco);
?>