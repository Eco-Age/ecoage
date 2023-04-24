<?php

include("../include/navegacao.php");
require("../database/usuario.php");
require("../database/tipo_tecidos.php");
require("../database/tecidos.php");
require("../util/mensagens.php");
verificaSessao();
exibirMsg();

$id_tecidos = $_GET["id_tecidos"];
$tecido = buscarTecido($id_tecidos);
$sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
$lista_tipo_tecidos = listarTipoTecidos();

$imagem_atual = basename($tecido['caminho_imagem']);

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
            <h1 id="tituloTecido">Edição:</h1>
        </div>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <fieldset id="formEditarTecido">
                <form action="editar_tecido.php" method="post" enctype="multipart/form-data" onsubmit="return confirmar_edicao_tecido(this)">
                    <input type="hidden" name="id_tecidos" value="<?= $id_tecidos ?>">

                    <div class="form-group">
                        <label for="id_tipo_tecidos"></label>
                        <select name="id_tipo_tecidos" id="id_tipo_tecidos" class="form-control">
                            <?php foreach ($lista_tipo_tecidos as $tipo_tecido) :
                                $estaSelecionado = $tecido["id_tipo_tecidos"] == $tipo_tecido["id_tipo_tecidos"];
                                $atributoSelected = $estaSelecionado ? "selected='selected'" : "";
                            ?>
                                <option value="<?= $tipo_tecido["id_tipo_tecidos"] ?>" <?= $atributoSelected ?>>
                                    <?= $tipo_tecido["nome_tecidos"] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <label>Imagem ATUAL do Tecido:</label><br>
                        <input type="hidden" name="nome_imagem_original" value="<?= $tecido["caminho_imagem"]; ?>">
                        <?php if ($tecido['caminho_imagem']) : ?>
                            <img class="mx-auto" src="<?= $tecido['caminho_imagem'] ?>" alt="Imagem do tecido" width="150">
                            <small style="font-variant:small-caps; " class="form-text text-muted">Se nenhuma nova imagem for enviada, a atual será mantida</small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/jpg, image/jpeg, image/png, image/bmp, image/webp" id="imagem_tecido" name="imagem_tecido" aria-describedby="inputGroupFileAddon">
                                <label class="custom-file-label file-selected" for="imagem_tecido" id="inputGroupFileAddon">Escolha uma nova imagem</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desc_tecidos">Descrição do Tecido:</label>
                        <textarea class="form-control" rows="5" id="desc_tecidos" name="desc_tecidos"><?= $tecido["desc_tecidos"] ?></textarea>
                    </div>

                    <div class="form-group" id="checkbox">
                        <input type="checkbox" class="form-check-input" id="sustentavel" name="sustentavel" <?= $sustentavel ?>>
                        <label class="form-check-label" for="sustentavel">Sustentável?</label>
                    </div>

                    <div class="form-group">
                        <button type="submit" value="Editar" class="btn btn-purple" id="botao_editar">Editar</button>
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
<script>
    document.querySelector('#imagem_tecido').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = document.querySelector('.file-selected');
        label.innerText = fileName;
    });

    let imagem_atual = "<?= $imagem_atual ?>";
    document.getElementById("inputGroupFileAddon").innerText = imagem_atual
</script>

</body>

</html>