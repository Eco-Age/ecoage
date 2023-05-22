<?php
require_once("../database/usuario.php");
require_once("../util/mensagens.php");
include("../include/navegacao.php");
require("../database/noticias.php");
require("../util/formatacoes.php");

exibirMsg();
verificaSessao();

if ($_SESSION["id_usuario"] == 1) {
    header("Location: ../src/site_externo_adm.php");
}

$chave_sessao = $_SESSION["id_usuario"];

// Define o número de itens por página
$itens_por_pagina = 3;

// Obtem a palavra-chave da sessão
$palavra_chave = isset($_SESSION["palavra_chave"]) ? $_SESSION["palavra_chave"] : '';
if (isset($_GET['palavra_chave'])) {
    $palavra_chave = $_GET['palavra_chave'];
}
// Obtém o número total de resultados da pesquisa
$total_resultados = contarNoticias($palavra_chave);

// Obtém o número total de páginas
$paginas = ceil($total_resultados / $itens_por_pagina);

// Obtém o número da página atual
$pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;


// Verifique se a página atual está dentro dos limites
if ($pagina_atual < 1) {
    $pagina_atual = 1;
} elseif ($pagina_atual > $paginas) {
    $pagina_atual = $paginas;
}

// Busque as notícias com base na palavra-chvae e nos limites
$lista_noticias = listarNoticiasPaginacao($palavra_chave, $pagina_atual, $itens_por_pagina);

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
                <input class="form-control" name="palavra_chave" id="palavra_chave" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
                <div class="form-group">
                    <label for="filtro"></label>
                    <select class="form-control" id="filtro" name="filtro">
                        <option value="">Em qualquer data</option>
                        <option value="ultimas_24h">Nas últimas 24 horas</option>
                        <option value="ultima_semana">Na última semana</option>
                        <option value="ultimo_mes">No último mês</option>
                        <option value="ultimo_ano">No último ano</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit" name="buscar" id="btnBusca"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div class="erro-preencher" id="palavra_chave_erro"></div>
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
                            <fieldset class="field_site_externo">
                                <a href="<?= $noticias["url_noticia"] ?>" target="_blank" class="link_site_externo">
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
                                </a>
                                <div class="text-right mr-2">
                                    <?php $curtiu = VerificaCurtida($noticias['id_noticia'], $id_usuario); ?>
                                    <span class="icone-curtir <?= $curtiu ? 'curtiu' : '' ?>" data-noticia="<?= $noticias['id_noticia'] ?>">
                                        <i class="fa-heart <?= $curtiu ? 'fa-solid' : 'fa-regular' ?>" style="<?= $curtiu ? 'color: #ff0000;' : '' ?>"></i>
                                    </span>
                                    <span class="contar-likes"><?= $noticias["curtidas"] ?></span>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
        </div>
        <ul class="pagination justify-content-center">
            <?php if ($pagina_atual > 1) : ?>
                <li class="page-item">
                    <a class="numeracao btn page-link" href="?pagina=<?= $pagina_atual - 1 ?>&palavra_chave=<?= urlencode($palavra_chave) ?>" aria-label="Anterior">
                        <span aria-hidden="true">&#8249;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php endif ?>

            <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                <li class="page-item <?php if ($pagina_atual == $i) echo 'active' ?>">
                    <a class="numeracao btn page-link" href="?pagina=<?= $i ?>&palavra_chave=<?= urlencode($palavra_chave) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor ?>

            <?php if ($pagina_atual < $paginas) : ?>
                <li class="page-item">
                    <a class="numeracao btn page-link" href="?pagina=<?= $pagina_atual + 1 ?>&palavra_chave=<?= urlencode($palavra_chave) ?>" aria-label="Próximo">
                        <span aria-hidden="true">&#8250;</span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
</div>
<?php
include("../include/rodape.php");
?>
<script src="../assets/script.js"></script>
<script src="../assets/script_valida_form.js"></script>
<script>
    let id_usuario_curtida = "<?= $_SESSION["id_usuario"]; ?>";
</script>
</body>

</html>