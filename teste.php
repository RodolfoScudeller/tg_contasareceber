<?php
    $data_hoje = '2020-11-17';
    $data_pagamento = '2020-11-15';

    // Calcula a diferença em segundos entre as datas
    $diferenca = strtotime($data_pagamento) - strtotime($data_hoje);

    //Calcula a diferença em dias
    $dias = floor($diferenca / (60 * 60 * 24));

    echo "A diferença é de $dias dias entre as datas";''
?>
