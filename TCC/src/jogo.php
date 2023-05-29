<?php
require ("../database/usuario.php");
include("../include/navegacao.php");
verificaSessao();
?>

<div id="conteudo">
<main class="container">
<div id="jogo">

    <div class="row">
        <div class="col-4"></div>
                <h1 class="col-4" id="txt_portal">Guess the Tissue:</h1>
        <div class="col-4"></div>
    </div>
    <canvas id="jogoCanvas" width="800" height="600">
        
    </canvas>

</main>
</div>

<?php
 include("../include/rodape.php");
?>    
<script src="../assets/jogo.js"></script>
<script src="../assets/script.js"></script>
</body>
</html>
