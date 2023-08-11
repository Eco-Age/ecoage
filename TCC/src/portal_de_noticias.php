<?php
require_once("../database/usuario.php");
require_once("../util/mensagens.php");
require_once("../database/noticias.php");
include("../include/navegacao.php");

exibirMsg();
verificaSessao();
$chave_sessao = $_SESSION["id_usuario"];
$lista_noticias = maisCurtidas();
$imagens = ["../assets/img/noticia1.jpg", "../assets/img/noticia2.jpeg", "../assets/img/noticia3.jpg"]
?>
<div class="container" id="portal_de_noticias">

    <div class="row">
        <div class="col-2 col-sm-2 col-md-2 col-lg-3 col-xl-3"></div>
            <div class="col-8 col-sm-8 col-md-8 col-lg-6 col-xl-6">
                <h1 id="txt_portal">Portal de Notícias:</h1>
            </div>
        <div class="col-2 col-sm-2 col-md-2 col-lg-3 col-xl-3"></div>
        <div class="container-fluid">
        <div class="row">
            <div class="col-4 col-md-4 d-flex justify-content-left">
               
            </div>
            <div class="col-4 col-md-4"></div>
            <div class="col-4 col-md-4">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-purple-circulo" onclick="ajudaNoticia()">
                    <i class="fa fa-1x fa-question-circle"></i>
                    </button>
                </div>
            </div>           
        </div>
    </div>
    </div>

    <div class="row" id="buscarnoticia">
        <div class="col-3 col-sm-2 col-md-2 col-lg-3 col-xl-3"></div>
        <div class="col-6 col-sm-8 col-md-8 col-lg-6 col-xl-6">
            <form id="form_busca" action="buscarNoticia.php" class="form-inline" method="post">
                <input class="form-control" name="palavra_chave" id="palavra_chave" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
              
                <div class="form-group">
                    <label for="filtro"></label>
                    <select class="selectFiltro form-control" id="filtro" name="filtro">
                        <option value="">Em qualquer data</option>
                        <option value="ultimas_24h">Nas últimas 24 horas</option>
                        <option value="ultima_semana">Na última semana</option>
                        <option value="ultimo_mes">No último mês</option>
                        <option value="ultimo_ano">No último ano</option>
                    </select>
                </div> 
                <button class="btn btn-primary" type="submit" name="buscar" id="btnBusca"><i class="fa-solid fa-magnifying-glass"></i></button> 
                <div class="erro-preencher" id="palavra_chave_erro"></div>
            </form>
        </div>
        <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
    </div>

    <div class="row">
        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
            <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                <div id="carrosel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carrosel" data-slide-to="0" class="active"></li>
                        <li data-target="#carrosel" data-slide-to="1"></li>
                        <li data-target="#carrosel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($lista_noticias as $index => $noticia) : ?>
                            <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                <a href="<?= $noticia['url_noticia'] ?>" target="_blank">
                                    <img class="img_carrosel d-block w-100" src="<?= $imagens[$index] ?>" alt="Primeiro Slide">
                                </a>
                                <div class="carousel-caption">
                                    <h5><?= $noticia['titulo_noticia'] ?></h5>
                                    <p><?= $noticia['descricao_noticia'] ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <a class="carousel-control-prev" href="#carrosel" role="button" data-slide="prev">
                        <div class="carroselControlIntrod">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#carrosel" role="button" data-slide="next">
                        <div class="carroselControlIntrod">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </div>
                    </a>
                </div>
            </div>
        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
    </div>
</div>
<?php
include("../include/rodape.php");
?>
<script>
  var chave_sessao = "<?php echo $chave_sessao; ?>";
</script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/script_valida_form.js"></script>
</body>

</html>