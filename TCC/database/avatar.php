<?php

if (!isset($_SESSION)) {
    session_start();
  };

  $id_usuario = $_SESSION['id_usuario'];

  
require_once("conexao.php");


function escolha_avatar(){
    
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

}




function avatar_atual($id_usuario){
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

}


   function edicao_avatar(){

    $conexao = obterConexao();
    
        // Exibir os avatares em um formulário HTML
    $consulta = mysqli_query($conexao, "SELECT id_avatar, nome, caminho FROM avatars");

    while ($avatar = mysqli_fetch_assoc($consulta)) {
        echo "<input type='radio' name='id_avatar' id='id_avatar' value='" . $avatar['id_avatar'] . "'><img src='" . $avatar['caminho'] . "' alt='" . $avatar['nome'] . "'><br>";
    }

    // Verificar se o usuário escolheu um novo avatar
    if (isset($_POST['escolha_avatar'])) {
        // Obter o id do novo avatar selecionado
        $id_novo_avatar = mysqli_real_escape_string($conexao, $_POST['avatar']);

        // Atualizar o avatar do usuário
        mysqli_query($conexao, "UPDATE Usuario SET id_avatar = '$id_novo_avatar' WHERE id_usuario = '$id_usuario'");
    }
    }
    


?>