<?php
 session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
  include("../include/navegacao.php");  
?>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
            <div class="card col-3">
                    <img class="card-img-top" src="../assets/tecido.png" alt="Imagem de capa do card">
                        <div class="card-body">
                            <h5 class="card-title">Poliéster</h5>
                            <p class="card-text">Você conquistou esse tecido!</p>
                            <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Saber mais...</a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card-body">
                                        Poliéster é uma categoria de polímeros que, quimicamente falando, contém um grupo funcional éster na cadeia principal. Apesar de existirem muitos tipos de poliéster, o termo normalmente é usado para se referir ao politereftalato de etileno, ou PET. Sua composição pode ser natural e sintética, tornando alguns tipos biodegradáveis, enquanto grande parte dos poliésteres sintéticos não o são.
                                    </div>
                                </div>
                        </div>
            </div>
            <div class="card col-3">
                        <img class="card-img-top" src="../assets/tecido.png" alt="Imagem de capa do card">
                        <div class="card-body">
                            <h5 class="card-title">Tecido</h5>
                            <p class="card-text">Você conquistou esse tecido!</p>
                            <a href="#" class="btn btn-link">Saber mais...</a>
                        </div>
            </div>
            <div class="card col-3">
                        <img class="card-img-top" src="../assets/tecido_bloqueado.png" alt="Imagem de capa do card">
                        <div class="card-body">
                            <h5 class="card-title">Tecido</h5>
                            <p class="card-text">Jogue para conquistar esse tecido.</p>
                        </div>
            </div>
        <div class="col-1"></div>
    </div>
</div>
    <?php
        include("../include/rodape.php");
    ?>
