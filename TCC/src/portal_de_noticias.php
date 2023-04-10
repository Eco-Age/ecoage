<?php
require_once("../database/usuario.php");
require_once("../util/mensagens.php");
include("../include/navegacao.php");

exibirMsg();
verificaSessao();
?>
<div class="container" id="portal_de_noticias">

    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h1 id="txt_portal">Portal de Notícias:</h1>
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
    </div>

    <div class="row" id="buscarnoticia">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <form id="form_busca" action="buscarNoticia.php" class="form-inline" method="post">
                <input class="form-control" name="palavra_chave" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
                <div class="form-group">
                    <label for="filtro"></label>
                    <select class=" form-control" id="filtro" name="filtro">
                        <option value="">Em qualquer data</option>
                        <option value="ultimas_24h">Nas últimas 24 horas</option>
                        <option value="ultima_semana">Na última semana</option>
                        <option value="ultimo_mes">No último mês</option>
                        <option value="ultimo_ano">No último ano</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit" name="buscar" id="btnBusca"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
    </div>
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
                    <a href="https://g1.globo.com/pop-arte/moda-e-beleza/noticia/2022/02/24/lixoes-texteis-as-imagens-que-mostram-como-a-industria-pode-ser-toxica-ao-meio-ambiente.ghtml" target="blank"><img class="img_carrosel d-block w-100" src="../assets/noticia1.jpg" alt="Primeiro Slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Lixões textêis</h5>
                        <p>As imagens que mostram como a indústria pode ser tóxica ao meio ambiente...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="https://blog.etiquetaunica.com.br/o-impacto-da-industria-da-moda-no-meio-ambiente/" target="blank"><img class="img_carrosel d-block w-100" src="../assets/noticia2.jpeg" alt="Segundo Slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Meio Ambiente</h5>
                        <p>O Impacto da Indústria da Moda na nossa atmosfera...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="https://blogfca.pucminas.br/colab/fast-fashion-meio-ambiente/" target="blank"><img class="img_carrosel d-block w-100" src="../assets/noticia3.jpg" alt="Terceiro Slide"></a>
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
<?php
include("../include/rodape.php");
?>
<script src="../assets/script.js"></script>
</body>

</html>