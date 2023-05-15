<?php
require ("../database/usuario.php");
include("../include/navegacao.php");
require("../database/tipo_tecidos.php");
require("../database/tecidos.php");
require("../util/mensagens.php");

exibirMsg();
verificaSessao();

if ($_SESSION["id_usuario"] == 1) {
    header("Location: ../src/tecidos_adm.php");
}

$chave_sessao = $_SESSION["id_usuario"];
$lista_tipo_tecidos = listarTipoTecidos();

// Define o número de itens por página
$itens_por_pagina = 3;

// Obtém o número total de tecidos
$total_tecidos = contarTecidos();

// Obtém o número total de páginas
$paginas = ceil($total_tecidos / $itens_por_pagina);

// Obtém o número da página atual
$pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Obtém os tecidos da página atual
$lista_tecidos = listarTecidosPaginacao($pagina_atual, $itens_por_pagina);

?>



<div class="container" id="conteudo">
    

    <div class="row">
        <h1 class="col-lg-12 text-center" id="txt_tecidos">Tecidos:</h1>
    </div>
    
    <div class="container-fluid">
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
    

    <div class="row justify-content-center" id="tecidos">
        <?php foreach ($lista_tecidos as $tecido) : ?>
            <div id="tecido_usu" class="tecido col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                <p>
                <img id="imgtecido1" class="card-img-top" src="data:image/jpeg;base64,<?=$tecido["caminho_imagem"]?>" alt="<?=$tecido["nome_tecidos"]?>">
                    <h5><?= $tecido["nome_tecidos"] ?></h5>
                    <p>Vamos aprender sobre o tecido?</p>
                    <a class="btn btn-purple" data-toggle="collapse" href="#collapse<?= $tecido["id_tecidos"] ?>" role="button" aria-expanded="false" aria-controls="collapse<?= $tecido["id_tecidos"] ?>">
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
                </p>
                <div class="collapse" id="collapse<?= $tecido["id_tecidos"] ?>">
                    <div class="card card-body" id="card<?= $tecido["id_tecidos"] ?>" style="max-height: 500px; overflow-y: scroll;">
                        <?= $tecido["desc_tecidos"] ?>
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

<?php include("../include/rodape.php"); ?>
<script>
  var chave_sessao = "<?php echo $chave_sessao; ?>";

    // pra mostrar o nome da imagem qnd envia no input file
    document.querySelector('#imagem_tecido').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var label = document.querySelector('.file-selected');
    label.innerText = fileName;
  });
</script>
<script src="../assets/script.js"></script>
<script src="../assets/script_quiz.js"></script>
</body>
</html>