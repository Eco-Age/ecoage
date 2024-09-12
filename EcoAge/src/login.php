<?php
require("../database/usuario.php");

$apelido = $_POST["apelido_login"];
$senha = $_POST["senha_login"];


$dados_consulta = buscarUsuario($apelido, $senha);
$usuario = $dados_consulta[0];

if ($usuario == null) {
  $saida = ["autenticado" => false, "msg" => $dados_consulta[1]];
  header("Location: ../index.php");
} else {
  $saida = ["autenticado" => true];
  $_SESSION["nome_logado"] = $usuario["nome_completo"];
  $_SESSION["apelido_logado"] = $usuario["apelido"];
  $_SESSION["id_usuario"] = $usuario["id_usuario"];
  $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];
  $_SESSION["email"] = $usuario["email"];

  header("Location: ../src/pagina_inicial.php");
}

$json = json_encode($saida);
echo $json;
?>
