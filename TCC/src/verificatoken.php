<?php
    require ("../database/usuario.php");
    if (isset($_SESSION["email_recuperar"])){
        $email = $_SESSION["email_recuperar"];
        $token_digitado = $_POST["token"];    
        verificatoken($email, $token_digitado);
    }
?>