<?php
    function logMe($msg){
    $fp = fopen("../log.txt", "a");
    // Escreve a mensagem passada através da variável $msg
    $write = fwrite($fp, $msg);
    fclose($fp);
    }
?>