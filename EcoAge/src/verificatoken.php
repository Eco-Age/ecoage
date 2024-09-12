<?php
    require ("../database/usuario.php");
    if (isset($_SESSION["email_recuperar"])){
        $email = $_SESSION["email_recuperar"];
        
        $token_usuario = $_POST["token"];
        $token_digitado = intval(implode('', $token_usuario));

        verificatoken($email, $token_digitado);
    }
?>