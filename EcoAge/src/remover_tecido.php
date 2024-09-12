<?php
    require ("../database/tecidos.php");

    $id_tecidos = $_GET["id_tecidos"];
    removerTecido($id_tecidos);
    header("Location: tecidos_adm.php");
?>  
