<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: ../public/index.php");
}
require("../database/usuario.php");
include("../include/navegacao.php");
require("../database/noticias.php");
require("../util/mensagens.php");
require("../util/formatacoes.php");

exibirMsg();
verificaSessao();

$id_noticia = $_POST["id_noticia"];
$noticias = buscarNoticia($id_noticia);
?>

<div class=" container">

    <div class="row">
        <div class="col-1">
        <a class="btn" href="site_externo_adm.php"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
        </div>
        <div class="col-11"></div>
    </div>
    <div class="row">
        <div class="col-3 col-sm-2 col-md-4 col-lg-4 col-xl-4"></div>
            <div class="col-6 col-sm-8 col-md-4 col-lg-4 col-xl-4">
                <h1  id="tituloNoticia">Edição:</h1>
            </div>
        <div class="col-3 col-sm-2 col-md-4 col-lg-4 col-xl-4"></div>
    </div>
    <div class="row">
        <div class="col-0 col-sm-0 col-md-2 col-lg-3 col-xl-3"></div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
            <fieldset id="formEditarNoticia">      
                  <form action="../src/editar_noticia.php" method="post" onsubmit="return confirmar_edicao_noticia(this)">
                  <input type="hidden" name="id_noticia" value="<?=$id_noticia?>">                             
                            <div class="row form">
                                <div class="form-group col-md-8">
                                    <label for="titulo_noticia">Título:</label>
                                    <input type="text" class="form-control"  name="titulo_noticia" id="titulo_noticia" value ='<?= $noticias["titulo_noticia"] ?>'>
                                </div>   
                                <div class="form-group col-md-4">
                                    <label for="data_noticia">Data da Notícia:</label>
                                    <input type="date" class="form-control"  name="data_noticia" id="data_noticia" value = '<?= $noticias["data_noticia"] ?>'>
                                </div> 
                            </div>    
                            
                            <div class="form-group">
                                <label for="url_noticia">URL:</label>
                                <input type="url" class="form-control"  name="url_noticia" id="url_noticia" value = ' <?= $noticias["url_noticia"] ?>'>
                            </div>   
        
                            <div class="form-group">
                                <label for="desc_noticia">Descrição da Notícia:</label>  
                                <textarea class="form-control" rows="5" id="desc_noticia" name="descricao_noticia" placeholder="Insira uma breve descrição da notícia..."><?= $noticias["descricao_noticia"] ?></textarea>
                            </div> 
                                
                            <div class="form-group">    
                                <button type="submit" value="Editar" class="btn btn-purple" id="botao_editar">Editar</button> 
                            </div>   
                    </form>
              </fieldset>                                       
            </div>
        <div class="col-0 col-sm-0 col-md-2 col-lg-3 col-xl-3"></div>         
    </div>   
      
      
</div>
<?php
    include("../include/rodape.php");  
?>
    <script src="../assets/js/script.js"></script> 
