<?php
  if (!isset($_SESSION)){
    session_start();
  }

require("../database/avatar.php");
include("../include/cabecalho.php");
include("../util/mensagens.php");
include("../util/formatacoes.php");  

exibirMsg();
if (isset($_SESSION["email_recuperar"]) && (time() - intval($_SESSION['email_recuperar']) > 1800)){
  unset($_SESSION["email_recuperar"]);
}



?>
<body id="body_login">
  <div class="container">
    <div class="row" id="login_i">
      <div class="col-6" class="texto_inicial" >            
        <h2 class="texto_inicial">Olá! Você faz ideia do impacto ambiental que a peça que você está vestindo pode causar? 
         Não?! Então realize o login ao lado, ou crie uma nova conta e embarque no nosso universo!</h2>
      </div>
      <div class="col-1"></div>
      <div class="col-4">
        <fieldset id="forms_login" class="col-12">             
          <legend id="legend_login"><img id="logo" src="../assets/logo.png" alt="logo"></legend>
            <form action="../src/login.php" method="post">

              <div class="form-group">
                <label for="apelido_login" id="apelido_login">Apelido:</label>
                <input type="text" name="apelido_login" class="form-control" id="apelido_login" placeholder="Informe seu apelido...">
              </div>

              <div class="form-group">
                  <label for="senha_login" id="email_l">Senha:</label>
                  <input type="password" name="senha_login" class="form-control" id="senha_login" placeholder="Informe sua senha...">
                  <div id="icon" onclick="mostrarOcultar_login()"></div>
              </div>

              <div class="row">
                <div class="col-4"></div>
                  <a href="../src/esqueceu_senha.php" data-toggle="modal" data-target="#modalesqueceuSenha" id="esqueceuSenha">Esqueceu a senha?</a>
                <div class="col-4"></div>
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
        </fieldset>
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
                <form action="../src/cadastrar_usuario.php" method="post">
                             
                  <div class="form-group">
                    <label for="nome" id="nome">Nome Completo:</label> 
                    <input type="text" id="nome" name="nome_completo" class="form-control" placeholder="Informe o nome completo..." required>
                  </div>
                           
                 <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="data_nasc" id="data_nasc">Data de Nascimento:</label> 
                      <input type="date" id="data_nasc" name="data_nasc" class="form-control" max="2022-12-31" required maxlength="10">
                      <small id="" class="form-text text-muted">Atenção: Insira uma data válida.</small>
                    </div> 
                    <div class="form-group col-md-6">
                      <label for="tel">Telefone:</label>
                      <input type="text" class="form-control phone-mask" name="tel" id="tel" pattern="([0-9]{2}\)\s+9+[0-9]{4}\-[0-9]{4}" maxlength="16" minlenght="15" placeholder="(DDD) 00000-0000">
                      <small id="" class="form-text text-muted">Exemplo: (16) 91212-3456</small>
                    </div>
                  </div>
       
                  <div class="form-group">
                    <label for="apelido" id="apelido_cadastro">Apelido:</label> 
                    <input type="text" id="apelido" name="apelido" class="form-control" placeholder="Informe o seu apelido..." required>
                  </div> 
                           
                  <div class="form-group">
                    <label for="email_cadastro" id="email_cadastro">Email:</label> 
                    <input type="text" id="email" name="email_cadastro" class="form-control" placeholder="Informe o seu email..." pattern="[a-z0-9]+@[a-z0-9]+\.[a-z0-9]{3}" required>
                    <small id="" class="form-text text-muted">Exemplo: example@gmail.com</small>
                  </div> 
       
                  <div class="form-group">
                    <label for="senha_cadastro">Senha:</label>
                    <input type="password" name="senha_cadastro" class="form-control" id="senha_cadastro" placeholder="Informe sua senha..." pattern="^(?=.*[A-Z])(?=.*\d).{8,}$"  maxlenght="8"  required >
                    <div id="icon_cadastro" onclick="mostrarOcultar_cadastro()"></div>
                    <small id="" class="form-text text-muted">A senha deve conter mais de 8 caracteres, ao menos 1 letra maiúscula e 1 número.</small>
                  </div>       

                  <div class="form-group">
                                <?php escolha_avatar()  ?>                                                             
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

    </div>
  
 
         <!-- Modal Esqueci a senha --> 
 
      <div class="modal fade" id="modalesqueceuSenha" tabindex="-1" role="dialog" aria-labelledby="recupere_senha" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="recupere_senha">Recupere sua senha:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
              <fieldset>      
                <form action="../src/esqueceu_senha.php" method="post">                             
                  <div class="form-group">
                    <label for="email_recuperar" id="email_recuperar">Email:</label> 
                    <input type="text" id="email_recuperar" name="email_recuperar" class="form-control" placeholder="Informe o seu email..." required>
                  </div>
                  <div class="form-group">    
                    <button type="submit" value="enviar" class="btn btn-primary" id="botao_inserir">Enviar</button> 
                  </div>   
                </form>
              </fieldset>       
            </div>

          </div>
        </div>
      </div>
  </div>

  <div class="row" id="sobre_nos_pgn">
      <div class="col-12">

        <div class="row" id="txt_sobre_nos">
          <div class="col-4"></div>
            <div class="col-4">
                      <h1 id="txt_sobre_nos">DESENVOLVEDORES:</h1>
            </div>
          <div class="col-4"></div>
        </div>

        <div class="row" id="caixas_sobre_nos">
            <div class="col-3"></div>
              <div class="col-6">
            
                <div id="carrosel_sobrenos" class="carousel slide" data-ride="carousel">
              
                        <ol class="carousel-indicators">
                          <li data-target="#carrosel_sobrenos" data-slide-to="0" class="indicador active"></li>
                          <li data-target="#carrosel_sobrenos" data-slide-to="1" class="indicador"></li>
                          <li data-target="#carrosel_sobrenos" data-slide-to="2" class="indicador"></li>
                      </ol>

                        <div class="carousel-inner">
                            
                            <div class="carousel-item active">
                              <div class="row" id="avatar_ana">
                                <div class="col-4"></div>
                                <div class="col-4">
                                        <img src="../assets/Ana_avatar.png" id="Edu_img">                                             
                                </div>
                                <div class="col-4"></div>
                              </div>
                              <div class="row">
                              <div class="col-3"></div>
                                <div class="col-6" id="texto_ana">
                                <p>Oi galera! Sou a Ana, estudo no Instituto Federal de São Paulo - Câmpus Araraquara.
                                    Amo ouvir música e conversar com os meus amigos. Fiz parte do desenvolvimento do site ecoage como Trabalho
                                    de Conclusão de Curso.
                                    Vocês podem conhecer mais sobre mim me seguindo nas redes sociais:<br>

                                <a href="https://www.facebook.com/anabeatriz.rochaduarte.1" target="_blank"><img src="../assets/facebook.png"></a>
                                <a href="https://www.instagram.com/ana_rocha_duarte_/" target="_blank"><img src="../assets/instagram.png"></a>
                                </p>
                                </div>                                
                                <div class="col-3"></div>
                              </div>  
                            </div> 

                            <div class="carousel-item">
                              <div class="row" id="">
                                <div class="col-1"></div>
                                <div class="col-3">
                                        <img src="../assets/edu_aplauso.png" id="Edu_img">                                             
                                </div>
                                <div class="col-6" id="texto_inicial_ana">
                                    <p >Oi, eu sou a Ana.    
                                    <br><span  class="destaque">EcoAge</span> 
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>

                            <div class="carousel-item">
                              <div class="row" id="">
                                <div class="col-1"></div>
                                <div class="col-3">
                                        <img src="../assets/edu_aplauso.png" id="Edu_img">                                             
                                </div>
                                <div class="col-6" id="texto_inicial_ana">
                                    <p >Oi, eu sou a Ana.    
                                    <br><span  class="destaque">EcoAge</span> 
                                </div>
                                <div class="col-2"></div>
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
            <div class="col-3"></div>  
          </div>      </div>
  </div>
     
 </body> 
  <footer class="footer navbar-fixed bottom" id="rodape">
    <div id="copy-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Desenvolvido por <span id="sobre_nos_login">Ana Beatriz, Eduardo e Gabrielle</span> &copy; ecoage.com.br 2023</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="../assets/script.js"></script>
</html>
