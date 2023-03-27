<?php
include_once('../database/avatar.php');
include("cabecalho.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
}

$avatar_atual = buscarAvatarUsado($id_usuario);

?>
<header id="navegacao">
    <nav class="navbar navbar-expand-lg sticky-top"> 
        <div class="container">
            <a class="navbar-brand" href="../src/pagina_inicial.php">
                <img src="../assets/logo.png" width="50" height="50" alt="Eco Age">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-icons nav-link" id="icone_menu">menu</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../src/pagina_inicial.php" id="menu_home" autocomplete="off"
                            checked><span class="material-icons" id="icone_home">home</span></a>
                    </li> 
                   
                    <li class="nav-item">
                        <a class="nav-link" href="../src/portal_de_noticias.php" id="menu_portal"><i
                                class="fa-solid fa-paperclip"></i> <span>Notícias</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/tecidos.php" id="menu_tecidos"><i class="fas fa-tshirt"></i>
                            Tecidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/jogo.php" id="game"><span class="material-symbols-outlined"
                                id="icone_game">stadia_controller</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../src/ajuda.php" id="ajuda"><span
                                class="material-symbols-outlined">help</span></a>
                    </li>
                    <li class="navbar-item dropdown" id="menu">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false" id="menu_m"><span class="material-icons"
                                id="icone_menu">edit</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item">
                                <?php
                                if (isset($_SESSION["id_usuario"])) { ?>
                                    <form action="../src/edicao_usuario.php" method="get">
                                        <input type="hidden" name="id_usuario" value="<?= $_SESSION["id_usuario"] ?>" />
                                        <button id="btnmeuperfil" type="submit" class="dropdown-item"><img id="avatarMenu"
                                                src="<?= $avatar_atual['caminho'] ?>" alt="<?= $_SESSION['idAvatar'] ?>">Meu
                                            perfil</button>
                                    </form>
                                <?php } ?>
                            </div>
                            <div class="dropdown-item">
                                <form id="formAlterarSenha" method="POST" action="../src/confirma_senha.php">
                                    <button style="cursor: pointer;" class="dropdown-item" id="btnAlterarSenha">
                                        <span class="material-icons" id="icone_sair">lock</span>Alterar senha
                                    </button>
                                </form>
                            </div>
                            <div class="dropdown-item">
                                <button style="cursor: pointer;" class="dropdown-item" onclick="logout()">
                                    <span class="material-icons" id="icone_sair">logout</span>Sair
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
    </div>
    </div>

</header>

<body>