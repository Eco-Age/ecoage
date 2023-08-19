<?php
require_once("../database/usuario.php");
require_once("../util/mensagens.php");
include("../include/navegacao.php");
require("../database/noticias.php");
require("../util/formatacoes.php");

exibirMsg();
verificaSessao();

if ($_SESSION["tipo_usuario"] == 1) {
    header("Location: ../src/site_externo_adm.php");
}

$chave_sessao = $_SESSION["id_usuario"];

$itens_por_pagina = 3;

$palavra_chave = isset($_SESSION["palavra_chave"]) ? $_SESSION["palavra_chave"] : '';
if (isset($_GET['palavra_chave'])) {
    $palavra_chave = $_GET['palavra_chave'];
}
$total_resultados = contarNoticias($palavra_chave);

$paginas = ceil($total_resultados / $itens_por_pagina);

$pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

if ($pagina_atual < 1) {
    $pagina_atual = $paginas;
} elseif ($pagina_atual > $paginas) {
    $pagina_atual = $paginas;
}

$lista_noticias = listarNoticiasPaginacao($palavra_chave, $pagina_atual, $itens_por_pagina);

?>

<div class="container" id="conteudo">

    <div class="row">
        <div class="col-3 col-sm-3 col-md-1 col-lg-1 col-xl-1">
            <a class="btn" href="portal_de_noticias.php"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
        </div>
        <div class="col-9 col-sm-9 col-md-11 col-lg-11 col-xl-11"></div>
    </div>

    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h1 id="txt_portal2">Notícias:</h1>
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
    </div>

    <div class="row">
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
            <div class="col-6 col-sm-6 col-md-12 col-lg-12 col-xl-12" style="margin: auto">  
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
                </form>
            </div>
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
    </div>
        
    <?php foreach ($lista_noticias as $noticias) : ?>
        <div class="row">
            <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11" style="margin:auto">
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

    <?php if ($total_resultados > 0) : ?>
        <ul class="pagination justify-content-center">
            <?php if ($pagina_atual > 1) : ?>
                <li class="page-item">
                    <a class="numeracao btn page-link" href="?pagina=<?= $pagina_atual - 1 ?>&palavra_chave=<?= urlencode($palavra_chave) ?>" aria-label="Anterior">
                        <span aria-hidden="true">&#8249;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php endif ?>

            <?php
            $max_numeros_pagina = 5; // Quantidade máxima de números de página exibidos
            $paginas = ceil($total_resultados / $itens_por_pagina); // Calcula o número total de páginas

            $inicio = max(1, $pagina_atual - floor($max_numeros_pagina / 2));
            $fim = min($inicio + $max_numeros_pagina - 1, $paginas);

            for ($i = $inicio; $i <= $fim; $i++) : ?>
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
    <?php endif ?>

</div>
<?php
include("../include/rodape.php");
?>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/script_valida_form.js"></script>
<script>
    let id_usuario_curtida = "<?= $_SESSION["id_usuario"]; ?>";
</script>
</html>