<?php
    require ("../database/usuario.php");
    if(isset($_SESSION["id_usuario"])){
        $id_usuario = $_SESSION["id_usuario"];
    }
    $senhaDigitada = $_POST["alterar_senha"];

    confirmaSenha($id_usuario, $senhaDigitada);
?>