<?php

include("cabecalho.php");

?>
<body>    
<header id="navegacao">
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
      <div class="row">
        <ul class="navbar nav">
          <li class="navbar-brand">
          <a href="pagina_inicial.php" id=""> <img src="../assets/logo.png" width="50" height="50" alt="Eco Age"></a>
          </li>
          
          <li class="navbar-text active">
          <a class="nav-link " href="pagina_inicial.php" id="menu_home" autocomplete="off" checked><span class="material-icons" id="icone_home">home</span></a>
          </li>

          

          <li class="navbar-text" >
            <a class="nav-link" href="portal_de_noticias.php" id="menu_portal"><span >Portal de Notícias</span></a>
          </li>

          <li class="navbar-text">
            <a class="nav-link" href="tecidos.php" id="menu_tecidos">Tecidos</a>
          </li>

          
          <li class="navbar-text">
            <a class="nav-link" href="jogo.php" id="game"><span class="material-symbols-outlined" id="icone_game">stadia_controller</span></a>
          </li>
            <li class="navbar-text dropdown" id="menu">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="menu_m"><span class="material-icons" id="icone_menu">menu</span></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item">
                      <?php 
                              if (isset($_SESSION["id_usuario"])) { ?>
                              <form action="../src/edicao_usuario.php" method="get">
                                  <input type="hidden"  name="id_usuario" value="<?=$_SESSION["id_usuario"]?>">
                                  <button type="submit" class="dropdown-item"><span class="material-icons" id="icone_perfil">account_circle</span>Meu perfil</button>
                              </form>
                        <?php } ?>  
                    </div>
                    <div class="dropdown-item">
                      <a class="dropdown-item" href="../src/sair.php"><span class="material-icons"  id="icone_sair">logout</span>Sair</a>
                    </div>
                  </div>
              </li>
           </ul>
         </div>
      </div>
    </nav>
</header>  

  
