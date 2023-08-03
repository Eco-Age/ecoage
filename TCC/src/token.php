<?php
    include("../include/cabecalho.php");
    require ("../database/usuario.php");
    excluirTokenExpirado(); 

?>
<body>
<div id="conteudo_token_novasenha">
    <h3 style="text-align: center; padding: 10px 0 20px;">Verificação de Código recebido</h3>

    <div class="row" style="margin: 0 10px">
                <div class="col-4"></div>
                <div class=" col-lg-4 col-md-6 col-sm-12">
                    <form action="verificatoken.php" method="POST">
                        <p class="text-center" >Digite o código que você recebeu no seu e-mail</p>
                        <div class="form-row">
                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                            <div class="form-group col-md-2">
                                <input type="text" id="token" class="form-control input_recupera_senha digit-only"
                                    maxlength="1" name="token[]" <?php if ($i == 1) {
                                        echo 'autofocus';
                                    } ?>>
                            </div>
                        <?php } ?>
                        <div class="d-flex justify-content-center mx-auto" style="margin-bottom: 10px;">
                            <small id="token_info" class="form-text text-muted">Não compartilhe este código com ninguém antes que ele expire.</small>
                        </div>
                        <div class="d-flex justify-content-center mx-auto" style="margin-bottom: 10px;">
                            <small id="token_info" class="form-text text-muted">Se não receber o código, lembre-se de checar a caixa de SPAM!</small>
                        </div>
                        </div>
                        <div class="d-flex justify-content-center mx-auto">
                            <input type="submit" style="margin-right: 5px" class="main-btn btn btn-primary" value="Verificar Token">
                            <a href="../public/index.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </form>
                    </div>
                <div class="col-4"></div>
            </div>  
        </div>

        <script type="text/javascript" src="../assets/js/script.js"></script>
    <?php
        include("../include/rodape.php");
    ?>
</div>
</body>
</html>
