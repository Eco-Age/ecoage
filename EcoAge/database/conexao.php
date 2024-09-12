<?php

function obterConexao() {
  $servidor = "10.105.35.10";
  $usuario = "grupo2";
  $senha = "secondone";
  $banco = "grupo2";
  
  $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
  
  if (!$conexao) {
    echo "Não foi possível conectar ao banco de dados! Erro: " . mysqli_connect_error();
    die();  
  }
  
  return $conexao;
}

?>
