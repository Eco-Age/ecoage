<?php
require("../include/cabecalho.php");
require("../database/usuario.php");
excluirEmailExpirado();
?>

<body>
    <div id="conteudo_token_novasenha">
        <div class="row" style="margin: 0 10px">
            <div class="col-4"></div>
            <div class=" col-lg-4 col-md-6 col-sm-12">
                <h3 style="text-align: center; padding: 10px 0 20px;">Verificação de Email</h3>
                <form action="verificaemail.php" method="POST">
                    <p class="text-center" >Digite o código que você recebeu no seu e-mail</p>
                    <div class="form-row">
                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                            <div class="form-group col-md-2">
                                <input type="text" id="id_email" class="form-control input_confirma_email digit-only"
                                    maxlength="1" name="codigo[]" <?php if ($i == 1) {
                                        echo 'autofocus';
                                    } ?>>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="d-flex justify-content-center mx-auto" style="margin-bottom: 10px;">
                        <small class="form-text text-muted">Não recebeu o código? Cheque a caixa de SPAM.</small>
                    </div>
                    <div class="d-flex justify-content-center mx-auto">
                        <button type="submit" style="margin-right: 10px;" class="btn btn-purple">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

    <script type="text/javascript" src="../assets/script.js"></script>

    <?php
    include("../include/rodape.php");
    ?>

    </html>