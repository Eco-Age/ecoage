<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: ../public/index.php");
}

    include("../include/navegacao.php");
    require("../database/noticias.php");
    require("../util/mensagens.php");
    require("../util/formatacoes.php");

    exibirMsg();
    $lista_noticias = listarNoticia();
    
?>
        
<div class="container" id="conteudo">

        <div class="row">
            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                <a href="../src/portal_de_noticias.php" class="btn" id="voltar_adm"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
            </div>
            <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11"></div>
        </div>

        <div class="row">    
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>                
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h1 id="txt_portal2">Notícias:</h1>
                </div>
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        </div>
    
        <div class="row">
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <button type="button" class="btn btn-primary" id="btncadastrarnoticia" data-toggle="modal" data-target="#modal_noticias"> 
                        <span class="material-icons">
                            post_add
                        </span>
                    </button> 
                </div> 

                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <form action="../src/site_externo.php" class="form-inline">
                    <input class="form-control" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar" id="buscarNoticia">
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filtros2" aria-expanded="false" aria-controls="collapseExample" id="btn_filtros">
                        Filtros<span class="material-symbols-outlined" id="seta_filtro">arrow_drop_down</span>
                    </button>            
                    </form>
                </div> 
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
        </div> 

        <div class="row">
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                    <div class="collapse col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" id="filtros2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="filtros3_" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Em qualquer data
                            </button>
                                <div class="dropdown-menu" id="filtros_menu3" aria-labelledby="filtros_">
                                    <a class="dropdown-item" href="../src/site_externo.php">Na última hora</a>
                                    <a class="dropdown-item" href="../src/site_externo.php">Nas últimas 24 horas</a>
                                    <a class="dropdown-item" href="../src/site_externo.php">Na última semana</a>
                                    <a class="dropdown-item" href="../src/site_externo.php">No último mês</a>
                                    <a class="dropdown-item" href="../src/site_externo.php">No último ano</a>
                                </div>
                        </div>
                    </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"></div>
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
                                    <input type="text" class="form-control"  name="titulo_noticia" id="titulo_noticia" placeholder="Insira o título da notícia...">
                                </div>   
                                <div class="form-group col-6">
                                    <label for="data_noticia">Data da Notícia:</label>
                                    <input type="date" class="form-control"  name="data_noticia" id="data_noticia">
                                </div> 
                            </div>    
                            
                            <div class="form-group">
                                <label for="url_noticia">URL:</label>
                                <input type="url" class="form-control"  name="url_noticia" id="url_noticia" placeholder="Insira a URL da notícia...">
                            </div>   
        
                            <div class="form-group">
                                <label for="desc_noticia">Descrição da Notícia:</label>  
                                <textarea class="form-control" rows="5" id="desc_noticia" name="descricao_noticia" placeholder="Insira uma breve descrição da notícia..."></textarea>
                            </div> 
                                
                            <div class="form-group">    
                                <button type="submit" value="inserir" class="btn btn-primary col-md-12" id="botao_inserirnoticia" >Inserir</button> 
                            </div>   
                            </form>
                        </fieldset>       
                    </div>
                </div>
            </div>
        </div>


    <!-- Listar Noticias -->
    <div class="container mx-auto">
        <div class="row">
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <?php foreach ($lista_noticias as $noticias) : ?>
                        <div class="row"> 
                            <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11">
                                <a href="<?= $noticias["url_noticia"] ?>" target="_blank" class="link_site_externo">
                                    <fieldset  class="field_site_externo">
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
                            <div class="btns_noticias col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                <p>
                                    <form action="editando_noticia.php" method="post" style="display: inline-block;">
                                         <input type="hidden" name="id_noticia" value="<?=$noticias["id_noticia"]?>">
                                         <button style="cursor: pointer;" type="submit" class="btnedit" value="edit"><span class="material-icons" id="btneditNoticia">edit</span></button>
                                     </form>
                                 </p>
                                 <p>
                                     <button style="cursor: pointer;" class="btndelete" value="<?=$noticias["id_noticia"]?>" onclick="deletarNoticia(<?=$noticias['id_noticia']?>)">
                                         <span class="material-symbols-outlined" id="btndelete2">delete</span>
                                     </button>
                                 </p>
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