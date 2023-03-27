<?php

if (!isset($_SESSION)) {
    session_start();
  }
  require_once("conexao.php");

  function buscarNoticia($id_noticia){
    
    $sql = "SELECT * FROM Noticias WHERE id_noticia = ?";
  
    $conexao = obterConexao(); 
  
    $stmt = $conexao->prepare($sql);
  
    $stmt->bind_param("i", $id_noticia);
    $stmt->execute();
  
    $resultado = $stmt->get_result();
    $noticia = mysqli_fetch_assoc($resultado);
  
    $stmt->close();
    $conexao->close();
  
    return $noticia;  
  }


  function inserirNoticia($titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia){
    $conexao = obterConexao();
  
    $sql = "INSERT INTO Noticias (titulo_noticia, data_noticia, url_noticia, descricao_noticia) 
            VALUES (?, ?, ?, ?)"; 

    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia);   
    $stmt->execute();


    if ($stmt->affected_rows > 0) {
        $_SESSION["msg"] = "Cadastro efetuado com sucesso!";
        $_SESSION["tipo_msg"] = "alert-success"; 
  
      } else{
        $_SESSION["msg"] = "O cadastro não foi efetuado! Erro: " . mysqli_error($conexao);
        $_SESSION["tipo_msg"] = "alert-danger";
  
      }


    $stmt->close();
    $conexao->close(); 
}  


function listarNoticia(){
  
    $lista_noticias = [];
  
    $sql = "SELECT id_noticia,titulo_noticia, data_noticia, url_noticia, descricao_noticia FROM Noticias";
      
    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();

  while ($noticias = mysqli_fetch_assoc($resultado)) {
    array_push($lista_noticias, $noticias);
  }

  $stmt->close();
  $conexao->close();

  return $lista_noticias;
  }

  function removerNoticia($id_noticia){

    $sql = "DELETE FROM Noticias WHERE id_noticia = ?";

  $conexao = obterConexao();
    
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id_noticia);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
      $_SESSION["msg"] = "Noticia removido com sucesso!";
      $_SESSION["tipo_msg"] = "alert-danger";
    } else {
      $_SESSION["msg"] = "A noticia não pôde ser removido! Erro: " . mysqli_error($conexao);
      $_SESSION["tipo_msg"] = "alert-danger";
    }
    $stmt->close();
    $conexao->close();
  }


  function editarNoticia($id_noticia, $titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia) {
   
    $conexao = obterConexao();
  
    $sql = "UPDATE Noticias
            SET titulo_noticia = ? , data_noticia = ?, url_noticia = ?, descricao_noticia = ?
            WHERE id_noticia = ?";
    
  
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssi", $titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia, $id_noticia);
    $stmt->execute();
  
    if ($stmt->affected_rows > 0) {
      $_SESSION["msg"] = "Os dados da noticia foram alterados!";
      $_SESSION["tipo_msg"] = "alert-success";
    } else {
      $_SESSION["msg"] = "Os dados da noticia não foram alterados! Erro: " . mysqli_error($conexao);
      $_SESSION["tipo_msg"] = "alert-danger";
    }  
  
    $stmt->close();
    $conexao->close();
  }
  
  function buscarPalavraChave($palavra_chave){

      $resultado = [];
    // Conectar-se ao banco de dados (substitua com suas credenciais)
        $conexao = obterConexao(); 
    
    // Executar consulta SQL usando as palavras-chave fornecidas
        $sql = "SELECT * FROM Noticias 
                WHERE titulo_noticia LIKE '%$palavra_chave%' OR descricao_noticia LIKE '%$palavra_chave%'";
    
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
    // Exibir os resultados da pesquisa para o usuário
    if($resultado->num_rows == 0) {
      $_SESSION["msg"] = "Nenhum resultado encontrado para \"$palavra_chave\".";
      $_SESSION["tipo_msg"] = "alert-danger";
      header("Location: ../src/portal_de_noticias.php");
    }else{
      header("Location: ../src/site_externo.php");
    }
    
    // Fechar conexão com o banco de dados
    $stmt->close();
    $conexao->close(); 

    return $resultado;
  }
  ?>