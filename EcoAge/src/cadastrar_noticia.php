<?php
require("../database/noticias.php");

$titulo_noticia = $_POST["titulo_noticia"];
$data_noticia = $_POST["data_noticia"];
$url_noticia = $_POST["url_noticia"];
$descricao_noticia = $_POST["descricao_noticia"];

inserirNoticia($titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia);
header("Location: ../src/site_externo_adm.php");
?>