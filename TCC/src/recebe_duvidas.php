<?php
  include("../include/cabecalho.php");
  require ("../database/usuario.php");
  require_once ('PHPMailer-6.7.1/src/PHPMailer.php');
  require_once ('PHPMailer-6.7.1/src/SMTP.php');
  require_once ('PHPMailer-6.7.1/src/Exception.php');

      $email_ajuda = $_POST['email_ajuda'];
      $assunto_ajuda = $_POST["assunto_ajuda"];
      $duvida = $_POST["duvida"];
      $nome  = $_POST["nome"];
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      
      $mail->isSMTP();
      $mail->SMTPDebug = 0;      
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';
      $mail->Host = 'smtp.gmail.com';
      $mail->Username = 'live.ecoage@gmail.com'; 
      $mail->Password = 'rdapzocicdqxyqba'; 
      $mail->Port = 587;
      $mail->CharSet = 'UTF-8';

      $mail->isHTML(true);
      $mail->ContentType = 'text/html';
      
      $mail->setFrom($email_ajuda, $nome);
      $mail->addAddress('live.ecoage@gmail.com');

      
      $mail->Subject = '[Dúvida - EcoAge] - '. $assunto_ajuda;
      $mail->Body    = '<h2 style="text-align: center;">'. $assunto_ajuda .' </h2>
                        <h3>Email do usuário: </h3>
                            <p>'. $email_ajuda .'</p>
                        <h3>Nome do usuário: </h3>
                            <p>'. $nome .'</p>
                        <h3>Dúvida do usuário: </h3>
                            <p>' . $duvida . '</p>';
                        

      
      if ($mail->send()) {
        $_SESSION["msg"] = "Sua dúvida foi enviada e será respondida em breve!";
        $_SESSION["tipo_msg"] = "alert-success"; 
        header("Location: ajuda.php");
      } else {
        $_SESSION["msg"] = 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
        $_SESSION["tipo_msg"] = "alert-danger"; 
        header("Location: ajuda.php");
      }
?>
