<?php
require("../database/usuario.php");

$nome_completo = $_POST["nome_completo"];
$data_nasc = $_POST["data_nasc"];
$tel = $_POST["tel"];
$apelido = $_POST["apelido"];
$email = $_POST["email_cadastro"];
$senha = $_POST["senha_cadastro"];

inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha);
header("Location: ../public/index.php");
?>

