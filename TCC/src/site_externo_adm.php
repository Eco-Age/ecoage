<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: ../public/index.php");
}

   include("../include/navegacao.php");
?>
        
        <div class="container" id="conteudo">

        <div class="row">
            <div class="col-1">
                <a href="../src/portal_de_noticias.php" class="btn" id="voltar_adm"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
            </div>
            <div class="col-11"></div>
        </div>

        <div class="row">    
            <div class="col-3"></div>                
                <div class="col-6">
                    <h1 id="txt_portal2">Notícias:</h1>
                </div>
            <div class="col-3"></div>
        </div>
    
        <div class="row">
            <div class="col-4"></div>
                <button type="button" class="btn btn-primary"id="btncadastrarnoticia" data-toggle="modal" data-target="#modal_noticias"> 
                    <span class="material-icons">
                        post_add
                    </span>
                </button> 
                  
                <form action="../src/site_externo.php" class="form-inline">
                    <input class="form-control" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filtros2" aria-expanded="false" aria-controls="collapseExample" id="btn_filtros">
                    Filtros<span class="material-symbols-outlined" id="seta_filtro">arrow_drop_down</span>
                </button>            
                </form> 
            <div class="col-4"></div>
        </div> 

        <div class="row">
            <div class="col-4"></div>
                <div class="collapse" id="filtros2">
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
            <div class="col-4"></div>
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
                                <div class="form-group col-md-8">
                                    <label for="titulo_noticia">Título:</label>
                                    <input type="text" class="form-control"  name="titulo_noticia" id="titulo_noticia" placeholder="Insira o título da notícia...">
                                </div>   
                                <div class="form-group col-md-4">
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



    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10" id="todos_field_adm">
            
                <div class="row">
                    <div class="col-md-10">
                       
                    </div>
                    <div class="btns_noticias col-md-2">
                        <p>
                            <button class="btnedit" onclick="editarnoticia()">
                                <span class="material-symbols-outlined" id="btnedit1">
                                    edit
                                </span>
                            </button>
                        </p>
                        <p>
                            <button class="btndelete" onclick="excluirnoticia()">
                                <span class="material-symbols-outlined" id="btndelete1">
                                    close
                                </span>
                            </button>
                        </p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">
                       
                    </div>
                    <div class="btns_noticias col-md-2">
                        <p>
                            <button class="btnedit" onclick="editarnoticia()">
                                <span class="material-symbols-outlined" id="btnedit1">
                                    edit
                                </span>
                            </button>
                        </p>
                        <p>
                            <button class="btndelete" onclick="excluirnoticia()">
                                <span class="material-symbols-outlined" id="btndelete1">
                                    close
                                </span>
                            </button>
                        </p>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="btns_noticias col-md-2">
                        <p>
                            <button class="btnedit" onclick="editarnoticia()">
                                <span class="material-symbols-outlined" id="btnedit1">
                                    edit
                                </span>
                            </button>
                        </p>
                        <p>
                            <button class="btndelete" onclick="excluirnoticia()">
                                <span class="material-symbols-outlined" id="btndelete1">
                                    close
                                </span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-0"></div>
        </div>
    </div>
        </div>
<?php
    include("../include/rodape.php");  
?>
<script src="../assets/script.js"></script>
</body>
</html>