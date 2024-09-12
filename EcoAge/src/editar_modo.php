<?php
require("../database/usuario.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
}
$id_usuario = $_POST["id_usuario"];


  if (array_key_exists("modo", $_POST)){
    $modo = 1;
} else {
    $modo = 0;
}

editarModo($id_usuario, $modo);
$pagina_anterior = $_SERVER['HTTP_REFERER'];
header("Location: $pagina_anterior");
?>