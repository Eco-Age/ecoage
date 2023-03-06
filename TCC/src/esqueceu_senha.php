<?php
if (!isset($_SESSION)) {
    session_start();
  };
  include("../include/cabecalho.php");
  require ("../database/usuario.php");
  require_once ('PHPMailer-6.7.1/src/PHPMailer.php');
  require_once ('PHPMailer-6.7.1/src/SMTP.php');
  require_once ('PHPMailer-6.7.1/src/Exception.php');

      $email_recuperar = $_POST['email_recuperar'];
      $_SESSION["email_recuperar"] = $_POST["email_recuperar"];

      verificaEmail($email_recuperar);

      $token = bin2hex(random_bytes(16));
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
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));

      $mail->isHTML(true);
      $mail->ContentType = 'text/html';
      
      $mail->setFrom('live.ecoage@gmail.com', 'EcoAge');
      $mail->addAddress($email_recuperar);

      $mail->AddEmbeddedImage('../assets/logo.png', 'logo_ref');
      
      $mail->Subject = '[Recuperação de Senha]';
      $mail->Body    = '<h2 style="text-align: center;">Recuperação de Senha</h2>
                        <p>Olá!</p>
                        <p>Você está recebendo este email porque requisitou uma recuperação de senha. </p>
                        <p>Para redefinir sua senha, digite o seguinte token na página que você foi redirecinado no site: <br><p style="font-size: 18px; text-align: center;">'. $token . '</p></p>
                        <br><p style="font-size: 12px; text-align: center;">Se você não pediu por nenhuma redefinição de senha, por favor ignore este email.</p>
                        <br><p>Equipe</p>
                        <h4>ECOAGE</h4>
                        <img src="cid:logo_ref" alt="Imagem LOGO" style="width: 100px; height: auto"/>';
                        

      
      if ($mail->send()) {
          header("Location: token.php");
      } else {
          echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
      }

      token($email_recuperar, $token);

  ?>
  
