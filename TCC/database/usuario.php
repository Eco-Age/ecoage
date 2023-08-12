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
  }

  function verificarApelidoCadastrado($apelido){
    $sql = "SELECT * FROM Usuario WHERE apelido = ?";
    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $apelido);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $cadastrado = mysqli_num_rows($resultado);
    if (0 < $cadastrado) {
       return true;
    }else {
      return false;
    }
  }
  
  function verificarEmailCadastrado($email){
    $sql = "SELECT * FROM Usuario WHERE email = ?";
    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $cadastrado = mysqli_num_rows($resultado);
    if (0 < $cadastrado) {
       return true;
    }else {
      return false;
    }
  }

  function inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $verifica, $id_avatar, $tipo_usuario, $modo){

    $conexao = obterConexao();
    $senha_md5 = md5($senha);
  
    $sql = "INSERT INTO Usuario (nome_completo, data_nasc, tel, apelido, email, senha, verifica, id_avatar, tipo_usuario, modo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 

    $conexao = obterConexao();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssiiii", $nome_completo, $data_nasc, $tel, $apelido, $email, $senha_md5, $verifica, $id_avatar, $tipo_usuario, $modo);   
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
    header("Location: ../public/index.php");
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
   
function editarUsuario($senhaDigitada, $nome_completo, $data_nasc, $tel, $apelido, $email, $id_usuario, $id_avatar, $tipo_usuario, $modo){
  $conexao = obterConexao();
  $sql = "SELECT senha FROM Usuario WHERE id_usuario = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i",$id_usuario);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $senhaCadastrada = $row['senha'];

  $stmt->close();
  $senhaDigitada_md5 = md5($senhaDigitada);
  
  if ($senhaCadastrada === $senhaDigitada_md5){
      $sql = "UPDATE Usuario
      SET nome_completo = ?, data_nasc = ?, tel = ?, apelido = ?, email = ?,  id_avatar = ?,  tipo_usuario = ?, modo = ?
      WHERE id_usuario = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("sssssiiii", $nome_completo, $data_nasc, $tel, $apelido, $email, $id_avatar, $tipo_usuario, $modo, $id_usuario);
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
          $_SESSION["msg"] = "Seus dados foram alterados!";
          $_SESSION["tipo_msg"] = "alert-success";
      } else {
          $_SESSION["msg"] = "Nenhuma alteração foi realizada. Favor, editar algum campo.";
          $_SESSION["tipo_msg"] = "alert-warning";
      }  
  } else {
      $_SESSION["msg"] = 'Senha incorreta, dados inalterados. Caso tenha esquecido sua senha, recupere-a na tela de login.';
      $_SESSION["tipo_msg"] = "alert-danger";
  }
}


//------------------------------------------------------------------------------------------------
  

date_default_timezone_set('America/Sao_Paulo');

function token($email_recuperar, $token){
  $conexao = obterConexao();
  $data_expiracao = date('Y-m-d H:i:s', strtotime('+5 minutes'));
  try {
    $sql_select_registro = "SELECT token FROM tokens WHERE email = ?";
    $stmt_select_registro = $conexao->prepare($sql_select_registro);
    $stmt_select_registro->bind_param('s', $email_recuperar);
    $stmt_select_registro->execute();
    $resultado = $stmt_select_registro->get_result();

    if ($resultado->num_rows > 0){
      $sql_apaga_registro = "DELETE FROM tokens WHERE email = ?";
      $stmt_apaga_registro = $conexao->prepare($sql_apaga_registro);
      $stmt_apaga_registro->bind_param('s', $email_recuperar);
      $stmt_apaga_registro->execute();
    }

    $sql = "INSERT INTO tokens (email, token, data_expiracao) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sss', $email_recuperar, $token, $data_expiracao);
    $stmt->execute();
  }

  finally{
    $stmt_select_registro->close();
    $stmt_apaga_registro->close();
    $stmt->close();
    $conexao->close();
  }
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
  header("Location: ../src/form_nova_senha.php?executar=recuperasenha");
  exit;
  } else {
    include ("../include/cabecalho.php");
    echo '<div id="conteudo">
            <h1 style="text-align: center; padding: 50px;" class="display-2">
              Ocorreu um erro '. $token_armazenado, $token_digitado . '
            </h1>
            <h3 style="text-align: center;" class="display-4">
              Clique no botão de dúvida para entender 
              <button style="text-align: center;" type="submit" onclick="duvida_token()" <span class="material-symbols-outlined">help</span></button><br>
              <a href="../src/token.php" style="text-align: center; background-color: #623f80;" class="btn btn-outline-light">Voltar</a>
            </h3>
          </div>';
    echo "<script src='../assets/js/script.js'></script>";
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
    $sql = "SELECT senha FROM Usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $senha_atual = $row['senha'];
    $nova_senha_md5 = md5($nova_senha);
   
    if ($nova_senha_md5 == $senha_atual){
      $_SESSION["msg"] = "Erro: A nova senha é igual à senha atual. Por favor, escolha uma nova senha.";
      $_SESSION["tipo_msg"] = "alert-danger";
      header("Location: ../public/index.php");
      exit;
    } else {
      $sql = "UPDATE Usuario SET senha = ? WHERE email = ?";
      $stmt = $conexao->prepare($sql);
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

  function confirmaSenha($id_usuario, $senhaDigitada){
    $conexao = obterConexao();
    $sql = "SELECT senha FROM Usuario WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i",$id_usuario);
    $stmt->execute();
    $stmt->bind_result($senhaCadastrada);
    $stmt->fetch();
    $stmt->close();

    $senhaDigitada_md5 = md5($senhaDigitada);

    if ($senhaCadastrada === $senhaDigitada_md5){
      header("Location: ../src/form_nova_senha.php?executar=alterarsenha");
    }else {
      $_SESSION["msg"] = "Senha incorreta. Caso tenha esquecido sua senha, recupere-a na tela de login.";
      $_SESSION["tipo_msg"] = "alert-danger";
      header("Location: ../src/pagina_inicial.php");
    }
  }

  function alteraSenha($id_usuario, $nova_senha) {
    $conexao = obterConexao();
    $sql = "SELECT senha FROM Usuario WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $senha_atual = $row['senha'];

    $sql = "UPDATE Usuario SET senha = ? WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $nova_senha_md5 = md5($nova_senha);
    if ($nova_senha_md5 == $senha_atual){
      $_SESSION["msg"] = "Erro: A nova senha é igual à senha atual. Por favor, escolha uma nova senha.";
      $_SESSION["tipo_msg"] = "alert-danger";
      header("Location: ../src/pagina_inicial.php");
      exit;
    }else{
    $stmt->bind_param("si", $nova_senha_md5, $id_usuario);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $_SESSION["msg"] = "Sua senha foi atualizada com sucesso!";
        $_SESSION["tipo_msg"] = "alert-success";
    } else {
        $_SESSION["msg"] = "Seus dados não foram alterados! Erro: " . mysqli_error($conexao);
        $_SESSION["tipo_msg"] = "alert-danger";
    }

  
    $stmt->close();
    $conexao->close();
  }
}

function codigo($email, $codigo){
  $conexao = obterConexao();
  $data_expiracao = date('Y-m-d H:i:s', strtotime('+5 minutes'));

  try {
    // aqui vou verificar se esse usuario já pediu um codigo
    $sql_select_registro = "SELECT codigo FROM Codigos WHERE email = ?";
    $stmt_select_registro = $conexao->prepare($sql_select_registro);
    $stmt_select_registro->bind_param('s', $email);
    $stmt_select_registro->execute();
    $resultado = $stmt_select_registro->get_result();
    // se ele ja pediu, vou apagar o anterior que tava salvo antes
    if ($resultado->num_rows > 0){
      $sql_apaga_registro = "DELETE FROM Codigos WHERE email = ?";
      $stmt_apaga_registro = $conexao->prepare($sql_apaga_registro);
      $stmt_apaga_registro->bind_param('s', $email);
      $stmt_apaga_registro->execute();
    }
    // depois de apagar (caso existisse) vou vir aqui e agora sim, criar um novo
    $sql = "INSERT INTO Codigos (email, codigo, data_expiracao) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sss', $email, $codigo, $data_expiracao);
    $stmt->execute();
  } finally {
    // fechando os statement e a conexão
    $stmt_select_registro->close();
    $stmt_apaga_registro->close();
    $stmt->close();
    $conexao->close();
  }
}


function confirmaEmail($email, $codigo_digitado){
  $conexao = obterConexao();
  $sql = "SELECT codigo, data_expiracao FROM Codigos WHERE email = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($codigo_armazenado, $data_expiracao);
  $stmt->fetch();
  
  $diferenca_minutos = (time() - strtotime($data_expiracao)) / 60;
  if ($codigo_digitado === ($codigo_armazenado) && $diferenca_minutos < 5) {
    return true;
  } else {
    include ("../include/cabecalho.php");
    echo '<div id="conteudo">
            <h1 style="text-align: center; padding: 50px;" class="display-2">
              Ocorreu um erro
            </h1>
            <h3 style="text-align: center;" class="display-4">
            Para entender melhor o erro que aconteceu, clique no botão de dúvidas!<br>
            <button class="btn-purple-circulo mx-auto" type="submit" onclick="duvida_codigo()">
              <i class="fas fa-question"></i>
            </button> <br>
            <a href="../src/email.php" class="btn btn-purple mx-auto" type="submit">
              Voltar
            </a>
            </h3>
          </div>';
    echo "<script src='../assets/js/script.js'></script>";
    include ("../include/rodape.php");
  }
}

function excluirEmailExpirado() {
  $conexao = obterConexao();
  $sql = "DELETE FROM Codigos WHERE data_expiracao <= NOW()";
  $stmt = $conexao->prepare($sql);
  $stmt->execute();
  $stmt->close();
  $conexao->close();
}

function atualizaVerifica($email, $verifica){
  $conexao = obterConexao();
  $sql = "UPDATE Usuario SET verifica = ? WHERE email = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param('is', $verifica, $email);
  $stmt->execute();
  $conexao->close();
}

function buscaVerifica($email){
  $conexao = obterConexao();
  $sql = "SELECT verifica FROM Usuario WHERE email = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param('s',$email);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $verifica = mysqli_fetch_assoc($resultado);
  $conexao->close();

  if ($verifica == null) {
    return array('verifica' => 0);
  }

  $verifica = intval($verifica['verifica']);
  return array('verifica' => $verifica);
}
// ta vendo se é pra mostrar em modo claro ou escuro

  function verificaSessao() {
    $conexao = obterConexao();
    $usuario = $_SESSION["id_usuario"];
    $sql = "SELECT modo FROM Usuario WHERE id_usuario = $usuario";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado && $resultado->num_rows > 0) {
      $modoArray = $resultado->fetch_assoc();
      $modo = $modoArray['modo'];
    }
    $conexao->close();
  
    if ($modo === 1) {
      echo '<script>
              document.getElementsByTagName("body")[0].classList.add("modo-escuro");
            </script>';
    } 
  
  
    
  
  $limite_inatividade = 604800; // 1 semana de limite 
  if (isset($_SESSION["apelido_logado"]) && isset($_SESSION["nome_logado"]) && isset($_SESSION["id_usuario"])){
    if (isset($_SESSION['ultima_atividade'])) {
        $tempo_desde_ultima_atividade = time() - $_SESSION['ultima_atividade'];
        if ($tempo_desde_ultima_atividade > $limite_inatividade) {
            session_unset();
            $_SESSION["msg"] = "Sua sessão provavelmente expirou. Por favor, entre novamente.";
            $_SESSION["tipo_msg"] = "alert-warning";
            header("Location: ../public/index.php");
            exit;
        }
    }
    $_SESSION['ultima_atividade'] = time();
  } else if (!isset($_SESSION["apelido_logado"]) || !isset($_SESSION["nome_logado"]) || !isset($_SESSION["id_usuario"])){

    session_unset();

    $_SESSION["msg"] = "Sua sessão provavelmente expirou. Por favor, entre novamente.";
    $_SESSION["tipo_msg"] = "alert-warning";
    header("Location: ../public/index.php");
    exit;
  }
}

?>
