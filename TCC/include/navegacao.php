<?php
include_once('../database/avatar.php');
include("cabecalho.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
}

$avatar_atual = buscarAvatarUsado($id_usuario);

?>

<header id="navegacao">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="../src/pagina_inicial.php">
            <img src="../assets/img/logo.png" width="50" height="50" alt="Eco Age">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="material-icons nav-link" id="icone_menu">menu</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../src/pagina_inicial.php" id="menu_home">
                        <span class="material-icons" id="icone_home" title="Página inicial">home</span>
                    </a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="../src/jogo.php" id="game">
                        <span class="material-symbols-outlined" id="icone_game" title="Guess the Tissue">stadia_controller</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="../src/tecidos.php" id="menu_tecidos">
                        <i class="fa-solid fa-layer-group" title="Tecidos"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../src/portal_de_noticias.php" id="menu_portal">
                        <i class="fa-solid fa-envelope-open-text" title="Portal de Notícias"></i>                                    
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../src/ajuda.php" id="ajuda">
                        <span class="material-symbols-outlined" title="Ajuda">help</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false" id="menu_m">
                        <span class="material-icons" id="icone_menu">edit</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right fade">
                        <?php if (isset($_SESSION["id_usuario"])) { ?>
                            <div class="dropdown-item">
                                <form action="../src/edicao_usuario.php" method="get">
                                    <input type="hidden" name="id_usuario" value="<?= $_SESSION["id_usuario"] ?>" />
                                    <button id="btnmeuperfil" type="submit" class="dropdown-item">
                                        <img id="avatarMenu" class="rounded-circle mr-2" src="<?= $avatar_atual['caminho'] ?>" alt="<?= $_SESSION['idAvatar'] ?>" style="width: 30px; height: 30px;">
                                        Meu perfil
                                    </button>
                                </form>
                            </div>
                        <?php } ?>
                        <div class="dropdown-item">
                            <form id="formAlterarSenha" method="POST" action="../src/confirma_senha.php">
                                <button style="cursor: pointer;" class="dropdown-item" type="submit" id="btnAlterarSenha">
                                        <span class="material-icons" id="icone_sair">lock</span>
                                        Alterar senha
                                    </button>
                                </form>
                            </div>
                            <div class="dropdown-item">
                                <button style="cursor: pointer;" class="dropdown-item" onclick="logout()">
                                    <span class="material-icons" id="icone_sair">logout</span>
                                    Sair
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
</header>
<body>

