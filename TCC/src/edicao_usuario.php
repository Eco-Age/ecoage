<?php
      require("../database/usuario.php");
      include_once('../database/avatar.php');
      include("../include/navegacao.php");
      include("../util/mensagens.php");
      include("../util/formatacoes.php");  

exibirMsg();

    if(isset($_SESSION["id_usuario"]) && isset($_SESSION["idAvatar"])){
    $id_usuario = $_SESSION["id_usuario"];
    $id_avatar = $_SESSION["idAvatar"];
  }
    $lista_avatar = listarAvatar();
    $avatar = buscarAvatar($id_avatar);
    $usuario = buscarUsuarioLogado($id_usuario);
    $avatar_atual = buscarAvatarUsado($id_usuario);
?>
<div class="container">
    <div class="row">
        <div class="col-4"></div>
            <h4 class="col-4" id="meus_dados">Meus dados:</h4>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <div class="col-3"></div>
                <fieldset class="col-6"id="field_edicao_usuario">      
                <legend id="legend_avatar" ><img id="avatarMenu" src="<?=$avatar_atual['caminho']?>" alt="<?=$_SESSION['idAvatar']?>"></legend>
                    <form action="../src/editar_usuario.php" method="post">
                        <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">

                        <div class="form-group">
                            <label for="nome" id="nome">Nome Completo:</label> 
                            <input type="text" id="nome" name="nome_completo" class="form-control" value="<?=$usuario["nome_completo"]?>">
                        </div>
                                    
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="data_nasc" id="data_nasc">Data de Nascimento:</label> 
                                <input type="date" id="data_nasc" name="data_nasc" class="form-control" value="<?=$usuario["data_nasc"]?>">
                            </div> 
                            <div class="form-group col-md-6">
                                <label for="tel">Telefone:</label>
                                <input type="text" class="form-control" name="tel" id="tel" value="<?=$usuario["tel"]?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="apelido" id="apelido_cadastro">Apelido:</label> 
                            <input type="text" id="apelido" name="apelido" class="form-control" value="<?=$usuario["apelido"]?>">
                        </div> 
                                    
                        <div class="form-group">
                            <label for="email_cadastro" id="email_cadastro">Email:</label> 
                            <input type="text" id="email_cadastro" name="email_cadastro" class="form-control" value="<?=$usuario["email"]?>">
                        </div> 

                          
                           <div class="form-group">
                             <label>Selecione o seu avatar:</label><br>    
                              
                                <?php foreach ($lista_avatar as $avatar) : 
                                    $estaSelecionado = $usuario["id_avatar"] == $avatar["id_avatar"] ;
                                    $atributoSelected = $estaSelecionado ? "checked='checked'" : ""; 
                                ?>

                                 <input type="radio" name="id_avatar" value="<?=$avatar["id_avatar"]?>"<?=$atributoSelected?>>
                                 <img id="avatarRadio" src="<?=$avatar["caminho"]?>" alt="<?=$avatar["nome"]?>">

                                <?php endforeach ?> 
                                
                                <?php
                              
                                    $avatarEditado =  $avatar["id_avatar"];
                                    $caminhoEditado =  $avatar["caminho"];


                                    $_SESSION["caminhoAvatar"] =   $caminhoEditado;
                                    $_SESSION["idAvatar"] = $avatarEditado;
                                
                                    
                                ?>
                  
                           </div>
                           <div>
                          
                           <div class="modal fade" id="modalconfirmarSenha" tabindex="-1" role="dialog" aria-labelledby="confirme_senha" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirme_senha">Confirme sua senha atual:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../src/editar_usuario.php" method="post">                             
                                    <div class="form-group">
                                        <label for="confirmar_senha" id="confirmar_senha">Senha:</label> 
                                        <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" placeholder="Digite a senha aqui" required>
                                    </div>
                                    <div class="form-group">    
                                        <button type="submit" value="enviar" class="btn btn-primary" id="botao_inserir">Confirmar</button> 
                                    </div>   
                                    </form>
                                </div>
                                </div>
                             </div>
                            </div>
                       
                        
                        <div class="form-group">    
                            <button type="submit" value="inserir" class="btn btn-primary" onclick="botao_Editar(event)" id="botao_editar_usuario">Editar</button> 
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
</body> 
</html>
