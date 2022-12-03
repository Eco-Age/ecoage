<?php
 session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 if ($_SESSION["id_usuario"] == 1){
    header("Location: ../src/tecidos_adm.php");
}
include("../include/navegacao.php");  

?>
    <div class="container">
        <div class="row">
            <div class="col-8"></div>
           
            <div class="col-0"></div>
        </div>

        <div class="row">
            <div class="col-4"></div>
                    <h1 class="col-4" id="txt_tecidos">Tecidos Conquistados:</h1>
            <div class="col-4"></div>
        </div>


        <div class="row" id="tecidos">
            <div id="tecido1_usu">
                    <img id="imgtecido1"class="card-img-top" src="../assets/tecido.png" alt="Poliéster">
                <p>
                    <h5>Poliester</h5>
                        <p>Voce conquistou esse tecido!</p>
                        <a class="btn btn-primary" id="saibamais4" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                        Saiba mais..
                        </a>
                </p>
                  
                <div class="collapse" id="collapse1">
                    <div class="card card-body"  id="card1">
                        Poliéster é uma categoria de polímeros que, quimicamente falando, contém um grupo funcional éster na cadeia principal. Apesar de existirem muitos tipos de poliéster, o termo normalmente é usado para se referir ao politereftalato de etileno, ou PET. Sua composição pode ser natural e sintética, tornando alguns tipos biodegradáveis, enquanto grande parte dos poliésteres sintéticos não o são.
                    </div>
                </div>
            </div>
            <div  id="tecido2_usu">
                <img id="imgtecido2" class="card-img-top" src="../assets/tecido_bloqueado.png" alt="Algodão">
                    <p>
                        <h5>Algodão</h5>
                            <p>Jogue para desbloquear esse tecido</p>
                            <a class="btn btn-secondary" data-toggle="" href="" role="" aria-expanded="" aria-controls="">
                            Saiba mais..
                            </a>                   
                    </p>
            </div>
            <div id="tecido3_usu">
                <img id="imgtecido3" class="card-img-top" src="../assets/tecido_bloqueado.png" alt="Linho">
                    <p>
                        <h5>Linho</h5>
                            <p>Jogue para desbloquear esse tecido</p>
                            <a class="btn btn-secondary" data-toggle="" href="" role="" aria-expanded="" aria-controls="">
                            Saiba mais..
                            </a>
                  </p>
            </div>
        </div>    
    </div>
    <script src="../assets/script.js"></script>
<?php
        include("../include/rodape.php");
?>
