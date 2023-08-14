<?php
    require("../database/noticias.php");

    $palavra_chave = $_POST["palavra_chave"];
    $_SESSION["palavra_chave"] = $palavra_chave;
    $filtro = $_POST["filtro"];
    $_SESSION["filtro"] = $filtro;
    buscarPalavraChave($palavra_chave);   
    header ("Location: ../src/site_externo.php");
?>