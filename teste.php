<?php
    $path = "remessa/";
    $diretorio = dir($path);
    $qtde = -1;
    $download = 'DOWNLOAD';
    //echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
    /*while($arquivo = $diretorio -> read()){
    echo "<a href='".$path.$arquivo."' download='$arquivo'>".$arquivo."</a><br />";
    }
    $diretorio -> close();
    */
    $iterator = new FileSystemIterator($path);

    /*foreach ($iterator as $file) {
        echo $file->getFilename(), PHP_EOL;
}*/
?>

<html>
    <head></head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($iterator as $file) {
                    $arquivo = $file->getFilename();

                    $qtde++;
                echo ("
                        <tr>
                        <td>$qtde</td>
                        <td>$arquivo</td>
                        <td><a href='".$path.$arquivo."' download='$arquivo'>".$download."</a></td>
                        </tr>
                    ");                           
                }?>
            </tbody>
        </table>
        <?php $diretorio -> close();?>
    </body>
</html>