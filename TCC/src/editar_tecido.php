<?php 
require("../database/tecidos.php");

$id_tecidos = $_POST["id_tecidos"];
$id_tipo_tecidos = $_POST["id_tipo_tecidos"];
$desc_tecidos = $_POST["desc_tecidos"];

if (isset($_FILES["imagem_tecido"]) && $_FILES["imagem_tecido"]["error"] == UPLOAD_ERR_OK) {
  $imagem_tecido = file_get_contents($_FILES["imagem_tecido"]["tmp_name"]);
  $imagem_tecido_base64 = base64_encode($imagem_tecido);
} else {
  echo "sem imagem";
  $imagem_tecido_base64 = null;
}

if (array_key_exists("sustentavel", $_POST)) {
    $sustentavel = 1;
  } else {
    $sustentavel = 0;
  }

editarTecido($id_tecidos, $id_tipo_tecidos, $desc_tecidos, $sustentavel, $imagem_tecido_base64);
header("Location: tecidos_adm.php");
?>