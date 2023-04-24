<?php
require("../database/tecidos.php");
$id_tipo_tecidos = $_POST["id_tipo_tecidos"];
$desc_tecidos = $_POST["desc_tecidos"];

if (!empty($_FILES["imagem_tecido"]) && $_FILES["imagem_tecido"]["error"] == UPLOAD_ERR_OK) {
  $nome_imagem = $_FILES["imagem_tecido"]["name"];
  $extensao = pathinfo($nome_imagem, PATHINFO_EXTENSION); // obter a extensão do arquivo
  $nome_sem_extensao = pathinfo($nome_imagem, PATHINFO_FILENAME); // obter o nome do arquivo sem a extensão
  $nome_unico = $nome_sem_extensao . "_" . date("H\hi\ms\s_d-m-Y") . "." . $extensao; // adicionar o timestamp ao nome do arquivo
  $caminho_imagem = "../assets/imagens_tecido/" . $nome_unico;
  move_uploaded_file($_FILES["imagem_tecido"]["tmp_name"], $caminho_imagem);
} else {
  $caminho_imagem = "";
}

if (array_key_exists("sustentavel", $_POST)) {
  $sustentavel = 1;
} else {
  $sustentavel = 0;
}

inserirTecido($id_tipo_tecidos, $desc_tecidos, $sustentavel, $caminho_imagem);

header("Location: tecidos_adm.php");
?>
