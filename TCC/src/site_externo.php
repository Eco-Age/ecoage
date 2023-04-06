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
    

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 if ($_SESSION["id_usuario"] == 1){
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
            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>                
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h1 id="txt_portal2">Notícias:</h1>
                </div>
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        </div>
    
        <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <form action="../src/site_externo.php" class="form-inline">
                <input class="form-control" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">        
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filtros" aria-expanded="false" aria-controls="collapseExample" id="btn_filtros">
                        Filtros<span class="material-symbols-outlined" id="seta_filtro">arrow_drop_down</span>
                    </button>
                </form> 
            </div>
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        </div> 

        <div class="row">
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                <div class="collapse col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3" id="filtros">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="filtros_" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Em qualquer data
                        </button>
                            <div class="dropdown-menu" id="filtros_menu2" aria-labelledby="filtros_">
                                <a class="dropdown-item" href="../src/site_externo.php">Na última hora</a>
                                <a class="dropdown-item" href="../src/site_externo.php">Nas últimas 24 horas</a>
                                <a class="dropdown-item" href="../src/site_externo.php">Na última semana</a>
                                <a class="dropdown-item" href="../src/site_externo.php">No último mês</a>
                                <a class="dropdown-item" href="../src/site_externo.php">No último ano</a>
                            </div>
                    </div>
                </div>
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
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
                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                </div>  
            </div>
        </div>
    </div>
<?php
    include("../include/rodape.php");  
?>
<script src="../assets/script.js"></script>
</body>
</html>
