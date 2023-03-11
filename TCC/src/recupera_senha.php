<?php 
require("../database/usuario.php");


if ($_POST["funcao"] == "alterarsenha") {
    $id_usuario = $_SESSION["id_usuario"];
    $nova_senha = $_POST["senha1"];
    alteraSenha($id_usuario, $nova_senha);
    header("Location: ../src/pagina_inicial.php");
}else if ($_POST["funcao"] == "recuperasenha"){
    $email = $_SESSION["email_recuperar"];
    $nova_senha = $_POST["senha1"];
    recuperaSenha($email, $nova_senha);
    header("Location: ../public/index.php");
}

?>
