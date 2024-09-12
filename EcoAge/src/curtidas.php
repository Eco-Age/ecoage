<?php
require("../database/noticias.php");

if(isset($_POST['id_noticia']) && isset($_POST['id_usuario'])){
    $id_noticia = $_POST['id_noticia'];
    $id_usuario = $_POST['id_usuario'];
    Curtida($id_noticia, $id_usuario);
  }
?>