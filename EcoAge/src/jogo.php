<?php
require("../database/usuario.php");
require_once("../database/buscarPatente.php");
include("../include/navegacao.php");
verificaSessao();

$chave_sessao = $_SESSION["id_usuario"];
$patente = buscarPatente();

?>

<div id="conteudo">
    <main class="container">
        <div id="jogo">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <h1 id="txt_jogo">Guess the Tissue:</h1>
                    <?php
                        if ($patente === null) {
                            echo "<p style='font-size: 18px'class='txt_patente'>
                                    Você ainda não tem nenhuma patente.
                                    <span style='color: green; font-family: Arial, sans-serif; font-size: 18px; 
                                    font-weight: bold;'>Jogue a primeira vez!
                                    </span>
                                </p>";
                        } else {
                            echo "<p style='font-size: 18px' class='txt_patente'>
                                    Sua patente atual é: 
                                    <a href='../src/tecidos.php'><span style='color: green; 
                                        font-family: Arial, sans-serif; font-size: 18px; font-weight: bold;' 
                                        data-toggle='popover' data-placement='top' title='Já conhece esse tecido?' 
                                        data-content='<div class=\"popover-child\">
                                        Que tal descobrir quais são os impactos do tecido que representa sua patente?
                                        </div>' data-html='true' data-trigger='hover'>$patente</span>
                                    </a>
                                </p>";
                        }
                    ?>  
                </div>
                <div class="col-3"></div>
            </div>
            <canvas id="jogoCanvas" width="800" height="600">
            </canvas>
            <audio id="backgroundMusic" src="../assets/sounds/backgroundmusic.mp3" loop></audio>
            <audio id="backgroundMusicImortal" src="../assets/sounds/backgroundmusicimortal.mp3" loop></audio>
            <audio id="somPulando" src="../assets/sounds/sompulando.mp3"></audio>
    </main>
</div>

<?php
include("../include/rodape.php");
?>
<script>
    var chave_sessao = "<?php echo $chave_sessao; ?>";

    $(function() {
        $('[data-toggle="popover"]').popover({
            container: 'body',
            content: function() {
                return $(this).data('content');
            }
        });
    });
</script>
<script src="../assets/js/jogo.js"></script>
<script src="../assets/js/script.js"></script>

</html>