<?php

if (!isset($_SESSION)) {
    session_start();
  };


  if (isset($_SESSION['id_usuario'])) {
     $id_usuario = $_SESSION['id_usuario'];
  };
  
require_once("conexao.php");


/*function escolha_avatar(){
    
    // Conectar ao banco de dados
    $conexao = obterConexao();

    // Selecionar todos os avatares
    $consulta = mysqli_query($conexao, "SELECT id_avatar, nome, caminho FROM avatars");


    if(mysqli_num_rows($consulta) > 0){
        
        // Exibir os avatares em um formulário HTML
        
        while ($avatar = mysqli_fetch_assoc($consulta)) {
            echo "<input type='radio' name='id_avatar' value='" . $avatar['id_avatar'] . "'><br></br>";
            echo "<img src=\"" . $avatar['caminho'] . "\" alt=\"" . $avatar['nome'] . "\"><br></br>";
        }
        
        
    }else{
        echo "Nenhum avatar encontrado.";
    }

}*/


function listarAvatar(){

    $lista_avatar = [];

    $sql = "SELECT * FROM avatars";
  
  $conexao = obterConexao();

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
  while ($avatar = mysqli_fetch_assoc($resultado)) {
    array_push($lista_avatar, $avatar);
  }    

  $stmt->close();
  $conexao->close();
 
  return $lista_avatar;

}



/*function avatar_atual($id_usuario){
    // Conectar ao banco de dados
    $conexao = obterConexao();

    // Selecionar o ID do avatar atual do usuário
    $consulta = mysqli_query($conexao, "SELECT id_avatar FROM Usuario WHERE id_usuario = '$id_usuario'");
    $usuario = mysqli_fetch_assoc($consulta);
    $id_avatar_atual = $usuario['id_avatar'];

    // Exibir a imagem atual do usuário
    $consulta = mysqli_query($conexao, "SELECT caminho FROM avatars WHERE id_avatar = '$id_avatar_atual'");
    $avatar_atual = mysqli_fetch_assoc($consulta);
    echo "<img src=\"" . $avatar_atual['caminho'] . "\"><br><br>";

}*/



function buscarAvatar(){
    $sql = "SELECT * FROM avatars WHERE id_avatar = ?";
      
    $conexao = obterConexao(); 
  
    $stmt = $conexao->prepare($sql);
  
    $stmt->bind_param("i", $id_avatar);
    $stmt->execute();
  
    $resultado = $stmt->get_result();
    $avatar = mysqli_fetch_assoc($resultado);
  
    $stmt->close();
    $conexao->close();
  
    return $avatar;  
}

    
function buscarAvatarUsado($id_usuario){
    
       // Conectar ao banco de dados
    $conexao = obterConexao();

    // Selecionar o ID do avatar atual do usuário
    $consulta = mysqli_query($conexao, "SELECT id_avatar FROM Usuario WHERE id_usuario = '$id_usuario'");
    $usuario = mysqli_fetch_assoc($consulta);
    $id_avatar_atual = $usuario['id_avatar'];

    // Exibir a imagem atual do usuário
    $consulta = mysqli_query($conexao, "SELECT caminho FROM avatars WHERE id_avatar = '$id_avatar_atual'");
    $avatar_atual = mysqli_fetch_assoc($consulta);
   

    return $avatar_atual;  
  }


?>
