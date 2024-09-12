<?php 
require("../database/tecidos.php");

$id_tecidos = $_POST["id_tecidos"];
$id_tipo_tecidos = $_POST["id_tipo_tecidos"];
$composicao = $_POST["composicao"];
$producao = $_POST["producao"];
$meioambiente = $_POST["meioambiente"];

if (!empty($_FILES["imagem_tecido"]) && $_FILES["imagem_tecido"]["error"] == UPLOAD_ERR_OK) {
  $nome_imagem = $_FILES["imagem_tecido"]["name"];
  $extensao = pathinfo($nome_imagem, PATHINFO_EXTENSION);
  $nome_sem_extensao = pathinfo($nome_imagem, PATHINFO_FILENAME); 
  $nome_unico = $nome_sem_extensao . "_" . date("H\hi\ms\s_d-m-Y") . "." . $extensao; 
  $caminho_imagem = "../assets/imagens_tecido/" . $nome_unico;
  move_uploaded_file($_FILES["imagem_tecido"]["tmp_name"], $caminho_imagem);
} else {
  $caminho_imagem = $_POST["nome_imagem_original"];
}

if (array_key_exists("sustentavel", $_POST)) {
    $sustentavel = 1;
  } else {
    $sustentavel = 0;
  }

editarTecido($id_tecidos, $id_tipo_tecidos, $composicao, $producao, $meioambiente, $sustentavel, $caminho_imagem);
header("Location: tecidos_adm.php");
?>

