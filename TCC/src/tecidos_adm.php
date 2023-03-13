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

<div class="container" id="conteudo">

<div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <h1 id="txt_tecidos">Tecidos:</h1>
        </div>
        <div class="col-4"></div>
    </div>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
        <button type="button" class="btn btn-primary col-8" id="btncadastrartecido" data-toggle="modal" data-target="#modalCadastrarTecido"> 
            <span class="material-symbols-outlined">
            post_add
            </span>        
        </button>
        </div>
        <div class="col-4"></div>
    </div>

    <!-- Modal Cadastro de Tecidos -->

    <div class="modal fade" id="modalCadastrarTecido" tabindex="-1" role="dialog" aria-labelledby="cadastroTecido" aria-hidden="true">
                 <div class="modal-dialog modal-lg" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="cadastroTecido">Cadastro de tecido:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                        <fieldset id="formCadastrarTecido">      
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
                                  <textarea class="form-control" rows="5" id="desc_tecidos" name="desc_tecidos" placeholder="Descreva o tecido..."></textarea>
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
                    <div style="text-center; margin-left: 30px; margin-top: 20px;">
                      <input type="checkbox" class="form-check-input" name="sustentavel" <?=$sustentavel?> disabled>Sustentável?
                    </div>
                    <br>
                    <h4 class="card-title">
                    <form action="editando_tecido.php" method="get" style="display: inline-block;">
                        <input type="hidden" name="id_tecidos" value="<?=$tecido["id_tecidos"]?>">
                        <button style="cursor: pointer;" type="submit" class="btnedit" value="edit" ><span class="material-icons" id="btneditTecido">edit</span></button>
                    </form>
                  
                    <button style="cursor: pointer;" class="btndelete" data-toggle="modal" data-target="#confirm" >
                        <span class="material-symbols-outlined" id="btndelete2">delete</span>
                    </button>
  
                    <div class="modal fade" id="confirm" role="dialog">
                      <div class="modal-dialog modal-md">

                        <div class="modal-content">
                          <div class="modal-body">
                                <p style="font-size: 18px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Deseja mesmo excluir o tecido? Cuidado: Esta ação não pode ser desfeita.</p>
                          </div>
                
                          <div class="modal-footer">
                            <form action="remover_tecido.php" method="POST" style="display: inline-block;">
                              <input type="hidden" name="id_tecidos" value=<?=$tecido['id_tecidos']?> />
                                <button type="submit" class="btn btn-danger" id="delete" name="remover_tecido">Apagar Tecido</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                            </form>   
                          </div> 

                        </div>  
                      </div>
                    </div>
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
</div>
<?php
    include ("../include/rodape.php");
?>
<script src="../assets/script.js"></script>
</body>
</html>
