<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: ../public/index.php");
}

   include("../include/cabecalho.php");
   include("../include/navegacao.php");
?>
        
        <div class="container">

        <div class="row">
            <div class="col-1">
                <button class="btn" onclick="voltaratencao()" id="voltar_adm"><span class="material-icons" id="icone_voltar_noticias">reply</span></button>
            </div>
            <div class="col-7"></div>
            <div class="col-4">
                <button class="btn" onclick="confirmarvisaousu_noticia()" id="visaousu_noticias">
                    Visualizar como usuário<span class="material-symbols-outlined" id="visao_usu">visibility</span>
                </button>            
            </div>
            <div class="col-0"></div>
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
                            <form action="site_externo_adm.php" method="post">
                        
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
                                <textarea class="form-control" rows="5" id="desc_noticia" name="desc_noticia" placeholder="Insira uma breve descrição da notícia..."></textarea>
                            </div> 
                                
                            <div class="form-group">    
                                <button type="submit" value="inserir" class="btn btn-primary col-md-12" id="botao_inserirnoticia" onclick="inserirnoticia()">Inserir</button> 
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
                        <a href="https://santaceciliaresiduos.com.br/moda-meio-ambiente/#:~:text=Nosso%20lixo%20t%C3%AAxtil%2C%20consequ%C3%AAncia%20da,de%20desperd%C3%ADcio%20de%20%C3%A1gua%20globalmente." target="_blank" class="link_site_externo" target="_blank">
                            <fieldset class="field_site_externo">
                                <h3>Qual o impacto da moda no meio ambiente?</h3>
                                <p>https://santaceciliaresiduos.com.br</p>
                                <p>Nosso lixo têxtil, consequência da lógica da moda descartável, leva cerca de 200 anos para se desintegrar.
                                    E as consequência dessa indústria de fast fashion vai além do descarte. 
                                    De acordo com relatório da ONU responsável por 20% do total de desperdício de água globalmente.
                                </p>
                            </fieldset>
                        </a>
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
                        <a href="https://wp.ufpel.edu.br/empauta/um-efeito-borboleta-a-industria-da-moda-e-meio-ambiente/" target="_blank" class="link_site_externo">
                            <fieldset class="field_site_externo">
                                <h3>Um efeito borboleta: a indústria da moda e meio-ambiente</h3>
                                <p>https://wp.ufpel.edu.br ›</p>
                                <p>Quando se fala no impacto ambiental da indústria da moda se fala muito mais que apenas na extração de matérias-primas, mas também no consumo de ...</p>
                            </fieldset>
                        </a>
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
                        <a href="https://noticias.r7.com/tecnologia-e-ciencia/qual-e-o-impacto-que-nossas-roupas-causam-ao-meio-ambiente-01122021" target="_blank" class="link_site_externo">
                            <fieldset class="field_site_externo">
                                <h3>Qual é o impacto que nossas roupas causam ao meio ambiente?</h3>
                                <p>https://noticias.r7.com ›</p>
                                <p>O consumo excessivo e rápido de peças de roupa, que surge do padrão de produção do fast-fashion (moda rápida), é cada vez mais nocivo para o ...</p>
                            </fieldset>
                        </a>
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