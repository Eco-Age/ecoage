<?php
    session_start();

    unset($_SESSION["usuario_logado"]);
    header("Location: ../public/index.php" );
?>