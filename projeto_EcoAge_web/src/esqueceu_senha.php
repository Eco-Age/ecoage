<?php
  include("../include/cabecalho.php");

  if (!isset($_SESSION)) {
    session_start();
  };

     if(isset($_POST["email_recuperar"])){
         $email = $_POST["email_recuperar"];

         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION["msg"] = "E-mail inválido!.";
            $_SESSION["tipo_msg"] = "alert-success"; 
         }

         $nova_senha = substr(md5(time()), 0, 6);
         $ns_criptografada = md5(md5($nova_senha));
 
 
         if(mail($email, "Sua nova senha", "Sua nova senha: ".$nova_senha)){
            
             $sql_code = "UPDATE Usuario SET senha = '$ns_criptografada' WHERE email = '$email'";
             $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
 
             if($sql_query){
                 $_SESSION["msg"] = "Senha alterada com sucesso!.";
                 $_SESSION["tipo_msg"] = "alert-success"; 
             }
         }
    }

?>