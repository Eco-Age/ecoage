<?php
      require("../database/usuario.php");
      include("../include/navegacao.php");
      include("../util/mensagens.php");
      include("../util/formatacoes.php");  

exibirMsg();

    if(isset($_SESSION["id_usuario"])){
    $id_usuario = $_SESSION["id_usuario"];
  }

    $usuario = buscarUsuarioLogado($id_usuario);
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
                    <form action="editar_usuario.php" method="post">
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
                            <label for="senha_cadastro">Senha:</label>
                            <input type="password" name="senha_cadastro" class="form-control" id="senha_cadastro" value="<?=$usuario["senha"]?>">
                        </div>
                            
                        <div class="form-group">    
                            <button type="submit" value="inserir" class="btn btn-primary" id="botao_editar_usuario">Editar</button> 
                        </div>   
                    </form>
                </fieldset>  
        <div class="col-3"></div>
    </div>
</div>
<?php
      include("../include/rodape.php");
?>
</body>
</html>
