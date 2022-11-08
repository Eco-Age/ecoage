<?php
  if (!isset($_SESSION)){
    session_start();
  }

include("../include/cabecalho.php");
include("../util/mensagens.php");
include("../util/formatacoes.php");  

exibirMsg();

?>
<body id="body_login">
    <div class="container">
      <div class="row" id="login_i">
             <div class="col-6" class="texto_inicial" >            
                   <h2 class="texto_inicial">Olá!! Você faz ideia do impacto ambiental que a peça que você está vestindo pode causar? 
                  Não?! Então realize o login ao lado, ou crie uma nova conta e embarque no nosso universo!</h2>
             </div>
             <div class="col-1">
             </div>
             <div class="col-4">
                <fieldset id="forms_login" class="col-12">             
                  <legend id="legend_login"><img id="logo" src="../assets/logo.png" alt="logo"></legend>
                  <form action="../src/login.php" method="post">
                      <div class="form-group">
                          <label for="apelido_login" id="apelido_login">Apelido:</label>
                          <input type="text" name="apelido_login" class="form-control" id="apelido_login" placeholder="Digite seu apelido...">
                      </div>
                      <div class="form-group">
                          <label for="senha_login" id="email_l">Senha:</label>
                          <input type="password" name="senha_login" class="form-control" id="senha_login" placeholder="Digite sua senha...">
                          <small id="senhahelp" class="form-text">Máx.: 8 caracteres.</small>
                      </div>
                      <div class="row">
                      <div class="col-2"></div>
                      <button type="submit" class="btn btn-primary col-8" id="btnlogin">Entrar</button>
                      <div class="col-2"></div>
                      </div>
                  </form>

                      <br>
                      <div class="row">
                      <div class="col-2"></div>
                      <button type="button" class="btn btn-primary col-8" id="btnnovaconta" data-toggle="modal" data-target="#modal"> 
                          Criar nova conta
                      </button>
                      <div class="col-2"></div>
                    </div>
                </fieldset>
             </div>
            
       
               <!-- Modal Cadastro do Usuário -->
       
               <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="cadastroUsuario" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="cadastroUsuario">Novo usuário:</h5>
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
                               <input type="date" id="data_nasc" name="data_nasc" class="form-control" required>
                           </div> 
                           <div class="form-group col-md-6">
                               <label for="tel">Telefone:</label>
                               <input type="text" class="form-control" name="tel" id="">
                           </div>
                           </div>
       
                           <div class="form-group">
                               <label for="apelido" id="apelido_cadastro">Apelido:</label> 
                               <input type="text" id="apelido" name="apelido" class="form-control" placeholder="Informe o seu apelido..." required>
                           </div> 
                           
                           <div class="form-group">
                               <label for="email_cadastro" id="email_cadastro">Email:</label> 
                               <input type="text" id="email_cadastro" name="email_cadastro" class="form-control" placeholder="Informe o seu email..." required>
                           </div> 
       
                           <div class="form-group">
                             <label for="senha_cadastro">Senha:</label>
                             <input type="password" name="senha_cadastro" class="form-control" id="senha_cadastro" placeholder="Digite sua senha...">
                             <small id="emailHelp" class="form-text text-muted">Máx.: 8 caracteres.</small>
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
       </div>
      </body>
</html>
       
