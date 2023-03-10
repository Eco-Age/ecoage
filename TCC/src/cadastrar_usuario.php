<?php
require("../database/usuario.php");

$nome_completo = $_POST["nome_completo"];
$data_nasc = $_POST["data_nasc"];
$tel = $_POST["tel"];
$apelido = $_POST["apelido"];
$email = $_POST["email_cadastro"];
$senha = $_POST["senha_cadastro"];
$id_avatar = $_POST["id_avatar"];

if (verificarUsuarioCadastrado($apelido, $email) == true){
        $_SESSION["msg"] = "Email ou apelido já cadastrado no sistema!";
        $_SESSION["tipo_msg"] = "alert-danger";
}else {
    inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha,$id_avatar);
}

header("Location: ../public/index.php");
?>
