<?php 
require("../database/usuario.php");

$email = $_SESSION["email_recuperar"];
$nova_senha = $_POST["senha1"];

recuperaSenha($email, $nova_senha);
header("Location: ../public/index.php");
?>