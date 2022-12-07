<?php 
require("../database/tecidos.php");

$id_tecidos = $_POST["id_tecidos"];
$id_tipo_tecidos = $_POST["id_tipo_tecidos"];
$desc_tecidos = $_POST["desc_tecidos"];

if (array_key_exists("sustentavel", $_POST)) {
    $sustentavel = 1;
  } else {
    $sustentavel = 0;
  }

editarTecido($id_tecidos, $id_tipo_tecidos, $desc_tecidos,  $sustentavel);
header("Location: tecidos_adm.php");
?>