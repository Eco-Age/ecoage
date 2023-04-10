<?php
require_once("../database/usuario.php");
require_once("../util/mensagens.php");
include("../include/navegacao.php");
require("../database/noticias.php");
require("../util/formatacoes.php");

exibirMsg();
verificaSessao();

$palavra_chave = $_SESSION["palavra_chave"];
$lista_noticias = buscarPalavraChave($palavra_chave);

if ($_SESSION["id_usuario"] == 1) {
    header("Location: ../src/site_externo_adm.php");
}
?>

<div class="container" id="conteudo">

    
    
    <div class="row">
        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
            <a class="btn" href="portal_de_noticias.php"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
        </div>
        <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11"></div>
    </div>
    
<div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h1 id="txt_portal2">Notícias:</h1>
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
    </div>
    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <form id="form_busca" action="buscarNoticia.php" class="form-inline" method="post">
                <input class="form-control" name="palavra_chave" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
                <div class="form-group">
                    <label for="filtro"></label>
                    <select class="form-control" id="filtro" name="filtro">
                        <option value="">Em qualquer data</option>
                        <option value="ultima_hora">Na última hora</option>
                        <option value="ultimas_24h">Nas últimas 24 horas</option>
                        <option value="ultima_semana">Na última semana</option>
                        <option value="ultimo_mes">No último mês</option>
                        <option value="ultimo_ano">No último ano</option>
                        <option value="mais_antigo">Mais antigo</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit" name="buscar"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        </div>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <?php foreach ($lista_noticias as $noticias) : ?>
                        <div class="row">
                            <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11">
                                <a href="<?= $noticias["url_noticia"] ?>" target="_blank" class="link_site_externo">
                                    <fieldset class="field_site_externo">
                                        <div>
                                            <h3 id="titulo_noticia" name="titulo_noticia"><?= $noticias["titulo_noticia"] ?></h3>
                                        </div>
                                        <div>
                                            <p id="data_noticia" name="data_noticia"><?= formata_data_pagina($noticias["data_noticia"]) ?></p>
                                        </div>
                                        <div>
                                            <p id="descricao_noticia" name="descricao_noticia"><?= $noticias["descricao_noticia"] ?></p>
                                        </div>
                                        <div>
                                            <p id="url_noticia" name="url_noticia">Clique para saber mais...</p>
                                        </div>
                                    </fieldset>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>                    
                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
            </div>
        </div>
</div>
<?php
include("../include/rodape.php");
?>
<script src="../assets/script.js"></script>
</body>

</html>