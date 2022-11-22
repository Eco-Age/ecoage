<?php
  session_start();

  if(!isset($_SESSION["apelido_logado"]) && !isset($_SESSION["nome_logado"]) && !isset($_SESSION["id_usuario"])){
    header("Location: ../public/index.php");
  }
  include("../include/navegacao.php");  
?>  
  <main class="container">
  <?php 
            if (isset($_SESSION["apelido_logado"])) { ?>
              <p class="alert-success nav-link" id="logado">Logado como <?= $_SESSION["apelido_logado"] ?></p>
  <?php } ?>
    <div id="apresentacao_home">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-2">
                    <img src="../assets/Ana_avatar.png" id="Ana_img">
            </div>
            <div class="col-4" id="texto_inicial_ana">
                <p >Oiii, bem vindo(a) <?= $_SESSION["nome_logado"] ?>! Eu sou a Ana!
                    Este site foi desenvolvido como Trabalho de Conclusão de Curso do IFSP - Câmpus Araraquara.
                </p>
            </div>
            <div class="col-3"></div>
        </div> 
        
        <div class="row">
            <div class="col-3"></div>
            <div class="col-4" id="texto_inicial_edu">     
                <p >Olá, eu sou o Edu! 
                    O Eco Age busca a conscientização quanto aos impactos dos tecidos no meio ambiente.
                </p>
            </div>
            <div class="col-2">
                <img src="../assets/Edu_avatar.png" id="Edu_img">
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-2">
                    <img src="../assets/Gabi_avatar.png" id="Gabi_img">
            </div>
            <div class="col-4" id="texto_inicial_gabi">
                <p >Eai, eu sou a Gabi! 
                    Aqui você poderá estar antenado nas últimas notícias sustentáveis do mundo fashion, se divertir jogando e muito mais!
                </p>
            </div>   
            <div class="col-3"></div>     
        </div>
    </div>  
</main>

<?php
        include("../include/rodape.php");
  ?>
<script src="assets/script.js"></script>
</body>
</html>
