<?php
    require ("../database/noticias.php");

    $id_noticia  = $_GET["id_noticia"];
    removerNoticia($id_noticia);
    header("Location: site_externo_adm.php");
?>  