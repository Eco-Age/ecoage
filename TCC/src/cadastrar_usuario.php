<?php
require("../database/usuario.php");
include("../include/cabecalho.php");
require_once('PHPMailer-6.7.1/src/PHPMailer.php');
require_once('PHPMailer-6.7.1/src/SMTP.php');
require_once('PHPMailer-6.7.1/src/Exception.php');

$verifica = isset($_POST['verifica']) ? intval($_POST['verifica']) : 0;
$tipo_usuario = $_POST["tipo_usuario"];
$modo = $_POST["modo"];
$nome_completo = $_POST["nome_completo"];
$data_nasc = $_POST["data_nasc"];
$tel = $_POST["tel"];
$apelido = $_POST["apelido"];
$email = $_POST["email_cadastro"];
$senha = $_POST["senha_cadastro"];
$id_avatar = $_POST["id_avatar"];


if (verificarUsuarioCadastrado($apelido, $email) == true) {
    header("Location: ../public/index.php");
    $_SESSION["msg"] = "Email ou apelido já cadastrado no sistema!";
    $_SESSION["tipo_msg"] = "alert-danger";
} else {
    if ($verifica == 1) {

        $_SESSION["cadastro_info"] = array(
            "tipo_usuario" => $tipo_usuario,
            "nome_completo" => $nome_completo,
            "data_nasc" => $data_nasc,
            "tel" => $tel,
            "apelido" => $apelido,
            "email" => $email,
            "senha" => $senha,
            "id_avatar" => $id_avatar,
            "modo" => $modo,
            "tempo_expiracao" => time() + 300 // 300 segundos = 5 minutos
        );

        $codigo = mt_rand(1, 9);
        for ($i = 0; $i < 5; $i++) {
            $codigo .= mt_rand(0, 9);
        }

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

        $mail->AddEmbeddedImage('../assets/img/logo.png', 'logo_ref');

        $mail->Subject = '[Verificação de Email]';
        $mail->Body = '<h2 style="text-align: center;">Confirmação de Email</h2>
                        <p>Olá!</p>
                        <p>Você está recebendo este email porque tentou criar uma conta em nosso website. </p>
                        <p>Para prosseguir com seu cadastro, por favor digite os seis números a seguir na página que você foi redirecinado no site: <br><p style="font-size: 18px; text-align: center;">' . $codigo . '</p></p>
                        <br><p style="font-size: 12px; text-align: center;">Nunca compartilhe esse email com ninguém.</p>
                        <br><p style="font-size: 12px; text-align: center;">Se você não tentou criar uma conta no website EcoAge, por favor ignore este email.</p>
                        <br><p>Equipe</p>
                        <h4>ECOAGE</h4>
                        <img src="cid:logo_ref" alt="Imagem LOGO" style="width: 100px; height: auto"/>';



        if ($mail->send()) {
            header("Location: email.php");
        } else {
            echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
        }
        codigo($email, $codigo);

    } else {

        $_SESSION["id_avatar"] = $id_avatar;
        inserirUsuario($nome_completo, $data_nasc, $tel, $apelido, $email, $senha, $verifica, $id_avatar, $tipo_usuario, $modo);

    }
}

?>