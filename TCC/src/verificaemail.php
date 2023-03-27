<?php

require ("../database/usuario.php");
require ("../util/mensagens.php");

$codigo_usuario = $_POST["codigo"];
$codigo_digitado = intval(implode('', $codigo_usuario));

if (isset($_SESSION["cadastro_info"]) && $_SESSION["cadastro_info"]["tempo_expiracao"] > time()) {
    $nome_completo = $_SESSION["cadastro_info"]["nome_completo"];
    $data_nasc = $_SESSION["cadastro_info"]["data_nasc"];
    $tel = $_SESSION["cadastro_info"]["tel"];
    $apelido = $_SESSION["cadastro_info"]["apelido"];
    $email = $_SESSION["cadastro_info"]["email"];
    $senha = $_SESSION["cadastro_info"]["senha"];
    $id_avatar = $_SESSION["cadastro_info"]["id_avatar"];

        if (confirmaEmail($email, $codigo_digitado) == true){
            $verifica = 1;
            atualizaVerifica($email, $verifica);
            $_SESSION["id_avatar"] = $id_avatar;
            inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $verifica, $id_avatar);    
        }

   // unset($_SESSION["cadastro_info"]);
} else if (isset($_SESSION["email"])){
   
    $email = $_SESSION["email"];
 
    if (confirmaEmail($email, $codigo_digitado) == true){
         $verifica = 1;
        atualizaVerifica($email, $verifica);
        $_SESSION["msg"] = "Seu email foi confirmado com sucesso! Obrigado";
        $_SESSION["tipo_msg"] = "alert-success";
        header("Location: ../src/edicao_usuario.php");
    }
}



?>