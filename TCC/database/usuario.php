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
    $stmt->close();
    if (0 < $cadastrado) {
       return true;
    }else {
      return false;
    }
  }
  
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
   
function editarUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $id_usuario){
  
$sql = "UPDATE Usuario 
        SET nome_completo = ?, data_nasc = ?, tel = ?, apelido = ?, email = ?, senha = ?
        WHERE id_usuario = ?";

  $conexao = obterConexao();

  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("ssssssi", $nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $id_usuario);
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

// - DENTRO DESTA SEÇÃO ESTÃO CONTIDOS TODAS AS FUNÇÕES REFERENTES A RECUPERAR A SENHA

date_default_timezone_set('America/Sao_Paulo');

function token($email_recuperar, $token){
  $conexao = obterConexao();
  $data_expiracao = date('Y-m-d H:i:s', strtotime('+5 minutes'));
  $sql = "INSERT INTO tokens (email, token, data_expiracao) VALUES (?, ?, ?)";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param('sss', $email_recuperar, $token, $data_expiracao);
  $stmt->execute();
  $stmt->close();
  $conexao->close();
}

function verificatoken($email, $token_digitado){

  $conexao = obterConexao();
  $sql = "SELECT token, data_expiracao FROM tokens WHERE email = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($token_armazenado, $data_expiracao);
  $stmt->fetch();
  
  $diferenca_minutos = (time() - strtotime($data_expiracao)) / 60;
  
  if ($token_digitado === $token_armazenado && $diferenca_minutos < 5) {
  header('Location: form_nova_senha.php');
  exit;
  } else {
    include ("../include/cabecalho.php");
    echo '<div id="conteudo">
            <h1 style="text-align: center; padding: 50px;" class="display-2">
              Ocorreu um erro
            </h1>
            <h3 style="text-align: center;" class="display-4">
              Clique no botão de dúvida para entender 
              <button style="text-align: center;" type="submit" onclick="duvida_token()" <span class="material-symbols-outlined">help</span></button><br>
              <a href="../src/token.php" style="text-align: center; background-color: #623f80;" class="btn btn-outline-light">Voltar</a>
            </h3>
          </div>';
    echo "<script src='../assets/script.js'></script>";
    include ("../include/rodape.php");
  }
  
  $stmt->close();
  $conexao->close();
  }

  function excluirTokenExpirado() {
    $conexao = obterConexao();
    $sql = "DELETE FROM tokens WHERE data_expiracao <= NOW()";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
  }
  
  function recuperaSenha($email, $nova_senha){
      $conexao = obterConexao();
      $sql = "UPDATE Usuario SET senha = ? WHERE email = ?";
      $stmt = $conexao->prepare($sql);
      $nova_senha_md5 = md5($nova_senha);
      $stmt->bind_param("ss", $nova_senha_md5, $email);
      $stmt->execute();
      if ($stmt->affected_rows > 0) {
        $_SESSION["msg"] = "Sua senha foi atualizada. Realize o Login!";
        $_SESSION["tipo_msg"] = "alert-success";
      } else {
        $_SESSION["msg"] = "Seus dados não foram alterados! Erro: " . mysqli_error($conexao);
        $_SESSION["tipo_msg"] = "alert-danger";
      }  
    
      $stmt->close();
      $conexao->close();
  } 
  
  function verificaEmail($email_recuperar){
    $conexao = obterConexao();
    $sql = "SELECT * FROM Usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s",$email_recuperar);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $qtd_email = mysqli_num_rows($resultado);

    if ($qtd_email < 1){
      $_SESSION["msg"] = "Esta conta não está cadastrada. Favor utilizar um e-mail cadastrado.";
      $_SESSION["tipo_msg"] = "alert-danger";
      header("Location: ../public/index.php");
      exit();
    }

    return $qtd_email;

  }

  // - FIM DA SEÇÃO RECUPERAR SENHA 
?>
