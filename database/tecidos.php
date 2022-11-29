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

function inserirTecido($id_tipo_tecidos, $desc_tecidos, $sustentavel) {
  
  $sql = "INSERT INTO Tecidos (id_tipo_tecidos, desc_tecidos, sustentavel) 
          VALUES (?, ?, ?)"; 

  $conexao = obterConexao();

  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("isi", $id_tipo_tecidos, $desc_tecidos, $sustentavel);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "O tecido {$desc_tecidos} foi adicionado!";
    $_SESSION["tipo_msg"] = "alert-success";  
  } else {
    $_SESSION["msg"] = "O tecido {$desc_tecidos} não foi adicionada! Erro: " . mysqli_error($conexao);
    $_SESSION["tipo_msg"] = "alert-danger";
  }

  $stmt->close();
  $conexao->close();
}

function listarTecidos(){
  
  $lista_tecidos = [];

  $sql = "SELECT t.id_tecidos, tt.nome_tecidos, t.desc_tecidos
          FROM Tipo_Tecidos tt, Tecidos t
          WHERE tt.id_tipo_tecidos = t.id_tipo_tecidos"; 
    
  $conexao = obterConexao(); 

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
  while ($tecido = mysqli_fetch_assoc($resultado)){
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

function editarSerie($id_serie, $id_categoria, $nome_serie, $qtd_temporadas, $ano_lancamento, $resumo, $data_cadastro,  $lancamento) {
  
  $sql = "UPDATE Series 
          SET id_categoria = ?, nome_serie = ?, qtd_temporadas = ?, ano_lancamento = ?, resumo = ?, data_cadastro = ?, lancamento = ? 
          WHERE id_serie = ?";
  
  $conexao = obterConexao();

  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("isiissii", $id_categoria, $nome_serie, $qtd_temporadas, $ano_lancamento, $resumo, $data_cadastro,  $lancamento, $id_serie);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "Os dados da série {$nome_serie} foram alterados!";
    $_SESSION["tipo_msg"] = "alert-warning";
  } else {
    $_SESSION["msg"] = "Os dados da série {$nome_serie} não foram alterados! Erro: " . mysqli_error($conexao);
    $_SESSION["tipo_msg"] = "alert-danger";
  }  

  $stmt->close();
  $conexao->close();
}

?>
