<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: ../public/index.php");
}
include("../include/navegacao.php");
require("../database/tipo_tecidos.php");
require("../database/tecidos.php");
require("../util/mensagens.php");

exibirMsg();

$id_tecidos = $_GET["id_tecidos"];
$tecido = buscarTecido($id_tecidos);
$sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
$lista_tipo_tecidos = listarTipoTecidos();

?>

<div class="container">
    <div class="row">
    <div class="col-1">
      <a class="btn" href="tecidos_adm.php"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
    </div>
    <div class="col-11"></div>
  </div>
    <div class="row">
        <div class="col-4"></div>
            <div class="col-4">
                <h1  id="tituloTecido" >Edição:</h1>
            </div>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-4"></div>
            <div class="col-4">
                <fieldset id="formEditarTecido">      
                        <form action="editar_tecido.php" method="post" onsubmit="return confirmar_edicao_tecido(this)">
                            <input type="hidden" name="id_tecidos" value="<?=$id_tecidos?>">                             
                            
                            <div class="form-group">        
                                <label for="id_tipo_tecidos"></label>
                                <select name="id_tipo_tecidos" id="id_tipo_tecidos" class="form-control">                                    
                                    <?php foreach ($lista_tipo_tecidos as $tipo_tecido) : 
                                        $estaSelecionado = $tecido["id_tipo_tecidos"] == $tipo_tecido["id_tipo_tecidos"];
                                        $atributoSelected = $estaSelecionado ? "selected='selected'" : ""; 
                                    ?>
                                    <option value="<?=$tipo_tecido["id_tipo_tecidos"]?>" <?=$atributoSelected?>>
                                        <?=$tipo_tecido["nome_tecidos"]?>
                                    </option>
                                    <?php endforeach ?>
                                </select> 
                            </div>                         
                                        
                            <div class="form-group">
                                <label for="desc_tecidos">Descrição do Tecido:</label>  
                                <textarea class="form-control" rows="5" id="desc_tecidos" name="desc_tecidos"><?=$tecido["desc_tecidos"]?></textarea>
                            </div> 

                            <div class="form-group" id="checkbox"> 
                                <input type="checkbox" class="form-check-input" id="sustentavel" name="sustentavel" <?=$sustentavel?>>
                                <label class="form-check-label" for="sustentavel">Sustentável?</label> 
                            </div>  
                                                                
                            <div class="form-group">    
                                <button type="submit" value="Editar" class="btn btn-primary" id="botao_editar">Editar</button> 
                            </div>   
                        </form>
                </fieldset>                                       
            </div>
        <div class="col-4"></div>         
    </div>
      
</div>
<?php
    include("../include/rodape.php");  
?>
    <script src="../assets/script.js"></script> 
</body>
</html>