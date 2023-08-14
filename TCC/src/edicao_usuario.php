<?php
require("../database/usuario.php");
include_once("../database/avatar.php");
include("../include/navegacao.php");
include("../util/formatacoes.php");
include("../util/mensagens.php");


verificaSessao();

if (isset($_SESSION["id_usuario"]) && isset($_SESSION["idAvatar"])) {
    $id_usuario = $_SESSION["id_usuario"];
    $id_avatar = $_SESSION["idAvatar"];
}
$lista_avatar = listarAvatar();
$avatar = buscarAvatar();
$usuario = buscarUsuarioLogado($id_usuario);
$email = $usuario["email"];
if(isset($_SESSION["email"])){
    $_SESSION["email"] = $email;
}

$verifica = buscaVerifica($email);
$verifica_int = intval($verifica['verifica']);

$avatar_atual = buscarAvatarUsado($id_usuario);
?>
<div class="container" id="conteudo">

    <?php
        exibirMsg();
    ?>

    <div class="row">
        <div class="col-1 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
        <h4 class="col-10 col-sm-8 col-md-8 col-lg-8 col-xl-8" id="meus_dados">Meus dados:</h4>
        <div class="col-1 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
    </div>

    <div class="row">
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8" style="margin: auto">
            <fieldset id="field_edicao_usuario">

                <legend id="legend_avatar"><img id="avatarEdicao" src="<?= $avatar_atual['caminho'] ?>" alt="<?= $_SESSION['idAvatar'] ?>"></legend>
                <form action="../src/editar_usuario.php" method="post" onsubmit=" return validacao(this)">
                    <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                    <input type="hidden" name="email_atual" value="<?= $usuario["email"] ?>">
                    <input type="hidden" name="apelido_atual" value="<?= $usuario["apelido"] ?>">
                    <input type="hidden" name="tipo_usuario" value="<?= $usuario["tipo_usuario"] ?>">


                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" id="nome" name="nome_completo" class="form-control" value="<?= $usuario["nome_completo"] ?>" disabled>
                        <div class="erro-preencher" id="nome_completo_erro"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="data_nasc">Data de Nascimento:</label>
                            <input type="date" id="data_nasc" name="data_nasc" class="form-control" value="<?= $usuario["data_nasc"] ?>" disabled>
                            <div class="erro-preencher" id="data_nasc_erro"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tel">Telefone:</label>
                            <input type="text" class="form-control" name="tel" id="tel" value="<?= $usuario["tel"] ?>" autocomplete="on" disabled>
                            <div class="erro-preencher" id="tel_erro"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="apelido">Apelido:</label>
                        <input type="text" id="apelido" name="apelido" class="form-control" value="<?= $usuario["apelido"] ?>" disabled>
                        <div class="erro-preencher" id="apelido_erro"></div>
                    </div>

                    <div class="form-group">
                        <label for="email_cadastro">Email:</label>
                        <input type="text" id="email_cadastro" name="email_cadastro" class="form-control" value="<?= $usuario["email"] ?>" disabled><br>
                        <div class="erro-preencher" id="email_erro"></div>
                        <button onclick="window.location.href='verificacao_email_atrasada.php'" style="display: none;" type="button" class="btn btn-purple" id="verificar_email" disabled>Verificar email</button>
                    </div>


                    <div class="form-group">
                        <p>Selecione o seu avatar: </p>
                        <div class="avatar-container">
                            <?php foreach ($lista_avatar as $avatar) :
                                $estaSelecionado = $usuario["id_avatar"] == $avatar["id_avatar"];
                                $atributoSelected = $estaSelecionado ? "checked='checked'" : "";
                            ?>
                                <input class="avatar-radio" type="radio" id="avatar<?= $avatar["id_avatar"] ?>" name="id_avatar" value="<?= $avatar["id_avatar"] ?>" <?= $atributoSelected ?> disabled>
                                <label for="avatar<?= $avatar["id_avatar"] ?>">
                                    <img src="<?= $avatar["caminho"] ?>" alt="<?= $avatar["nome"] ?>">
                                </label>
                            <?php endforeach ?>
                            <?php
                            $avatarEditado =  $avatar["id_avatar"];
                            $caminhoEditado =  $avatar["caminho"];

                            $_SESSION["caminhoAvatar"] =   $caminhoEditado;
                            $_SESSION["idAvatar"] = $avatarEditado;
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="botao_editar_usuario" onclick="habilitarCampos()">Editar</button>
                        <input type="submit" value="Salvar alterações" name="salvar" class="btn btn-primary" id="botao_salvar_alteracoes" disabled/>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
    </div>
</div>
<?php
include("../include/rodape.php");
?>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/script_valida_form.js"></script>
<script>
    function habilitarCampos() {
        // Tornar os campos editáveis
        document.getElementById("nome").removeAttribute("disabled");
        document.getElementById("data_nasc").removeAttribute("disabled");
        document.getElementById("tel").removeAttribute("disabled");
        document.getElementById("apelido").removeAttribute("disabled");
        document.getElementById("email_cadastro").removeAttribute("disabled");
        document.getElementById("verificar_email").removeAttribute("disabled");
        $(document).ready(function () {
            $(".avatar-radio").removeAttr("disabled");
        });   
        document.getElementById("botao_salvar_alteracoes").removeAttribute("disabled");
        document.getElementById("botao_editar_usuario").setAttribute("disabled", "true");

    }

    var verifica = "<?= $verifica_int; ?>";
    if (verifica == 1) {
        document.getElementById("verificar_email").style.display = "none";
    } else {
        document.getElementById("verificar_email").style.display = "block";
    }
</script>


</html>