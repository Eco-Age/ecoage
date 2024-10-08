<?php
require ("../database/usuario.php");
include("../include/navegacao.php");
require("../database/tipo_tecidos.php");
require("../database/tecidos.php");
require("../util/mensagens.php");

exibirMsg();
verificaSessao();

$chave_sessao = $_SESSION["id_usuario"];

$lista_tipo_tecidos = listarTipoTecidos();

$itens_por_pagina = 3;

$total_tecidos = contarTecidos();

$paginas = ceil($total_tecidos / $itens_por_pagina);

$pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$lista_tecidos = listarTecidosPaginacao($pagina_atual, $itens_por_pagina);

?>


<div class="container" id="conteudo">

    <div class="row">
      <h1 class="col-lg-12 text-center" id="txt_tecidos">Tecidos:</h1>
    </div>
    
    <div class="container-fluid">
    
    <div class="row">
      <div class="col-md-4 col-lg-4"></div>
      <div class="col-md-4 col-lg-4 col-xs-12">
        <button type="button" class="btn btn-primary" id="btncadastrartecido" data-toggle="modal" data-target="#modalCadastrarTecido">
          <span class="material-symbols-outlined">post_add</span>
        </button>
      </div>
      <div class="col-md-4 col-lg-4"></div>
    </div>

    <div class="row">
      <div class="col-4 col-md-4 d-flex justify-content-left">
        <button type="button" class="btn-purple-circulo quiz-btn" onclick="quiz()">
          <i class="fa fa-1x fa-gamepad"></i>
        </button>
      </div>
      <div class="col-4 col-md-4"></div>
      <div class="col-4 col-md-4">
        <div class="d-flex justify-content-end">
          <button type="button" class="btn-purple-circulo" onclick="ajudaTecido()">
            <i class="fa fa-1x fa-question-circle"></i>
          </button>
         </div>
        </div>           
      </div>
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
            <form action="../src/cadastrar_tecido.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="id_tipo_tecidos">Tecido:</label>
                <select name="id_tipo_tecidos" id="id_tipo_tecidos" class="form-control">
                  <?php foreach ($lista_tipo_tecidos as $tipo_tecido) : ?>
                    <option value='<?= $tipo_tecido["id_tipo_tecidos"] ?>'>
                      <?= $tipo_tecido["nome_tecidos"] ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="composicao">Composição:</label>
                <input type="text" id="composicao" name="composicao" class="form-control" placeholder="Informe a composição do tecido..." >
              </div>
              <div class="form-group">
                <label for="producao">Produção:</label>
                <input type="text" id="producao" name="producao" class="form-control" placeholder="Detalhe a produção do tecido..." >
              </div>
              <div class="form-group">
                <label for="meioambiente">Relação com o meio ambiente:</label>
                <input type="text" id="meioambiente" name="meioambiente" class="form-control" placeholder="Informe a relação do meio ambiente..." >
              </div>
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/jpg, image/jpeg, image/png, image/bmp, image/webp" id="imagem_tecido" name="imagem_tecido" aria-describedby="inputGroupFileAddon">
                    <label class="custom-file-label file-selected" for="imagem_tecido" id="inputGroupFileAddon">Escolha uma imagem</label>
                  </div>
                </div>  
                <div class="form-group" id="checkbox"> 
                  <input type="checkbox" class="form-check-input" id="sustentavel" name="sustentavel">
                  <label class="form-check-label" for="sustentavel">Sustentável?</label> 
                </div>                      
                <div class="form-group">    
                  <button type="submit" value="inserir" class="btn btn-primary" id="botao_inserir_tecido">Inserir</button>  
                </div>   
            </form>
          </fieldset>       
        </div>
      </div>
    </div>
  </div>

  
  <div class="row justify-content-center" id="tecidos">
    <?php foreach ($lista_tecidos as $tecido) : ?>
        <div class="tecido col-10 col-sm-8 col-md-4 col-lg-3 mb-3">
            <div class="">
                <img class="card-img-top" src="data:image/jpeg;base64,<?=$tecido["caminho_imagem"]?>" alt="<?=$tecido["nome_tecidos"]?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $tecido["nome_tecidos"] ?></h5>
                    <p class="card-text">Vamos aprender sobre o tecido?</p>
                    <a class="btn saibamais" id="saibamais<?= $tecido["id_tecidos"] ?>" data-toggle="collapse" href="#collapse<?= $tecido["id_tecidos"] ?>" role="button" aria-expanded="false" aria-controls="collapse<?= $tecido["id_tecidos"] ?>">
                        Saiba mais..
                    </a>
                    <?php
                        $sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
                    ?>
                    <div style="margin-top: 20px; text-align: center;">
                        <?php if ($tecido["sustentavel"]) : ?>
                            <span class="bg-success text-white d-inline-block px-2 py-1 rounded">
                                <i class="fa-solid fa-sm fas fa-check"></i> É sustentável
                            </span>
                        <?php else : ?>
                            <span class="bg-danger text-white d-inline-block px-2 py-1 rounded">
                                <i class="fa-solid fa-sm fas fa-ban"></i> <p class="d-inline mb-0">Não é sustentável</p>
                            </span>
                        <?php endif ?>
                    </div>
                    <br>
                    <form action="editando_tecido.php" method="get" style="display: inline-block;">
                        <input type="hidden" name="id_tecidos" value="<?=$tecido["id_tecidos"]?>">
                        <button style="cursor: pointer;" type="submit" class="btnedit" value="edit" ><span class="material-icons" id="btneditTecido">edit</span></button>
                    </form>
                    <button style="cursor: pointer;" class="btndelete" value="<?=$tecido["id_tecidos"]?>" onclick="deletarTecido(<?=$tecido['id_tecidos']?>)">
                        <span class="material-symbols-outlined" id="btndelete2">delete</span>
                    </button>
                </div>
                <div class="collapse" id="collapse<?= $tecido["id_tecidos"] ?>">
                    <div class="card-body">
                        <span class="destaque2">Composição:</span>
                        <p><?= $tecido["composicao"] ?></p>
                        <span class="destaque2">Produção:</span>
                        <p><?= $tecido["producao"] ?></p>
                        <span class="destaque2">Relação com o meio ambiente:</span>
                        <p><?= $tecido["meioambiente"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>    
  </div>



  
        <ul class="pagination justify-content-center">
            <?php if ($pagina_atual > 1) : ?>
                <li class="page-item">
                    <a class="numeracao btn page-link" href="?pagina=<?= $pagina_atual - 1 ?>" aria-label="Anterior">
                        <span aria-hidden="true">&#8249;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php endif ?>

            <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                <li class="page-item <?php if ($pagina_atual == $i) echo 'active' ?>">
                    <a class="numeracao btn page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor ?>

            <?php if ($pagina_atual < $paginas) : ?>
                <li class="page-item">
                    <a class="numeracao btn page-link" href="?pagina=<?= $pagina_atual + 1 ?>" aria-label="Próximo">
                        <span aria-hidden="true">&#8250;</span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>

        
</div>
<?php
    include ("../include/rodape.php");
?>


<script>
  var chave_sessao = "<?php echo $chave_sessao; ?>";
              
    // pra mostrar o nome da imagem qnd envia no input file
    document.querySelector('#imagem_tecido').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var label = document.querySelector('.file-selected');
    label.innerText = fileName;
  });
</script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/script_quiz.js"></script>
</html>