<?php
if (!isset($_SESSION)) {
    session_start();
  };
  require_once("conexao.php");


  function verificarUsuarioCadastrado($apelido, $email){
    $sql = "SELECT * FROM Usuario WHERE apelido = ? OR email = ?";
    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $apelido, $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $cadastrado = mysqli_num_rows($resultado);
    if (0 < $cadastrado) {
       return true;
    }else {
      return false;
    }
  
    $stmt->close();
    $conexao->close();
  
  }
  
  function inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $id_avatar){

    $conexao = obterConexao();
    $senha_md5 = md5($senha);
  
    $sql = "INSERT INTO Usuario (nome_completo, data_nasc, tel, apelido, email, senha, id_avatar) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"; 

    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssi", $nome_completo, $data_nasc, $tel, $apelido, $email, $senha_md5, $id_avatar);   
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
  $sql = "SELECT apelido FROM Usuario WHERE apelido = ?"; 
  $conexao = obterConexao();
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("s", $apelido);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $usuario = mysqli_fetch_assoc($resultado);

  if ($usuario == null) {
  $_SESSION["msg"] = "Usuário incorreto!";
  $_SESSION["tipo_msg"] = "alert-warning";
  } else {
    $senha_md5 = md5($senha);
    $sql = "SELECT * FROM Usuario
            WHERE apelido = ? AND senha = ?";  

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $apelido, $senha_md5);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = mysqli_fetch_assoc($resultado);
    
    if ($usuario == null) {
      $_SESSION["msg"] = "Senha incorreta!";
      $_SESSION["tipo_msg"] = "alert-warning";
    } else {
      $_SESSION["msg"] =  null;
    }
  }
  $stmt->close();
  $conexao->close();
  return [$usuario, $_SESSION["msg"]];
   
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
   
function editarUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $id_usuario, $id_avatar){
$conexao = obterConexao();
$senha_md5 = md5($senha); 
  
$sql = "UPDATE Usuario
        SET nome_completo = ?, data_nasc = ?, tel = ?, apelido = ?, email = ?, senha = ?, id_avatar = ?
        WHERE id_usuario = ?";


  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("ssssssii", $nome_completo, $data_nasc, $tel, $apelido, $email, $senha_md5, $id_avatar, $id_usuario);
  $stmt->execute();


  if ($stmt->affected_rows > 0) {
    $_SESSION["msg"] = "Seus dados foram alterados!";
    $_SESSION["tipo_msg"] = "alert-warning";
  } else {
    $_SESSION["msg"] = "Seus dados não foram alterados! Erro: " . mysqli_error($conexao);
    $_SESSION["tipo_msg"] = "alert-danger";
  }  

  $stmt->close();
  $conexao->close();
}



//------------------------------------------------------------------------------------------------
  
function listarUsuario(){
  $lista_usuario = [];
  $sql = "SELECT u.id_usuario,u.nome_completo,u.data_nasc,u.tel,u.apelido,u.email,u.senha
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


?>
