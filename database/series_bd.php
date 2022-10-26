<?php
if (!isset($_SESSION)) {
  session_start();
};
require_once("conecta_bd.php");

function listarSeries() {
  $lista_series = [];
  $sql = "SELECT s.id_serie, c.nome_categoria, s.nome_serie, s.qtd_temporadas, s.ano_lancamento, s.resumo, s.data_cadastro, s.assistida
            FROM Categoria c, Series s
            WHERE c.id_categoria = s.id_categoria"; 
  
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->get_result();
  while ($series = mysqli_fetch_assoc($resultado)) {
    array_push($lista_series, $series);
  }
  $stmt->close();
  $conexao->close();

  return $lista_series;
}

function removerSerie($id_serie) {
  $sql = "DELETE FROM Series WHERE id_serie = ? ";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id_serie);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "A série foi removido!";
    $_SESSION["tipo_msg"] = "alert-danger";
  } else {
    $_SESSION["msg"] = "A série  não foi removido!";
    $_SESSION["tipo_msg"] = "alert-danger";
  }    
  $stmt->close();
  $conexao->close();
}

function inserirSerie($id_categoria, $nome_serie, $qtd_temporadas, $ano_lancamento, $resumo, $data_cadastro, $assistida) {
  $conexao = obterConexao();
  $sql = "INSERT INTO Series (id_categoria, nome_serie, qtd_temporadas, ano_lancamento, resumo, data_cadastro, assistida) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("isiissi", $id_categoria, $nome_serie, $qtd_temporadas, $ano_lancamento, $resumo, $data_cadastro, $assistida);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $_SESSION["mensagem"] = "A série {$nome_serie} foi adicionado!";
    $_SESSION["tipo_msg"] = "alert-success";
  } else {
    $_SESSION["mensagem"] = "A série {$nome_serie} não foi adicionado!";
    $_SESSION["tipo_msg"] = "alert-danger";
  }
  $stmt->close();
  $conexao->close();
}

function AlterarSerie($id_categoria, $id_serie, $nome_serie, $qtd_temporadas, $ano_lancamento, $resumo, $data_cadastro,$assistida){
  $conexao = obterConexao();
  $sql = "UPDATE Series 
          SET nome_serie = ? , qtd_temporadas = ? ,ano_lancamento = ? ,id_categoria = ? ,resumo = ? ,data_cadastro = ? ,assistida = ?
          where id_serie = ? ";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("siisssii", $id_categoria, $nome_serie, $qtd_temporadas, $ano_lancamento, $resumo, $data_cadastro, $assistida,  $id_serie);
  $status = $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "A série {$nome_serie} foi alterado!";
    $_SESSION["tipo_msg"] = "alert-warning";
  } else {
    $_SESSION["msg"] = "A série {$nome_serie} não foi alterado!";
    $_SESSION["tipo_msg"] = "alert-danger";
  }    
  $stmt->close();
  $conexao->close(); 
}

function buscarSerie($id_serie) {
  $sql = "SELECT * FROM Series WHERE id_serie = ?";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id_serie);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $serie = mysqli_fetch_assoc($resultado);
  $stmt->close();
  $conexao->close();
  return $serie;  
}
?>
