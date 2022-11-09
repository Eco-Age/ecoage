<?php
 session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
  include("../include/navegacao.php");  
?>
<div class="container">
    <div class="col-12">
        <h3>Dúvidas frequentes</h3>
        <p>P: Como acesso o jogo? <br>
           R: Basta clicar no ícone de um controle na barra de navegação.
        </p>
        <p>P: Como faço para jogar? <br>
           R: Verificar tutorial na página do jogo.
        </p>
        <p>P: Como altero minha senha? <br>
           R: Para modificar sua senha basta ir ao seu perfil na barra de navegação, alterar sua senha e salvar as alterações.
        </p>
        <p>P: Esqueci a senha, e agora? <br>
           R: Clique na opção "esqueci minha senha" no formulário de login.
        </p><br>
       
    </div>
    <div class="col-12">

        <h3>Ainda precisa de ajuda?</h3>
        <h5>Envie-nos sua dúvida!</h5>

        <form action="recebe_duvidas.php" method="POST">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="E-mail" name="email_ajuda">
                <small id="emailHelp" class="form-text text-muted">Seu e-mail não será compartilhado com ninguém.</small>
            </div>
            <div class="form-group"> 
                <input type="text" class="form-control" placeholder="Assunto" name="assunto_ajuda">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Sua dúvida..." name="duvida"></textarea>
            </div>
            <input type="submit" class="main-btn btn btn-primary" value="Enviar">
        </form>
    </div>
    
</div>
<?php
    include ("../include/rodape.php");
?>