<?php
    require("../database/noticias.php");

    $palavra_chave = $_POST["palavra_chave"];

    buscarPalavraChave($palavra_chave);    
?>