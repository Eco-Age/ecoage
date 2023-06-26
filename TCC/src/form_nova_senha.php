<?php
include ("../include/cabecalho.php");
require ("../database/usuario.php");


?>
<script src="../assets/js/script.js"></script>

<div id="conteudo_token_novasenha">
    <div class="row">
        <div class="col-2 col-sm-2 col-md-2 col-lg-3 col-xl-3"></div>
            <div class="col-8 col-sm-8 col-md-8 col-lg-6 col-xl-6">
                <h3 id="txt_alteraSenha">Alteração de senha</h3>
            </div>
        <div class="col-2 col-sm-2 col-md-2 col-lg-3 col-xl-3"></div>    
    </div>
   

    <div class="row">
        <div class="col-1 col-sm-2 col-md-2 col-lg-4 col-xl-4"></div>
             <div class="col-10 col-sm-8 col-md-8 col-lg-4 col-xl-4">
                <form action="recupera_senha.php" method="POST" id="formAlteraSenha">
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
                        <input type="hidden" name="funcao" value="<?= $_GET['executar']; ?>"/>
                        <input type="submit" class="main-btn btn btn-primary" id="submit" value="Alterar senha" disabled>
                    </div>                    
                </form>
            </div>            
        <div class="col-1 col-sm-2 col-md-2 col-lg-4 col-xl-4"></div>
    </div>
</div>  

<?php
        include("../include/rodape.php");
    ?>
</div>
</body>
</html>
