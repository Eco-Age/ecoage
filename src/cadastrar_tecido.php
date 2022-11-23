<?php
require("../database/tecidos.php");

$id_tipo_tecidos = $_POST["id_tipo_tecidos"];
$desc_tecidos = $_POST["desc_tecidos"];

//Se o checkbox não for selecionado, ele não será enviado!
if (array_key_exists("sustentavel", $_POST)){
    $sustentavel = 1;
  } else {
    $sustentavel = 0;
  }

inserirTecido($id_tipo_tecidos, $desc_tecidos, $sustentavel);

header("Location: tecidos_adm.php");
?>