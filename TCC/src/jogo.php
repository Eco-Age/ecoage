<?php
require ("../database/usuario.php");
include("../include/navegacao.php");
verificaSessao();

$chave_sessao = $_SESSION["id_usuario"];

?>

<div id="conteudo">
<main class="container">
<div id="jogo">
    <div class="row">
        <div class="col-3"></div>
                <h1 class="col-6" id="txt_jogo">Guess the Tissue:</h1>
        <div class="col-3"></div>
    </div>
    <canvas id="jogoCanvas" width="800" height="600">
        
    </canvas>
   

</main>
</div>

<?php
 include("../include/rodape.php");
?>    
<script>
    var chave_sessao = "<?php echo $chave_sessao; ?>";
</script>
<script src="../assets/jogo.js"></script>
<script src="../assets/script.js"></script>
</body>
</html>
