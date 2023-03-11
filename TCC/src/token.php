<?php
    include("../include/cabecalho.php");
    require ("../database/usuario.php");
    excluirTokenExpirado(); 

?>
<body>
<div id="conteudo_token_novasenha">
    <h3 style="text-align: center; padding: 10px 0 20px;">Verificação de Token recebido</h3>

    <div class="row" style="margin: 0 10px">
                <div class="col-4"></div>
                    <div class="col-4">
                    <form action="verificatoken.php" method="POST">
                        <div class="form-group">
                            <label for="token">Token: </label>
                            <input type="text" class="form-control" id="token" style="text-align: left;" placeholder="Token recebido no e-mail" name="token" required>
                            <small id="token_info" class="form-text text-muted">Não compartilhe este token com ninguém antes que ele expire.</small>
                            <small id="token_info" class="form-text text-muted">Se não receber o código, lembre-se de checar a caixa de SPAM!</small>
                        </div>
                        <input type="submit" class="main-btn btn btn-primary" value="Verificar Token">
                        <a href="../public/index.php" class="btn btn-secondary">Voltar</a>
                    </form>
                    </div>
                <div class="col-4"></div>
            </div>  
        </div>

       
    <?php
        include("../include/rodape.php");
    ?>
</div>
</body>
</html>
