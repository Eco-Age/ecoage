<?php
require_once("conexao.php");

function listarTipoTecidos() {
  $lista_tipo_tecidos = [];

  $sql = "SELECT * FROM Tipo_Tecidos";
  
  $conexao = obterConexao();

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
  while ($tipo_tecido = mysqli_fetch_assoc($resultado)) {
    array_push($lista_tipo_tecidos, $tipo_tecido);
  }    

  $stmt->close();
  $conexao->close();
 
  return $lista_tipo_tecidos;
}

?>