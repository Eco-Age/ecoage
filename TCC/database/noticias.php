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
      $lista_noticias = [];
      $conexao = obterConexao(); 

      // Verifica se o filtro foi selecionado
      if(isset($_SESSION["filtro"]) && !empty($_SESSION["filtro"])) {
          $filtro = $_SESSION["filtro"];
          switch($filtro) {
              case "ultimas_24h":
                  $intervalo = "1 DAY";
                  break;
              case "ultima_semana":
                  $intervalo = "1 WEEK";
                  break;
              case "ultimo_mes":
                  $intervalo = "1 MONTH";
                  break;
              case "ultimo_ano":
                  $intervalo = "1 YEAR";
                  break;
          }
          if(!empty($intervalo)) {
            /* caso o usuário escolher algum filtro que não seja "em qualquer data",
            ele deve usar ao menos 3 letras na palavra chave ou pediremos mais especificidade */
            if (strlen($palavra_chave) >= 3){
              $sql = "SELECT * FROM Noticias 
              WHERE (titulo_noticia LIKE '%$palavra_chave%' OR descricao_noticia LIKE '%$palavra_chave%')
              AND data_noticia >= DATE_SUB(NOW(), INTERVAL $intervalo)";
            }else{
              $_SESSION["msg"] = "Nenhum resultado encontrado para \"$palavra_chave\". Tente ser mais específico.";
              $_SESSION["tipo_msg"] = "alert-danger";
              header("Location: ../src/portal_de_noticias.php");
            }
          } 
      } else {
        /* caso o usuário não digitar nada e pesquisar no "em qualquer data", todas aparecem.
        No entanto, se ele digitar uma única letra no "em qualquer data", pede especificidade
        e do mesmo jeito o if anterior, precisará de 3 caracteres. */
            if (strlen($palavra_chave) == 0 || (strlen($palavra_chave) >= 3)){
            $sql = "SELECT * FROM Noticias 
                    WHERE titulo_noticia LIKE '%$palavra_chave%' OR descricao_noticia LIKE '%$palavra_chave%'";
            }else{
              $_SESSION["msg"] = "Nenhum resultado encontrado para \"$palavra_chave\". Tente ser mais específico.";
              $_SESSION["tipo_msg"] = "alert-danger";
              header("Location: ../src/portal_de_noticias.php");
            }
        }
      

      $stmt = $conexao->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->get_result();

     
      if($resultado->num_rows == 0) {
          $_SESSION["msg"] = "Nenhum resultado encontrado para \"$palavra_chave\" com o filtro selecionado.";
          $_SESSION["tipo_msg"] = "alert-danger";
          header("Location: ../src/portal_de_noticias.php");
      } else { 
        while ($noticias = mysqli_fetch_assoc($resultado)) {
        array_push($lista_noticias, $noticias);
      }
    }
      return $lista_noticias;
  }

  function Curtida($id_noticia, $id_usuario) {
    $conexao = obterConexao();
  
    $sql = "SELECT * FROM Curtidas WHERE id_noticia = ? AND id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $id_noticia, $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
  
    if ($resultado->num_rows == 0) {
      $sql = "INSERT INTO Curtidas (id_noticia, id_usuario) VALUES (?, ?)";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("ii", $id_noticia, $id_usuario);
      $stmt->execute();

      $sql = "UPDATE Noticias SET curtidas = curtidas + 1 WHERE id_noticia = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("i", $id_noticia);
      $stmt->execute();
    }else {
      $sql = "DELETE FROM Curtidas WHERE id_noticia = ? AND id_usuario = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("ii", $id_noticia, $id_usuario);
      $stmt->execute();

      $sql = "UPDATE Noticias SET curtidas = curtidas - 1 WHERE id_noticia = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("i", $id_noticia);
      $stmt->execute();
    }

    $sql = "SELECT curtidas FROM Noticias WHERE id_noticia = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_noticia);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $curtidas = $resultado->fetch_assoc()['curtidas'];
  
    $stmt->close();
    $conexao->close();
  
    echo $curtidas;
  }

  function VerificaCurtida($id_noticia, $id_usuario){
    $conexao = obterConexao();
    $sql = "SELECT * FROM Curtidas WHERE id_noticia = ? AND id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $id_noticia, $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0){
      $curtiu = 0;
      return $curtiu;
    }else{
      $curtiu = 1;
      return $curtiu;
    }
  }

  function maisCurtidas() {
    $lista_noticias = [];
    $conexao = obterConexao();
    
    // Seleciona as 3 notícias com mais curtidas, ou todas as notícias na ordem mais recente se nenhuma tiver curtidas
    $sql = "SELECT * FROM Noticias ";
    if ($resultado = $conexao->query("SELECT COUNT(*) AS total FROM Noticias WHERE curtidas > 0")) {
      $total_curtidas = $resultado->fetch_assoc()['total'];
      if ($total_curtidas >= 3) {
        $sql .= "WHERE curtidas > 0 ORDER BY curtidas DESC, data_noticia DESC LIMIT 3";
      } else if ($total_curtidas == 2) {
        $sql .= "WHERE curtidas > 0 ORDER BY curtidas DESC, data_noticia DESC LIMIT 2";
      } else if ($total_curtidas == 1) {
        $sql .= "WHERE curtidas > 0 ORDER BY curtidas DESC, data_noticia DESC LIMIT 1";
      } else {
        $sql .= "ORDER BY data_noticia DESC LIMIT 3";
      }
      $resultado->close();
    } else {
      $sql .= "ORDER BY data_noticia DESC LIMIT 3";
    }
  
    // Executa a consulta e adiciona as notícias na lista
    if ($stmt = $conexao->prepare($sql)) {
      $stmt->execute();
      $resultado = $stmt->get_result();
      while ($noticia = $resultado->fetch_assoc()) {
        array_push($lista_noticias, $noticia);
      }
      $resultado->close();
      $stmt->close();
    }
    
    // Se a lista não tem 3 notícias, adiciona a notícia não curtida mais recente
    if (count($lista_noticias) < 3) {
      $sql = "SELECT * FROM Noticias WHERE curtidas = 0 ORDER BY data_noticia DESC LIMIT " . (3 - count($lista_noticias));
      if ($stmt = $conexao->prepare($sql)) {
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($noticia = $resultado->fetch_assoc()) {
          array_push($lista_noticias, $noticia);
        }
        $resultado->close();
        $stmt->close();
      }
    }
  
    $conexao->close();
    return $lista_noticias;
  }
  ?>