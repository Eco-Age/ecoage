<?php
include ("../include/cabecalho.php");
require ("../database/usuario.php");


?>
<script src="../assets/script.js"></script>

<body>
<div id="conteudo_token_novasenha">
    <h3 style="text-align: center; padding: 10px 0 20px;">Alteração de senha</h3>

    <div class="row" style="margin: 0 10px">
                <div class="col-4"></div>
                    <div class="col-4">
                    <form action="recupera_senha.php" method="POST">
                        <div class="form-group">
                            <label for="senha1">Digite a nova senha: </label>
                            <input type="password" id="senha1" name="senha1" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required class="form-control" style="text-align: left;" placeholder="******" required>
                            <small id="" class="form-text text-muted">A senha deve conter mais de 8 caracteres, ao menos 1 letra maiúscula e 1 número.</small>
                        </div>
                        <div class="form-group">
                            <label for="senha2">Confirme a nova senha: </label>
                            <input type="password" id="senha2" name="senha2" class="form-control" style="text-align: left;" placeholder="******" onkeyup="verificarSenha()">
                            <span id="resultado"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="main-btn btn btn-primary" id="submit" value="Alterar senha" disabled>
                        </div>
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