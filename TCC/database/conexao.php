<?php

function obterConexao() {
  $servidor = "localhost";
  $usuario = "web";
  $senha = "web";
  $banco = "ecoage";
  
  $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
  
  if (!$conexao) {
    echo "Não foi possível conectar ao banco de dados! Erro: " . mysqli_connect_error();
    die();  
  }
  
  return $conexao;
}

?>