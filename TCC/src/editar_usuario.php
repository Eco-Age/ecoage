<?php 
require("../database/usuario.php");

if(isset($_SESSION["id_usuario"])){
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



editarUsuario($senhaDigitada, $nome_completo, $data_nasc, $tel, $apelido, $email, $id_usuario, $id_avatar);
header("Location: edicao_usuario.php");

?>
