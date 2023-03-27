<?php
include("../include/cabecalho.php");
require("../database/usuario.php");
require_once('PHPMailer-6.7.1/src/PHPMailer.php');
require_once('PHPMailer-6.7.1/src/SMTP.php');
require_once('PHPMailer-6.7.1/src/Exception.php');

$verifica = 1;

$codigo = mt_rand(1, 9);
    for ($i = 0; $i < 5; $i++) {
        $codigo .= mt_rand(0, 9);
    }

if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];

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
            )
        );

        $mail->isHTML(true);
        $mail->ContentType = 'text/html';

        $mail->setFrom('live.ecoage@gmail.com', 'EcoAge');
        $mail->addAddress($email);

        $mail->AddEmbeddedImage('../assets/logo.png', 'logo_ref');

        $mail->Subject = '[Recuperação de Senha]';
        $mail->Body = '<h2 style="text-align: center;">Confirmação de Email</h2>
                        <p>Olá!</p>
                        <p>Você está recebendo este email porque tentou verificar sua conta cadastrada em nosso website. </p>
                        <p>Para prosseguir com sua verificação, por favor digite os seis números a seguir na página que você foi redirecinado no site: <br><p style="font-size: 18px; text-align: center;">' . $codigo . '</p></p>
                        <br><p style="font-size: 12px; text-align: center;">Nunca compartilhe esse email com ninguém.</p>
                        <br><p style="font-size: 12px; text-align: center;">Se você não tentou verificar sua conta no website EcoAge, por favor ignore este email.</p>
                        <br><p>Equipe</p>
                        <h4>ECOAGE</h4>
                        <img src="cid:logo_ref" alt="Imagem LOGO" style="width: 100px; height: auto"/>';



        if ($mail->send()) {
            header("Location: email.php");
        } else {
            echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
        }
        codigo($email, $codigo);
    }

?>