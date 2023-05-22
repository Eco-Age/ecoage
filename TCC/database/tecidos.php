<?php
if (!isset($_SESSION)) {
  session_start();
  ob_start();
}
require_once("conexao.php");
date_default_timezone_set('America/Sao_Paulo');

function buscarTecido($id_tecidos){
    
  $sql = "SELECT * FROM Tecidos WHERE id_tecidos = ?";

  $conexao = obterConexao(); 

  $stmt = $conexao->prepare($sql);

  $stmt->bind_param("i", $id_tecidos);
  $stmt->execute();

  $resultado = $stmt->get_result();
  $tecido = mysqli_fetch_assoc($resultado);

  $stmt->close();
  $conexao->close();

  return $tecido;  
}
function inserirTecido($id_tipo_tecidos, $desc_tecidos, $sustentavel, $caminho_imagem) {
  $sql = "INSERT INTO Tecidos (id_tipo_tecidos, desc_tecidos, sustentavel, caminho_imagem) 
          VALUES (?, ?, ?, ?)"; 

  $conexao = obterConexao();

  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("isis", $id_tipo_tecidos, $desc_tecidos, $sustentavel, $caminho_imagem);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "O tecido foi adicionado!";
    $_SESSION["tipo_msg"] = "alert-success";  
  } else {
    $_SESSION["msg"] = "O tecido não foi adicionado! Erro: " . mysqli_error($conexao);
    $_SESSION["tipo_msg"] = "alert-danger";
  }

  $stmt->close();
  $conexao->close();
}

/*unction listarTecidos(){
  
  $lista_tecidos = [];

  $sql = "SELECT t.id_tecidos, tt.nome_tecidos, t.desc_tecidos, t.sustentavel, t.caminho_imagem
          FROM Tipo_Tecidos tt, Tecidos t
          WHERE tt.id_tipo_tecidos = t.id_tipo_tecidos";

  $conexao = obterConexao(); 

  $stmt = $conexao->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->get_result();
    
  while ($tecido = mysqli_fetch_assoc($resultado)){
    if (!empty($tecido["caminho_imagem"])) {
      $tecido["caminho_imagem"] = base64_encode(file_get_contents($tecido["caminho_imagem"]));
    }
    array_push($lista_tecidos, $tecido);
  }    
  $stmt->close();
  $conexao->close();

  return $lista_tecidos;
}*/

function removerTecido($id_tecidos){
  
  $sql = "DELETE FROM Tecidos WHERE id_tecidos = ?";

  $conexao = obterConexao();
    
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id_tecidos);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
      $_SESSION["msg"] = "Tecido removido com sucesso!";
      $_SESSION["tipo_msg"] = "alert-danger";
    } else {
      $_SESSION["msg"] = "O tecido não pôde ser removido! Erro: " . mysqli_error($conexao);
      $_SESSION["tipo_msg"] = "alert-danger";
    }
    $stmt->close();
    $conexao->close();
}

function editarTecido($id_tecidos, $id_tipo_tecidos, $desc_tecidos, $sustentavel, $caminho_imagem) {
  $conexao = obterConexao();
  $sql = "UPDATE Tecidos 
          SET id_tipo_tecidos = ?, desc_tecidos = ?, sustentavel = ?, caminho_imagem = ?
          WHERE id_tecidos = ?";
  

  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("isiss", $id_tipo_tecidos, $desc_tecidos, $sustentavel, $caminho_imagem, $id_tecidos);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "Os dados do tecido foram alterados!";
    $_SESSION["tipo_msg"] = "alert-success";
  } else {
    $_SESSION["msg"] = "Nenhuma alteração foi realizada. Favor, editar algum campo.";
    $_SESSION["tipo_msg"] = "alert-warning";
  }  

  $stmt->close();
  $conexao->close();
}



function listarTecidosPaginacao($pagina_atual, $itens_por_pagina) {
  $lista_tecidos = [];

  $sql = "SELECT t.id_tecidos, tt.nome_tecidos, t.desc_tecidos, t.sustentavel, t.caminho_imagem
          FROM Tipo_Tecidos tt, Tecidos t
          WHERE tt.id_tipo_tecidos = t.id_tipo_tecidos
          LIMIT ?, ?";

  $conexao = obterConexao(); 

  $offset = ($pagina_atual - 1) * $itens_por_pagina;
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("ii", $offset, $itens_por_pagina);
  $stmt->execute();
  $resultado = $stmt->get_result();
    
  while ($tecido = mysqli_fetch_assoc($resultado)){
    if (!empty($tecido["caminho_imagem"])) {
      $tecido["caminho_imagem"] = base64_encode(file_get_contents($tecido["caminho_imagem"]));
    }
    array_push($lista_tecidos, $tecido);
  }    
  $stmt->close();
  $conexao->close();

  return $lista_tecidos;
}

function contarTecidos() {
  $sql = "SELECT COUNT(*) AS qtdelinhas FROM Tecidos";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $linha = mysqli_fetch_assoc($resultado);
  $qtde = $linha["qtdelinhas"];
 
  $stmt->close();
  $conexao->close();
  return $qtde;
}