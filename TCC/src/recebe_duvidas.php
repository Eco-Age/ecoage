<?php
    if (isset($_POST['email_ajuda']) && !empty($_POST['email_ajuda'])){
        $email_ajuda = addslashes($_POST["email_ajuda"]);
        $assunto_ajuda = addslashes($_POST["assunto_ajuda"]);
        $duvida = addslashes($_POST["duvida"]);

        $to = "eduboni10@gmail.com";
        $subject = "Contato - EcoAge";
        $body = "Email: ".$email_ajuda. "\r\n".
                "Assunto: ".$assunto_ajuda. "\r\n".
                "Dúvida: ".$duvida;
        $header = "From: eduuboni@gmail.com"."\r\n"."Reply-To:".$email_ajuda."\e\n"."X=Mailer:PHP/".phpversion();
        if(mail($to, $subject, $body, $header,'-feduboni10@gmail.com')){
            echo ("Sua dúvida foi enviada e será respondida em breve!");
        }else{
            echo "Não pode ser enviado";
        }
    } 
?>