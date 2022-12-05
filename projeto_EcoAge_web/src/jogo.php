<?php

session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 
    include("../include/navegacao.php");
?>
<main class="container">
<div id="jogo">

    <div class="row">
        <div class="col-4"></div>
                <h1 class="col-4" id="txt_portal">Guess the Tissue:</h1>
        <div class="col-4"></div>
    </div>
    
  <div class="row">
        <div class="col-2"></div>
        <div id="carrosel" class="carousel slide carousel-fade col-8 " data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carrosel" data-slide-to="0" class="active"></li>
            <li data-target="#carrosel" data-slide-to="1"></li>
            <li data-target="#carrosel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img_carrosel_jogo" src="../assets/jogo1.png" alt="Primeiro Slide">
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>

                <div class="carousel-item">
                    <img class="img_carrosel_jogo" src="../assets/jogo2.png" alt="Segundo Slide">
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>

                <div class="carousel-item">
                    <img class="img_carrosel_jogo" src="../assets/jogo3.png" alt="Terceiro Slide">
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>

                <div class="carousel-item">
                    <img class="img_carrosel_jogo" src="../assets/jogo4.png" alt="Quarto Slide">
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>

                <div class="carousel-item">
                    <img class="img_carrosel_jogo" src="../assets/jogo5.png" alt="Quinto Slide">
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>
            </div>
        
                <a class="carousel-control-prev" href="#carrosel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
                </a>

                <a class="carousel-control-next" href="#carrosel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
                </a>
        </div>
      <div class="col-2"></div>
    </div>  
</div>
</main>
<footer class="footer navbar-fixed bottom" id="rodape">
<div class="area_contato">
    <div class="container">
        <div id="row">
            <div class="col-md-12">
                <h5 class="main-title">Entre em contato conosco:</h5>
            </div>
        </div>
        <div class="col-md-12 contact-box">
            <span class="contact-title material-symbols-outlined">mail</span><p>Envie um e-mail: ecoage@gmail.com</p>
        </div>
    </div>
</div>

</div>
<div id="copy-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Desenvolvido por <a href="sobre_nos.html" id="sobre_nos">Ana Beatriz, Eduardo e Gabrielle</a> &copy; ecoage.com.br 2022</p>
            </div>
        </div>
    </div>
</div>
</footer>
</body>
</html>
