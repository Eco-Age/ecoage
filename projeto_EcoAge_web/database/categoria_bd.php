<?php
require_once("conecta_bd.php");

function listarCategorias() {
  $lista_categorias = [];
  $sql = "SELECT * FROM Categoria";
  
  $conexao = obterConexao();
  $resultado = mysqli_query($conexao, $sql);

  while ($categoria = mysqli_fetch_assoc($resultado)) {
    array_push($lista_categorias, $categoria);
  }

  mysqli_close($conexao);

  return $lista_categorias;
}

function listarCategoria() {
  $lista_categoria = [];
  $sql = "SELECT c.id_categoria, c.nome_categoria
            FROM Categoria c ";
  
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->get_result();
  while ($categoria = mysqli_fetch_assoc($resultado)) {
    array_push($lista_categoria, $categoria);
  }
  $stmt->close();
  $conexao->close();

  return $lista_categoria;
}

function inserirCategoria($nome_categoria) {
  $conexao = obterConexao();
  $sql = "INSERT INTO Categoria (nome_categoria) 
          VALUES (?)";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("s", $nome_categoria);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $_SESSION["mensagem"] = "A categoria {$nome_categoria} foi adicionado!";
    $_SESSION["tipo_msg"] = "alert-success";
  } else {
    $_SESSION["mensagem"] = "A categoria {$nome_categoria} não foi adicionado!";
    $_SESSION["tipo_msg"] = "alert-danger";
  }
  $stmt->close();
  $conexao->close();
}

function removerCategoria($id_categoria) {
  $sql = "DELETE FROM Categoria WHERE id_categoria = ?";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id_categoria);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "A categoria foi removido!";
    $_SESSION["tipo_msg"] = "alert-danger";
  } else {
    $_SESSION["msg"] = "A categoria  não foi removido!";
    $_SESSION["tipo_msg"] = "alert-danger";
  }    
  $stmt->close();
  $conexao->close();
}


?>