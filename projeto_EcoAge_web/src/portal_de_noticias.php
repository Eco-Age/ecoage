<?php
 session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
  include("../include/navegacao.php");  
?>
<div id="portal_de_noticias">

    <div class="row">
        <div class="col-4"></div>
            <div class="col-4">
                <h1 id="txt_portal">Portal de Notícias:</h1>
            </div>
        <div class="col-4"></div>
    </div>

        <div class="row">
            <div class="col-5"></div>
               
                    <form action="site_externo.php" class="form-inline">
                        <input class="form-control" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
                    </form>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filtros" aria-expanded="false" aria-controls="collapseExample" id="btn_filtros">
                    Filtros<span class="material-symbols-outlined" id="seta_filtro">arrow_drop_down</span>
                    </button> 
            <div class="col-5"></div>
        </div> 

        <div class="row">
        <div class="col-5"></div>
            <div class="collapse" id="filtros">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="filtros_" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Em qualquer data
                    </button>
                        <div class="dropdown-menu" aria-labelledby="filtros_">
                            <a class="dropdown-item" href="site_externo.html">Na última hora</a>
                            <a class="dropdown-item" href="site_externo.html">Nas últimas 24 horas</a>
                            <a class="dropdown-item" href="site_externo.html">Na última semana</a>
                            <a class="dropdown-item" href="site_externo.html">No último mês</a>
                            <a class="dropdown-item" href="site_externo.html">No último ano</a>
                        </div>
                </div>
            </div>
        <div class="col-5"></div>
        </div>
                      
      <div class="row">
            <div class="col-2"></div>
            <div id="carrosel" class="carousel slide col-8 " data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carrosel" data-slide-to="0" class="active"></li>
                <li data-target="#carrosel" data-slide-to="1"></li>
                <li data-target="#carrosel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="https://g1.globo.com/pop-arte/moda-e-beleza/noticia/2022/02/24/lixoes-texteis-as-imagens-que-mostram-como-a-industria-pode-ser-toxica-ao-meio-ambiente.ghtml"><img class="img_carrosel d-block w-100" src="../assets/noticia1.jpg" alt="Primeiro Slide"></a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Lixões textêis</h5>
                            <p>As imagens que mostram como a indústria pode ser tóxica ao meio ambiente...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <a href="https://blog.etiquetaunica.com.br/o-impacto-da-industria-da-moda-no-meio-ambiente/"><img class="img_carrosel d-block w-100" src="../assets/noticia2.jpeg" alt="Segundo Slide"></a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Meio Ambiente</h5>
                            <p>O Impacto da Indústria da Moda na nossa atmosfera...</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <a href="https://blogfca.pucminas.br/colab/fast-fashion-meio-ambiente/"><img class="img_carrosel d-block w-100" src="../assets/noticia3.jpg" alt="Terceiro Slide"></a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Fast fashion</h5>
                            <p>Fast fashion e os impactos no meio ambiente...</p>
                        </div>
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
    <?php
        include("../include/rodape.php");
    ?>
</body>
</html>
