<?php

session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 
    include("../include/navegacao.php");
?>
<body>
<main class="container">
    <div id="pagina_de_duvidas">
        <div class="row">
            <div class="col-3"></div>
                <div class="col-6" id="duvidas_frequentes">
                    <h1>Dúvidas frequentes:</h1>
                </div>
            <div class="col-3"></div>
        </div>


        <div class="row" id="caixas_duvidas">
            <div class="col-3"></div>
                <div class="col-6">
                    <div id="carrosel_duvidas" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            
                            <div class="carousel-item active">
                                <div class="d-block w-100" id="duvida1">
                                    <h5>Como acesso o jogo?</h5>
                                    <p>
                                        Basta clicar no ícone de controle na barra de navegação.
                                    </p>
                                </div> 
                            </div>  

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida2">
                                    <h5>Como faço para jogar?</h5>
                                    <p>
                                        Verifique o tutorial na página do jogo.
                                    </p> 
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida3">
                                    <h5>Como altero minha senha?</h5>
                                    <p>
                                        Para modificar sua senha basta ir ao seu perfil na barra de navegação, 
                                        alterar sua senha e salvar as alterações.
                                    </p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida4">
                                    <h5>Esqueci a senha, e agora?</h5>
                                    <p>
                                        Clique na opção "esqueci minha senha" no formulário de login.
                                    </p>
                                </div>
                            </div>

                        </div>
                    
                        <a class="carousel-control-prev" href="#carrosel_duvidas" role="button" data-slide="prev">
                            <span class="carousel-control material-icons" aria-hidden="true" id="ante">
                                chevron_left
                            </span>    
                        </a>
                        <a class="carousel-control-next" href="#carrosel_duvidas" role="button" data-slide="next">
                            <span class="carousel-control material-icons" aria-hidden="true" id="next">
                                navigate_next
                            </span>            
                        </a>
                    </div>
                </div>
            <div class="col-3"></div>  
          </div>
    
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                    <h3>Ainda precisa de ajuda?</h3>
                    <h5>Envie-nos sua dúvida!</h5>
                    <br>
                </div>
            <div class="col-4"></div>
        </div>
        
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="email_ajuda">
                        <small id="emailHelp" class="form-text text-muted">Seu e-mail não será compartilhado com ninguém.</small>
                    </div>
                    <div class="form-group"> 
                        <input type="text" class="form-control" placeholder="Assunto" name="assunto_ajuda">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Sua dúvida..." name="duvida"></textarea>
                    </div>
                    <input type="submit" class="main-btn btn btn-primary" id="enviarDuvida" value="Enviar">
                </form>
                </div>
            <div class="col-4"></div>
        </div>  
    </div>
</main>
<?php
    include("../include/rodape.php");  
?>
</body>
</html><?php

session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 
    include("../include/navegacao.php");
?>
<body>
<main class="container">
    <div id="pagina_de_duvidas">
        <div class="row">
            <div class="col-3"></div>
                <div class="col-6" id="duvidas_frequentes">
                    <h1>Dúvidas frequentes:</h1>
                </div>
            <div class="col-3"></div>
        </div>


        <div class="row" id="caixas_duvidas">
            <div class="col-3"></div>
                <div class="col-6">
                    <div id="carrosel_duvidas" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            
                            <div class="carousel-item active">
                                <div class="d-block w-100" id="duvida1">
                                    <h5>Como acesso o jogo?</h5>
                                    <p>
                                        Basta clicar no ícone de controle na barra de navegação.
                                    </p>
                                </div> 
                            </div>  

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida2">
                                    <h5>Como faço para jogar?</h5>
                                    <p>
                                        Verifique o tutorial na página do jogo.
                                    </p> 
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida3">
                                    <h5>Como altero minha senha?</h5>
                                    <p>
                                        Para modificar sua senha basta ir ao seu perfil na barra de navegação, 
                                        alterar sua senha e salvar as alterações.
                                    </p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida4">
                                    <h5>Esqueci a senha, e agora?</h5>
                                    <p>
                                        Clique na opção "esqueci minha senha" no formulário de login.
                                    </p>
                                </div>
                            </div>

                        </div>
                    
                        <a class="carousel-control-prev" href="#carrosel_duvidas" role="button" data-slide="prev">
                            <span class="carousel-control material-icons" aria-hidden="true" id="ante">
                                chevron_left
                            </span>    
                        </a>
                        <a class="carousel-control-next" href="#carrosel_duvidas" role="button" data-slide="next">
                            <span class="carousel-control material-icons" aria-hidden="true" id="next">
                                navigate_next
                            </span>            
                        </a>
                    </div>
                </div>
            <div class="col-3"></div>  
          </div>
    
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                    <h3>Ainda precisa de ajuda?</h3>
                    <h5>Envie-nos sua dúvida!</h5>
                    <br>
                </div>
            <div class="col-4"></div>
        </div>
        
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="email_ajuda">
                        <small id="emailHelp" class="form-text text-muted">Seu e-mail não será compartilhado com ninguém.</small>
                    </div>
                    <div class="form-group"> 
                        <input type="text" class="form-control" placeholder="Assunto" name="assunto_ajuda">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Sua dúvida..." name="duvida"></textarea>
                    </div>
                    <input type="submit" class="main-btn btn btn-primary" id="enviarDuvida" value="Enviar">
                </form>
                </div>
            <div class="col-4"></div>
        </div>  
    </div>
</main>
<?php
    include("../include/rodape.php");  
?>
