<?php
      require("../database/usuario.php");
      include_once('../database/avatar.php');
      include("../include/navegacao.php");
      include("../util/mensagens.php");
      include("../util/formatacoes.php");  

      exibirMsg();
      verificaSessao();


  $apelido= $_SESSION["apelido_logado"];

  if (isset($_SESSION["email"])){
    $email = $_SESSION["email"];
  }
  $verifica = buscaVerifica($email);
  $verifica_int = intval($verifica['verifica']);

    if(isset($_SESSION["id_usuario"]) && isset($_SESSION["idAvatar"])){
    $id_usuario = $_SESSION["id_usuario"];
    $id_avatar = $_SESSION["idAvatar"];
  }
    $lista_avatar = listarAvatar();
    $avatar = buscarAvatar();
    $usuario = buscarUsuarioLogado($id_usuario);
    $avatar_atual = buscarAvatarUsado($id_usuario);
?>
<div class="container" id="conteudo">
    <div class="row">
        <div class="col-4"></div>
            <h4 class="col-4" id="meus_dados">Meus dados:</h4>
          
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-3"></div>
                <fieldset class="col-6"id="field_edicao_usuario">        
                    <div class="">
                        <p>Altere o tema de cores: </p>
                        <input onclick="alternarModo()" type="checkbox" id="alternar-modoescuro"/>
                        <label id="labelModoEscuro" for="alternar-modoescuro">
                            <i id="solIcon" class="fa-regular fa-light fa-sun fa-sm"></i>
                            <i id="luaIcon" class="fas fa-moon fa-sm"></i>
                        </label>
                    </div>
                <legend id="legend_avatar" ><img id="avatarMenu" src="<?=$avatar_atual['caminho']?>" alt="<?=$_SESSION['idAvatar']?>"></legend>
                    <form action="../src/editar_usuario.php" method="post" onsubmit=" return validacao(this)">
                        <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
                        <input type="hidden" name="email_atual" value="<?=$email?>">
                        <input type="hidden" name="apelido_atual" value="<?=$apelido?>">

                        <div class="form-group">
                            <label for="nome" id="nome">Nome Completo:</label> 
                            <input type="text" id="nome" name="nome_completo" class="form-control" value="<?=$usuario["nome_completo"]?>">
                            <div class="erro-preencher" id="nome_completo_erro"></div>
                        </div>
                                    
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="data_nasc" id="data_nasc">Data de Nascimento:</label> 
                                <input type="date" id="data_nasc" name="data_nasc" class="form-control" value="<?=$usuario["data_nasc"]?>">
                                <div class="erro-preencher" id="data_nasc_erro"></div>
                            </div> 
                            <div class="form-group col-md-6">
                                <label for="tel">Telefone:</label>
                                <input type="text" class="form-control" name="tel" id="tel" value="<?=$usuario["tel"]?>">
                                <div class="erro-preencher" id="tel_erro"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="apelido" id="apelido_cadastro">Apelido:</label> 
                            <input type="text" id="apelido" name="apelido" class="form-control" value="<?=$usuario["apelido"]?>">
                            <div class="erro-preencher" id="apelido_erro"></div>
                        </div> 
                                    
                        <div class="form-group">
                                <label for="email_cadastro" id="email_cadastro">Email:</label> 
                                <input type="text" id="email_cadastro" name="email_cadastro" class="form-control" value="<?=$usuario["email"]?>"><br>
                                <div class="erro-preencher" id="email_erro"></div>
                                <button onclick="window.location.href='verificacao_email_atrasada.php'" style="display: none;" type="button" class="btn btn-purple" id="verificar_email">Verificar email</button>  
                        </div> 
                          
                           <div class="form-group">
                             <label>Selecione o seu avatar:</label><br>    
                                <div class="avatar-container">
                                <?php foreach ($lista_avatar as $avatar) : 
                                    $estaSelecionado = $usuario["id_avatar"] == $avatar["id_avatar"];
                                    $atributoSelected = $estaSelecionado ? "checked='checked'" : ""; 
                                ?>
                                    <input class="avatar-radio" type="radio" id="avatar<?=$avatar["id_avatar"]?>" name="id_avatar" value="<?=$avatar["id_avatar"]?>" <?=$atributoSelected?>>
                                    <label for="avatar<?=$avatar["id_avatar"]?>">
                                        <img src="<?=$avatar["caminho"]?>" alt="<?=$avatar["nome"]?>">
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
                           <div>
                        <div class="form-group">    
                            <button type="submit" value="inserir" class="btn btn-primary" id="botao_editar_usuario">Editar</button> 
                        </div> 
 
                                <!-- < ? php escolha_avatar()  ?>                                                             -->
                  </div>   
                           
                    </form>
                          
                       
                </fieldset>  
        <div class="col-3"></div>

       

    </div>
</div>
<?php
      include("../include/rodape.php");
?>
<script src="../assets/script.js"></script>
<script>
  var verifica = "<?= $verifica_int; ?>";
  if (verifica == 1){
    document.getElementById("verificar_email").style.display = "none";
  }else {
    document.getElementById("verificar_email").style.display = "block";
  }
</script>
<script src="../assets/script_valida_form.js"></script>
</body> 
</html>
