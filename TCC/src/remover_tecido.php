<?php
    require ("../database/tecidos.php");

    $id_tecidos = $_POST["id_tecidos"];
   
    removerTecido($id_tecidos);
    header("Location: tecidos_adm.php");
?>  


