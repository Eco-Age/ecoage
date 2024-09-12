<?php 
require("../database/noticias.php");

$id_noticia = $_POST["id_noticia"];
$titulo_noticia = $_POST["titulo_noticia"];
$data_noticia = $_POST["data_noticia"];
$url_noticia = $_POST["url_noticia"];
$descricao_noticia = $_POST["descricao_noticia"];

editarNoticia($id_noticia, $titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia);
header("Location: site_externo_adm.php");
?>