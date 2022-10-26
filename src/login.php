<?php
require("../database/usuario.php");

$apelido = $_POST["apelido_login"];
$senha = $_POST["senha_login"];

if(fazer_login($apelido, $senha)){
    header("Location: ../src/pagina_inicial.php");
}else{
    header("Location: ../public/index.php");
}
?>