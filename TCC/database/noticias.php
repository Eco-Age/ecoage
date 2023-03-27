<?php

if (!isset($_SESSION)) {
    session_start();
  }
  require_once("conexao.php");

  function inserirNoticia($titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia){
    $conexao = obterConexao();
  
    $sql = "INSERT INTO Noticias (titulo_noticia, data_noticia, url_noticia, descricao_noticia) 
            VALUES (?, ?, ?, ?)"; 

    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssi", $titulo_noticia, $data_noticia, $url_noticia, $descricao_noticia);   
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

  ?>