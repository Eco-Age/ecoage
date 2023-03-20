<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once("conexao.php");

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
function inserirTecido($id_tipo_tecidos, $desc_tecidos, $sustentavel, $imagem_tecido_binario) {

  if (!empty($_FILES["imagem_tecido"]) && $_FILES["imagem_tecido"]["error"] == UPLOAD_ERR_OK) {
    $nome_arquivo = $_FILES["imagem_tecido"]["name"];
    $caminho_absoluto = $_SERVER['DOCUMENT_ROOT'] . "/assets/" . $nome_arquivo;
    move_uploaded_file($_FILES["imagem_tecido"]["tmp_name"], $caminho_absoluto);
    $caminho_imagem = "../assets/" . $nome_arquivo;
  } else {
    $caminho_imagem = "";
  }

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

function listarTecidos(){
  
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
}

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

function editarTecido($id_tecidos, $id_tipo_tecidos, $desc_tecidos, $sustentavel, $imagem_tecido_base64) {
   
  $conexao = obterConexao();

  if (!empty($_FILES["imagem_tecido"]) && $_FILES["imagem_tecido"]["error"] == UPLOAD_ERR_OK) {
    $nome_arquivo = $_FILES["imagem_tecido"]["name"];
    $caminho_absoluto = $_SERVER['DOCUMENT_ROOT'] . "/assets/" . $nome_arquivo;
    move_uploaded_file($_FILES["imagem_tecido"]["tmp_name"], $caminho_absoluto);
    $caminho_imagem = "../assets/" . $nome_arquivo;
  } else {
    $caminho_imagem = "";
  }
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
    $_SESSION["msg"] = "Os dados do tecido não foram alterados! Erro: " . mysqli_error($conexao);
    $_SESSION["tipo_msg"] = "alert-danger";
  }  

  $stmt->close();
  $conexao->close();
}


?>
