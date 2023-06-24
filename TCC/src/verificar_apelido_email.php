<?php

require("../database/usuario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['apelido'])) {
        $apelido = $_POST['apelido'];

        if (verificarApelidoCadastrado($apelido)) {
            echo 'existe';
        } else {
            echo 'nao_existe';
        }
    }

    if (isset($_POST['email_cadastro'])) {
        $email = $_POST['email_cadastro'];

        if (verificarEmailCadastrado($email)) {
            echo 'existe';
        } else {
            echo 'nao_existe';
        }
    }
}
?>
