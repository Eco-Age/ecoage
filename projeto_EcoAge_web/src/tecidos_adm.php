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
            <h1 id="txt_tecidos">Tecidos:</h1>
        </div>
        <div class="col-4"></div>
    </div>

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <a class="btn" id="btncadastrartecido" href="inserir_tecido.php">Cadastrar Tecido</a>
        </div>
        <div class="col-4"></div>
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
    <script src="../assets/script.js"></script>
</div>
<?php
    include ("../include/rodape.php");
?>
