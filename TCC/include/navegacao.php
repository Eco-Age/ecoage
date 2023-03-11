<?php
include_once('../database/avatar.php');
include("cabecalho.php");

if(isset($_SESSION["id_usuario"])){
    $id_usuario = $_SESSION["id_usuario"];
  }

$avatar_atual = buscarAvatarUsado($id_usuario);

?>
 <header id="navegacao">
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            
           <div class="row">
                <ul class="navbar nav">
                   <li class="navbar-brand col-1">
                       <a href="../src/pagina_inicial.php" id=""> <img src="../assets/logo.png" width="50" height="50" alt="Eco Age"></a>
                   </li>
           
                   <li class="navbar-text active" >
                       <a class="nav-link " href="../src/pagina_inicial.php" id="menu_home" autocomplete="off" checked><span class="material-icons" id="icone_home">home</span></a>
                   </li>
       
                   <li class="navbar-text" >
                       <a class="nav-link" href="../src/portal_de_noticias.php" id="menu_portal"><span >Portal de Notícias</span></a>
                   </li>
       
                   <li class="navbar-text">
                       <a class="nav-link" href="../src/tecidos.php" id="menu_tecidos">Tecidos</a>
                   </li>
                 
                   <li class="navbar-text">
                       <a class="nav-link" href="../src/jogo.php" id="game"><span class="material-symbols-outlined" id="icone_game">stadia_controller</span></a>
                   </li>
                   
                   <li class="navbar-text" id="menu_ajuda">
                       <a class="nav-link" href="../src/ajuda.php" id="ajuda"><span class="material-symbols-outlined">help</span></a>
                   </li>


                    <li class="navbar-text dropdown" id="menu">
                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="menu_m"><span class="material-icons" id="icone_menu">menu</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item">
                            <?php 
                                if(isset($_SESSION["id_usuario"])){?>
                                    <form action="../src/edicao_usuario.php" method="get">
                                        <input type="hidden"  name="id_usuario" value="<?=$_SESSION["id_usuario"]?>"/>
                                        <button id="btnmeuperfil" type="submit" class="dropdown-item"><img id="avatarMenu" src="<?=$avatar_atual['caminho']?>" alt="<?=$_SESSION['idAvatar']?>">Meu perfil</button>
                                    </form>
                                <?php } ?>  
                            </div>
                            <div class="dropdown-item"> 
                                <button style="cursor: pointer;" class="dropdown-item" data-toggle="modal" data-target="#modalalterarSenha">
                                    <span class="material-icons"  id="icone_sair">lock</span>Alterar senha
                                </button>
                            </div>  
                            <div class="dropdown-item"> 
                                <button style="cursor: pointer;" class="dropdown-item" data-toggle="modal" data-target="#confirmSair">
                                    <span class="material-icons"  id="icone_sair">logout</span>Sair
                                </button>
                            </div>  
                        </div>
                    </li>
                </ul>            
            </div>
        </div>
    </nav>

    <div class="modal fade" id="confirmSair" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                        <p style="font-size: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Deseja mesmo sair da sua conta?</p>
                </div>
    
                <div class="modal-footer">
                    <form action="../src/sair.php" method="POST" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger" id="" name="sair">Sair</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </form>   
                </div> 
            </div>  
        </div>
    </div>

    <div class="modal fade" id="modalalterarSenha" tabindex="-1" role="dialog" aria-labelledby="altere_senha" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="altere_senha">Confirme sua senha atual:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            <fieldset>      
                <form action="../src/confirma_senha.php" method="post">                             
                <div class="form-group">
                    <label for="alterar_senha" id="alterar_senha">Senha:</label> 
                    <input type="password" id="alterar_senha" name="alterar_senha" class="form-control" placeholder="Digite a senha aqui" required>
                </div>
                <div class="form-group">    
                    <button type="submit" value="enviar" class="btn btn-primary" id="botao_inserir">Confirmar</button> 
                </div>   
                </form>
            </fieldset>       
            </div>

        </div>
        </div>
    </div>
                                    
</header> 
<body>
