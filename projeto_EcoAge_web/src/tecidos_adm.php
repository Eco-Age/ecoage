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

$lista_tipo_tecidos = listarTipoTecidos();
$lista_tecidos = listarTecidos();
?>
<div class="container">

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
        <a class="btn col-8" id="btncadastrartecido" href="inserir_tecido.php">Cadastrar Tecido</a>
        </button>        
        </div>
        <div class="col-4"></div>
    </div>

    <!-- <div class="modal fade modal_tecidos" id="modal_tecidos" tabindex="-1" role="dialog" aria-labelledby="modal_tecidos" aria-hidden="true">
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
               </div> -->

        <div class="row" id="tecidos">
        
        <?php
            foreach ($lista_tecidos as $tecido) :
        ?>  
        <div id="tecido1_usu">
 
            <p>
            <img id="imgtecido1" class="card-img-top" src="../assets/tecido.png" alt="Poliéster">
                <p>
                    <h5><?= $tecido["nome_tecidos"] ?></h5>
                        <p>Voce conquistou esse tecido!</p>
                       
                        <a class="btn btn-primary" id="" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                        Saiba mais..
                        </a>
                          <?php
                              $sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
                          ?>
                      <div style="text-center; margin-left: 30px;">
                        <input type="checkbox" class="form-check-input" name="sustentavel" <?=$sustentavel?> disabled>    
                      </div>
                      <br>
                        <h4 class="card-title">
                        <form action="editando_tecido.php" method="get" style="display: inline-block;">
                            <input type="hidden" name="id_tecidos" value="<?=$tecido["id_tecidos"]?>">
                            <button type="submit" class="btnedit" value="edit" ><span class="material-icons" id="btneditTecido">edit</span></button>
                        </form>
                        <form action="remover_tecido.php" method="POST" style="display: inline-block;">
                            <input type="hidden" name="id_tecidos" value=<?=$tecido['id_tecidos']?> />
                                <button class="btndelete" type="submit" name="remover_tecido">
                                    <span class="material-symbols-outlined" id="btndelete2">delete</span>
                                </button>
                        </form>
                

    
                </p>  
                <div class="collapse" id="collapse1">
                    <div class="card card-body"  id="card1">
                        <?=$tecido["desc_tecidos"] ?>          
                    </div>
                </div>
            </p>
            </div>
        <?php endforeach ?>    
    </div>
    <script src="../assets/script.js"></script>
</div>
<?php
    include ("../include/rodape.php");
?>
