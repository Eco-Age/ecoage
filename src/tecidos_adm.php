<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: ../public/index.php");
}
include("../include/navegacao.php");
require("../database/tipo_tecidos.php");
require("../database/tecidos.php");

$lista_tipo_tecidos = listarTipoTecidos();
$lista_tecidos = listarTecidos();


?>
<div class="container">

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
        <button type="button" class="btn btn-primary col-8" id="btnnovaconta" data-toggle="modal" data-target="#modal_tecidos"> 
            Cadastrar Tecido
        </button>        
        </div>
        <div class="col-4"></div>
    </div>

    <div class="modal fade modal_tecidos" id="modal_tecidos" tabindex="-1" role="dialog" aria-labelledby="modal_tecidos" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="modal_tecidos">Novo tecido:</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <fieldset>      
                           <form action="../src/cadastrar_tecido.php" method="post">
                             
                           <div class="form-group">
                            <label for="id_tipo_tecidos">Tecido:</label>
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
                   </div>
                 </div>
               </div>

 <?php /*   <div class="row">
        <div class="col-1"></div>
            
        <div class="card col-3">
            <?php
                foreach ($lista_tecidos as $tecido) :
            ?>
                    <img class="card-img-top" src="../assets/tecido.png" alt="Imagem de capa do card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $tecido["nome_tecidos"] ?></h5>
                            <?php
                                $sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
                            ?>
                            <h4 class="card-title"> 
                                <input type="checkbox" class="form-check-input" name="sustentavel" <?=$sustentavel?> disabled> 
                            </h4>
                            <p class="card-text">Você conquistou esse tecido!</p>
                            <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Saber mais...</a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card-body">
                                        <?= $tecido["desc_tecidos"] ?>                                    
                                    </div>
                                </div>
                        </div>
                        <?php
                            endforeach
                        ?>
                    </div>
        */ ?>
        <?php
            foreach ($lista_tecidos as $tecido) :
        ?>

        <div class="row" id="tecidos">
            <div id="tecido1_usu">
                    <img id="imgtecido1"class="card-img-top" src="../assets/tecido.png" alt="Poliéster">
                <p>
                    <h5><?= $tecido["nome_tecidos"] ?></h5>
                        <p>Voce conquistou esse tecido!</p>
                        <?php
                            $sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
                        ?>
                        <a class="btn btn-primary" id="" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                        Saiba mais..
                        </a>
                        <h4 class="card-title"> 
                            <input type="checkbox" class="form-check-input" name="sustentavel" <?=$sustentavel?> disabled> 
                        </h4>
                </p>
                  
                <div class="collapse" id="collapse1">
                    <div class="card card-body"  id="card1">
                        <?= $tecido["desc_tecidos"] ?>          
                    </div>
                </div>
            </div>
            <div  id="tecido2_usu">
                <img id="imgtecido2" class="card-img-top" src="../assets/tecido_bloqueado.png" alt="Algodão">
                    <p>
                        <h5>Algodão</h5>
                            <p>Jogue para desbloquear esse tecido</p>
                            <a class="btn btn-secondary" data-toggle="" href="" role="" aria-expanded="" aria-controls="">
                            Saiba mais..
                            </a>                   
                    </p>
            </div>
            <div id="tecido3_usu">
                <img id="imgtecido3" class="card-img-top" src="../assets/tecido_bloqueado.png" alt="Linho">
                    <p>
                        <h5>Linho</h5>
                            <p>Jogue para desbloquear esse tecido</p>
                            <a class="btn btn-secondary" data-toggle="" href="" role="" aria-expanded="" aria-controls="">
                            Saiba mais..
                            </a>
                  </p>
            </div>
        </div>
        <?php endforeach ?>    
    </div>
</div>
<?php
    include ("../include/rodape.php");
?>
