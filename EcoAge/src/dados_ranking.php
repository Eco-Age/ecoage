<?php
require ("../database/ranking.php");
  $carreteis = intval($_POST["carreteisColetados"]);
  $tempo = $_POST["tempo"];
  $id_usuario = $_POST["id_usuario"];
  $id_patente = $_POST["id_patente"];

  inserirRanking($id_usuario, $carreteis, $tempo, $id_patente);
?>