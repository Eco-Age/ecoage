<?php
  if (!isset($_SESSION)){
    session_start();
  }
require("../database/usuario.php");
require("../database/avatar.php");
include("../include/cabecalho.php");
include("../util/mensagens.php");
include("../util/formatacoes.php");  

$lista_avatar = listarAvatar();

?>
<div class="container-fluid" id="body_login">

  <?php
    exibirMsg();
    if (isset($_SESSION["email_recuperar"]) && (time() - intval($_SESSION['email_recuperar']) > 1800)){
      unset($_SESSION["email_recuperar"]);
    }
  ?>
    
  <body>
    <div id="login_i">
      <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-3 col-xl-4"></div>
          <div class="col-sm-8 col-md-8 col-lg-6 col-xl-4">
            <fieldset id="forms_login" class="">             
              <legend id="legend_login" class=""><img id="logo" src="../assets/img/logo.png" alt="logo"></legend>
                <form action="../src/login.php" method="post">

                  <div class="form-group">
                    <label for="apelido_login">Apelido:</label>
                    <input type="text" name="apelido_login" class="form-control" id="apelido_login" placeholder="Informe seu apelido...">
                  </div>

                  <div class="form-group mb-1">
                      <label for="senha_login" id="email_l">Senha:</label>
                      <input type="password" name="senha_login" class="form-control" id="senha_login" placeholder="Informe sua senha...">
                      <div id="icon" onclick="mostrarOcultar_login()"></div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-12 text-center">
                      <a href="../src/esqueceu_senha.php" data-toggle="modal" data-target="#modalesqueceuSenha" id="esqueceuSenha" >Esqueceu a senha?</a>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-2"></div>
                      <button type="submit" class="btn btn-primary col-8" id="btnlogin">Entrar</button>
                    <div class="col-2"></div>
                  </div>
                </form>
                      
                  <div class="row">
                    <div class="col-2"></div>
                      <button type="button" class="btn btn-primary col-8" id="btnnovaconta" data-toggle="modal" data-target="#modalNovoUsuario"> 
                        Criar nova conta
                      </button>
                    <div class="col-2"></div>
                  </div>
                  <div class="text-center text-danger pt-3" id="id_msg"></div>
                  <div class="row">
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <a href="#sobre_nos_pgn"><img src="../assets/img/nois.png" alt=""  id="nois2"></a>  
                      </div>
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                  </div>
            </fieldset>
          </div>
        <div class="col-sm-2 col-md-2 col-lg-3 col-xl-4"></div>
      </div>        
    </div>      
        
      <!-- Modal Cadastro do Usuário -->
       
        <div class="modal fade" id="modalNovoUsuario" tabindex="-1" role="dialog" aria-labelledby="cadastroUsuario" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="cadastroUsuario">Nova conta:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <fieldset>      
                  <form action="../src/cadastrar_usuario.php" method="post" onsubmit="return perguntaVerificacao(this)">
                    <input type="hidden" name="verifica" value="0"/>
                    <input type="hidden" name="tipo_usuario" value="0"/>
                    <input type="hidden" name="modo" value="0"/>

                    <div class="form-group">
                      <label for="nome">Nome Completo:</label> 
                      <input type="text" id="nome" name="nome_completo" class="btnsLoginFocus form-control" placeholder="Informe o nome completo..." >
                      <div class="erro-preencher" id="nome_completo_erro"></div>
                    </div>
                            
                  <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="data_nasc">Data de Nascimento:</label> 
                        <input type="date" id="data_nasc" name="data_nasc" class="btnsLoginFocus form-control" max="2022-12-31"  maxlength="10">
                        <small id="" class="form-text text-muted">Atenção: Insira uma data válida.</small>
                        <div class="erro-preencher" id="data_nasc_erro"></div>
                      </div> 

                      <div class="form-group col-md-6">
                        <label for="tel">Telefone:</label>
                        <input type="text" class="btnsLoginFocus form-control phone-mask" name="tel" id="tel" maxlength="16" minlenght="15" placeholder="(DDD) 00000-0000"  autocomplete="on">
                        <small id="" class="form-text text-muted">(Opcional)</small>
                        <div class="erro-preencher" id="tel_erro"></div>
                      </div>
                    </div>
        
                    <div class="form-group">
                      <label for="apelido">Apelido:</label> 
                      <input type="text" id="apelido" name="apelido" class="btnsLoginFocus form-control" placeholder="Informe o seu apelido..." oninput="verificarApelido(this)" >
                      <div class="erro-preencher" id="apelido_erro"></div>
                    </div> 
                            
                    <div class="form-group">
                      <label for="email_cadastro">Email:</label> 
                      <input type="email" id="email_cadastro" name="email_cadastro" class="btnsLoginFocus form-control" placeholder="Informe o seu email..." oninput="verificarEmail(this)" autocomplete="on">
                      <small id="" class="form-text text-muted">Exemplo: exemplo@gmail.com</small>
                      <div class="erro-preencher" id="email_erro"></div>
                    </div> 
        
                    <div class="form-group">
                      <label for="senha_cadastro">Senha:</label>
                      <input type="password" name="senha_cadastro" class="btnsLoginFocus form-control" id="senha_cadastro" placeholder="Informe sua senha..."  >
                      <div id="icon_cadastro" onclick="mostrarOcultar_cadastro()"></div>
                      <small id="" class="form-text text-muted">A senha deve conter mais de 8 caracteres, ao menos 1 letra maiúscula e 1 número.</small>
                      <div class="erro-preencher" id="senha_erro"></div>
                    </div>       

                    <div class="form-group">
                      <p>Selecione seu avatar:</p>
                      <div class="avatar-container">
                          <?php foreach ($lista_avatar as $avatar) : ?>
                            <input class="avatar-radio" type="radio" id="avatar<?=$avatar["id_avatar"]?>" name="id_avatar" value="<?=$avatar["id_avatar"]?>">
                            <label for="avatar<?=$avatar["id_avatar"]?>">
                              <img src="<?=$avatar["caminho"]?>" alt="<?=$avatar["nome"]?>">
                            </label>
                          <?php endforeach ?> 
                          <div class="erro-preencher" id="avatar_erro"></div>
                          <?php
                            $avatarEscolhido = $avatar["id_avatar"];
                            $caminhoEscolhido = $avatar["caminho"];

                            $_SESSION["caminhoAvatar"] = $caminhoEscolhido;
                            $_SESSION["idAvatar"] = $avatarEscolhido;
                          ?>
                    </div>  
                    <div class="form-group" id="divCadastrar">    
                      <button type="submit" value="inserir" class="btn btn-primary" id="botao_inserirUsuario">Cadastrar</button> 
                    </div>   
                  </form>
                </fieldset>       
              </div>
            </div>
          </div>
        </div>

      <!-- Modal Esqueci a senha --> 
 
        <div class="modal fade" id="modalesqueceuSenha" tabindex="-1" role="dialog" aria-labelledby="recupere_senha" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="recupere_senha">Recuperação de senha:</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body">
                <fieldset>      
                  <form action="../src/esqueceu_senha.php" method="post">                             
                    <div class="form-group">
                      <label for="email_recuperar">Email:</label> 
                      <input type="text" id="email_recuperar" name="email_recuperar" class="form-control" placeholder="Informe o seu email..." required>
                    </div>
                    <div class="form-group">    
                      <button type="submit" value="enviar" class="btn btn-primary" id="botao_recupera_senha">Enviar</button> 
                    </div>   
                  </form>
                </fieldset>       
              </div>

            </div>
          </div>
        </div>                  
 
      <div id="sobre_nos_pgn">
        <div class="row">
          <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="margin: auto;">
                <h2  id="txt_sobre_nos">DESENVOLVEDORES:</h2>
              </div>
          <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
        </div>
                  
        
        <div class="row">            
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin: auto">
            <div class="carousel slide" id="carrosel_sobrenos" data-ride="carousel">    
              
              <ol class="carousel-indicators">
                <li data-target="#carrosel_sobrenos" data-slide-to="0" class="indicador active"></li>
                <li data-target="#carrosel_sobrenos" data-slide-to="1" class="indicador"></li>
                <li data-target="#carrosel_sobrenos" data-slide-to="2" class="indicador"></li>
                <li data-target="#carrosel_sobrenos" data-slide-to="3" class="indicador"></li>
                <li data-target="#carrosel_sobrenos" data-slide-to="4" class="indicador"></li>
              </ol>

              <div class="carousel-inner" id="corpo_carrosel">  
                <!-- Primeiro slide -->
                <div class="carousel-item active">
                  <div class="row">
                  <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-10 col-sm-10 col-md-10 col-lg-8 col-xl-6" style="margin: auto">
                      <img src="../assets/img/nois.png" id="nois">                                             
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div>
                  <div class="row">
                  <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6" id="texto_inicial_nois" style="margin: auto">
                      <p>Olá! Somos formandos do curso <span class="negrito">Técnico em Informática Integrado ao Ensino Médio (IFSP - Câmpus Araraquara)</span> e
                        desenvolvemos o site <span class="negrito">Eco Age</span> como <span class="negrito">Trabalho de Conclusão de Curso</span> durante o ano de <span class="negrito">2023</span>!
                      </p>
                    </div>                                
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div>  
                </div> 

                <!-- Segundo slide -->
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-7 col-sm-7 col-md-7 col-lg-5 col-xl-3"style="margin: auto">
                      <img src="../assets/img/edu_aplauso.png" id="Edu_img2" >                                             
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div>  
                  <div class="row">
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6" id="texto_inicial_edu2" style="margin: auto">
                      <p>E aí, pessoal! 
                        Sou o <span class="negrito">Edu</span>!
                        Amo <span class="negrito">ler</span> e <span class="negrito">escrever</span>, vocês podem conhecer mais sobre mim me seguindo nas <span class="negrito">redes sociais</span>:<br>
                        <a href="https://www.facebook.com/eduardo.bonifacio.3511" target="_blank"><img src="../assets/img/facebook.png" class="iconeRedeSocial"></a>
                        <a href="https://www.instagram.com/eduu_bonifacio/" target="_blank"><img src="../assets/img/instagram.png" class="iconeRedeSocial"></a>
                      </p>
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div> 
                </div>

                <!-- Terceiro slide -->
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-7 col-sm-7 col-md-7 col-lg-5 col-xl-3" style="margin: auto">
                      <img src="../assets/img/Ana_avatar.png" id="Ana_img2">                                             
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div>
                  <div class="row">
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6" id="texto_inicial_ana2" style="margin: auto">
                      <p>E aí, pessoal!
                        Sou a <span class="negrito">Ana!</span>
                        Amo <span class="negrito">ouvir música</span> e <span class="negrito">conversar com os meus amigos</span>,
                        vocês podem conhecer mais sobre mim me seguindo nas <span class="negrito">redes sociais:</span><br>
                        <a href="https://www.facebook.com/anabeatriz.rochaduarte.1" target="_blank" ><img src="../assets/img/facebook.png" class="iconeRedeSocial"></a>
                        <a href="https://www.instagram.com/ana_rocha_duarte_/" target="_blank" ><img src="../assets/img/instagram.png" class="iconeRedeSocial"></a>
                      </p>    
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div> 
                </div>

                <!-- Quarto slide -->
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-7 col-sm-7 col-md-7 col-lg-5 col-xl-3" style="margin: auto">
                      <img src="../assets/img/bibi_apresenta.png" id="Gabi_img2">                                             
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div>
                  <div class="row">
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                    <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6" id="texto_inicial_gabi2" style="margin: auto">
                      <p> Oiii gentee! 
                        Sou a <span class="negrito">Gabi!</span>
                        Amo <span class="negrito">dançar</span> e <span class="negrito">ouvir música</span>, 
                        vocês podem conhecer mais sobre mim me seguindo nas <span class="negrito">redes sociais:</span><br>
                        <a href="https://www.facebook.com/gabrielle.silva.5055" target="_blank"><img src="../assets/img/facebook.png" class="iconeRedeSocial"></a>
                        <a href="https://www.instagram.com/_gabiulisses/" target="_blank"><img src="../assets/img/instagram.png" class="iconeRedeSocial"></a>            
                      </p>
                    </div>
                    <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                  </div> 
                </div>
              </div>
              
                <a class="carousel-control-prev" href="#carrosel_sobrenos" role="button" data-slide="prev">
                  <span class="carousel-control material-icons" aria-hidden="true" id="ante">
                    chevron_left
                  </span>    
                </a>
                <a class="carousel-control-next" href="#carrosel_sobrenos" role="button" data-slide="next">
                  <span class="carousel-control material-icons" aria-hidden="true" id="next">
                    navigate_next
                  </span>            
                </a>
            </div>       
          </div>
        </div>
      </div>
  </body> 

  <footer>
    <div class="row" id="rodape_login">
        <div class="col-md-12">
            <p>Desenvolvido por <span id="sobre_nos">Ana Beatriz, Eduardo e Gabrielle</a> &copy; ecoage.com.br 2023</span>
        </div>
    </div>
  </footer>
</div>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/script_valida_form.js"></script>
</html>
