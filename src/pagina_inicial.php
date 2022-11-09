<?php
  session_start();

  if(!isset($_SESSION["apelido_logado"]) && !isset($_SESSION["nome_logado"]) && !isset($_SESSION["id_usuario"])){
    header("Location: ../public/index.php");
  }
  include("../include/navegacao.php");  
?>
<div class="container">
  <?php 
            if (isset($_SESSION["apelido_logado"])) { ?>
              <p class="alert-success nav-link" id="logado">Logado como <?= $_SESSION["apelido_logado"] ?></p>
  <?php } ?>
  <h3 id="bemvindoo">Bem vindo(a) <?= $_SESSION["nome_logado"] ?>!</h3>
</div>
    <?php
        include("../include/rodape.php");
    ?>

</body>
</html>

