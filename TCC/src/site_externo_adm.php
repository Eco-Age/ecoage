<?php
require_once("../database/usuario.php");
require_once("../util/mensagens.php");
include("../include/navegacao.php");
require("../database/noticias.php");
require("../util/formatacoes.php");

verificaSessao();

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

if ($pagina_atual < 1) {
    $pagina_atual = 1;
} elseif ($pagina_atual > $paginas) {
    $pagina_atual = $paginas;
}

$lista_noticias = listarNoticiasPaginacao($palavra_chave, $pagina_atual, $itens_por_pagina);
   
?>


<div class="container" id="conteudo">

    <?php
        exibirMsg();
    ?>

    <div class="row">
        <div class="col- col-sm-3 col-md-1 col-lg-1 col-xl-1">
            <a href="../src/portal_de_noticias.php" class="btn" id="voltar_adm"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
        </div>
        <div class="col-9 col-sm-9 col-md-11 col-lg-11 col-xl-11"></div>
    </div>

    <div class="row">
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="txt_portal2">
                <h1 >Notícias:</h1>
            </div>
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
    </div>


    
    <div class="row">   
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
            <div class="col-6 col-sm-6 col-md-12 col-lg-12 col-xl-12" style="margin: auto">     
                <form id="form_busca" action="buscarNoticia.php" class="form-inline" method="post">
                    <!-- Botão pra abrir modal de cadastrar noticias-->
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btncadastrarnoticia" data-toggle="modal" data-target="#modal_noticias">
                            <span class="material-icons" id="iconCadastrarNot">
                                post_add
                            </span>
                        </button>
                    </div>

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

    
    <!-- Modal de cadastro das noticias !-->
    <div class="modal fade modal_noticias" id="modal_noticias" tabindex="-1" role="dialog" aria-labelledby="modal_noticias" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_noticias">Cadastro de Notícia:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <form action="../src/cadastrar_noticia.php" method="post">

                            <div class="form-row">
                                <div class="form-group col-6 ">
                                    <label for="titulo_noticia">Título:</label>
                                    <input type="text" class="form-control" name="titulo_noticia" id="titulo_noticia" placeholder="Insira o título da notícia...">
                                </div>
                                <div class="form-group col-6">
                                    <label for="data_noticia">Data da Notícia:</label>
                                    <input type="date" class="form-control" name="data_noticia" id="data_noticia">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url_noticia">URL:</label>
                                <input type="url" class="form-control" name="url_noticia" id="url_noticia" placeholder="Insira a URL da notícia...">
                            </div>

                            <div class="form-group">
                                <label for="desc_noticia">Descrição da Notícia:</label>
                                <textarea class="form-control" rows="5" id="desc_noticia" name="descricao_noticia" placeholder="Insira uma breve descrição da notícia..."></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" value="inserir" class="btn btn-primary col-md-12" id="botao_inserirnoticia">Inserir</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <!-- Listar Noticias -->
    <div class="row justify-content-center">
        <?php foreach ($lista_noticias as $noticias) : ?>
            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
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
            <div class="btns_noticias col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                <p>
                <form action="editando_noticia.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="id_noticia" value="<?= $noticias["id_noticia"] ?>">
                    <button style="cursor: pointer;" type="submit" class="btnedit" value="edit"><span class="material-icons" id="btneditNoticia">edit</span></button>
                </form>
                </p>
                <p>
                    <button style="cursor: pointer;" class="btndelete" value="<?= $noticias["id_noticia"] ?>" onclick="deletarNoticia(<?= $noticias['id_noticia'] ?>)">
                        <span class="material-symbols-outlined" id="btndelete2">delete</span>
                    </button>
                </p> 
            </div>
        <?php endforeach ?>        
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

<?php
include("../include/rodape.php");
?>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/script_valida_form.js"></script>
<script>
    let id_usuario_curtida = "<?= $_SESSION["id_usuario"]; ?>";
</script>
</body>

</html>