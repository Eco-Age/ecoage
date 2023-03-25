<?php
    session_start();
    session_unset();
    header("Location: ../public/index.php" );
?>