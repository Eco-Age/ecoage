<script>
$(document).ready(function() {
    var modoInput = $("input[name='modo']");
    
    modoInput.on("change", function() {
        if ($(this).is(":checked")) {
            $("body").addClass("modo-escuro");
        } else {
            $("body").removeClass("modo-escuro");
        }
    });

    // Verificar o estado do checkbox ao carregar a página
    if ($("body").hasClass("modo-escuro")) {
        modoInput.prop("checked", true);
    }
});

</script>
</body>
<footer class="" id="rodape">
    <div class="area_contato">
        <div class="container">
            <div id="row">
                <div class="col-md-12">
                    <h6 class="main-title">Entre em contato conosco:</h6>
                </div>
            </div>
            <div class="col-md-12 contact-box" id="divenviarEmail">
                <a href="mailto:live.ecoage@gmail.com" id="enviarEmail"><img class="contact-title" src="../assets/img/icone_gmail.png" id="icone_gmail"></a>
            </div>
        </div>
    </div>

    </div>
    <div id="copy-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Desenvolvido por <span href="#" id="sobre_nos">Ana Beatriz, Eduardo e Gabrielle</span> &copy; ecoage.com.br 2023</p>
                </div>
            </div>
        </div>
    </div>
</footer>
