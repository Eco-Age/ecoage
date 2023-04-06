<?php
require("../database/usuario.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
}
$senhaDigitada = $_POST["confirmar_senha"];
$id_usuario = $_POST["id_usuario"];
$nome_completo = $_POST["nome_completo"];
$data_nasc = $_POST["data_nasc"];
$tel = $_POST["tel"];
$apelido = $_POST["apelido"];
$email = $_POST["email_cadastro"];
$id_avatar = $_POST["id_avatar"];

$email_atual = $_POST["email_atual"];
$apelido_atual = $_POST["apelido_atual"];


if ($apelido == $apelido_atual && $email == $email_atual) {
    editarUsuario($senhaDigitada, $nome_completo, $data_nasc, $tel, $apelido, $email, $id_usuario, $id_avatar);
    header("Location: edicao_usuario.php");
} else if ($apelido != $apelido_atual && $email == $email_atual) {
    if (verificarApelidoCadastrado($apelido) == true) {
        header("Location: ../src/edicao_usuario.php");
        $_SESSION["msg"] = "Apelido já cadastrado no sistema!";
        $_SESSION["tipo_msg"] = "alert-danger";
    } else {
        editarUsuario($senhaDigitada, $nome_completo, $data_nasc, $tel, $apelido, $email, $id_usuario, $id_avatar);
        header("Location: edicao_usuario.php");
    }
} else if ($apelido == $apelido_atual && $email != $email_atual) {
    if (verificarEmailCadastrado($email) == true) {
        header("Location: ../src/edicao_usuario.php");
        $_SESSION["msg"] = "Email já cadastrado no sistema!";
        $_SESSION["tipo_msg"] = "alert-danger";
    } else {
        editarUsuario($senhaDigitada, $nome_completo, $data_nasc, $tel, $apelido, $email, $id_usuario, $id_avatar);
        $verifica = buscaVerifica($email);
        if ($verifica == 0) {
            $verifica = 1;
        } else {
            $verifica = 0;
        }
        atualizaVerifica($email, $verifica);
        header("Location: edicao_usuario.php");
    }
    
} else {
    if (verificarUsuarioCadastrado($apelido, $email) == true) {
        header("Location: ../src/edicao_usuario.php");
        $_SESSION["msg"] = "Email ou apelido já cadastrado no sistema!";
        $_SESSION["tipo_msg"] = "alert-danger";
    } else {
        $verifica = 0;
        atualizaVerifica($email, $verifica);
        editarUsuario($senhaDigitada, $nome_completo, $data_nasc, $tel, $apelido, $email, $id_usuario, $id_avatar);
        header("Location: edicao_usuario.php");
    }
}




?>