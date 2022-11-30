<?php
require("../database/tipo_tecidos.php");
require("../database/usuario.php");
include("../include/cabecalho.php");
include("../include/navegacao.php");

$lista_tipo_tecidos = listarTipoTecidos();
?>
<div class="container">
    <div class="row">
            <div class="col-1">
                <a class="btn" href="tecidos_adm.php"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
            </div>
            <div class="col-11"></div>
    </div>
    <h1  id="tituloTecido" >Tecido</h1>
    <div class="row">          
        <div class="col-4"></div>
        <div class="col-4">
            <fieldset>      
                <form action="../src/cadastrar_tecido.php" method="post">                 
                    <div class="form-group">
                        <label for="id_tipo_tecidos"></label>
                            <select name="id_tipo_tecidos" id="id_tipo_tecidos" class="form-control">
                                <?php foreach ($lista_tipo_tecidos as $tipo_tecido) : ?>
                                    <option value='<?=$tipo_tecido["id_tipo_tecidos"]?>'>
                                        <?=$tipo_tecido["nome_tecidos"]?>
                                    </option>
                                <?php endforeach ?>
                            </select> 
                    </div>                         
        
                    <div class="form-group">
                        <label for="desc_tecidos">Descrição do Tecido:</label>  
                        <textarea class="form-control" rows="5" id="desc_tecidos" name="desc_tecidos"></textarea>
                    </div> 

                    <div class="form-group" id="checkbox"> 
                        <input type="checkbox" class="form-check-input" id="sustentavel" name="sustentavel">
                        <label class="form-check-label" for="sustentavel">Sustentável?</label> 
                    </div>                    
                    
                    <div class="form-group">    
                        <button type="submit" value="inserir" class="btn btn-primary" id="botao_inserir">Inserir</button>  
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
    