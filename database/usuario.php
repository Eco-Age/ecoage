<?php
if (!isset($_SESSION)) {
    session_start();
  };
  require_once("conexao.php");

--------------- Funções que estão funcionando: ----------------------

  function inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha){

    $conexao = obterConexao();
    $senha_md5 = md5($senha);
  
    $sql = "INSERT INTO Usuario (nome_completo, data_nasc, tel, apelido, email, senha) 
            VALUES (?, ?, ?, ?, ?, ?)"; 

    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssss", $nome_completo, $data_nasc, $tel, $apelido, $email, $senha_md5);   
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

function buscarUsuario($apelido, $senha) {

    $senha_md5 = md5($senha);
    
     $sql = "SELECT * FROM Usuario
             WHERE apelido = ? AND senha = ?"; 
    
     $conexao = obterConexao();
    
     $stmt = $conexao->prepare($sql); 
     $stmt->bind_param("ss", $apelido, $senha_md5);   
     $stmt->execute(); 
     
     $resultado = $stmt->get_result(); 
     $login = mysqli_fetch_assoc($resultado);
    
     $stmt->close();
     $conexao->close();
    
     return $login;
    }

function fazer_login($apelido, $senha){

    $usuario = buscarUsuario($apelido, $senha);
    
         if ($usuario == null){
            $_SESSION["msg"] = "Usuário ou senha incorretos!";
            $_SESSION["tipo_msg"] = "alert-danger";
    
            return false;
           } else {
               $_SESSION["nome_logado"] = $usuario["nome_completo"];
               $_SESSION["apelido_logado"] = $usuario["apelido"];
               $_SESSION["id_usuario"] = $usuario["id_usuario"];
    
               return true;
           }   
    }
 
------------------------------------------------------------------------------------------------
  
function listarUsuario(){
  $lista_usuario = [];
  $sql = "SELECT u.id_usuario,u.nome,u.email
          FROM Usuario u"; 
  
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->get_result();

  while ($usuario = mysqli_fetch_assoc($resultado)) {
    array_push($lista_usuario, $usuario);
  }

  $stmt->close();
  $conexao->close();

  return $lista_usuario;
}

function removerUsuario($id_usuario) {
  $sql = "DELETE FROM Usuario WHERE id_usuario = ? ";
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id_usuario);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "O usuario foi removido!";
    $_SESSION["tipo_msg"] = "alert-danger";
  } else {
    $_SESSION["msg"] = "O usuario  não foi removido!";
    $_SESSION["tipo_msg"] = "alert-danger";
  }    
  $stmt->close();
  $conexao->close();
}

function editarUsuario($id_usuario,$nome,$email,$senha){
    $conexao = obterConexao();
    $sql = "UPDATE Usuario 
            SET nome = ? , email = ? ,senha = ? 
            where id_usuario = ? ";
    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi",$nome,$email,$senha,$id_usuario);
    $status = $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $_SESSION["msg"] = "O usuario {$nome} foi alterado!";
      $_SESSION["tipo_msg"] = "alert-warning";
    } else {
      $_SESSION["msg"] = "O usuario {$nome} não foi alterado!";
      $_SESSION["tipo_msg"] = "alert-danger";
    }    
    $stmt->close();
    $conexao->close(); 
}

function buscarUsuarioLogado($id_usuario){
    $sql = "SELECT * FROM Usuario WHERE id_usuario = ?";

    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = mysqli_fetch_assoc($resultado);
    $stmt->close();
    $conexao->close();
    return $usuario;  
}
?>
