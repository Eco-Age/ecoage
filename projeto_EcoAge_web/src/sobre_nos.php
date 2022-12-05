<?php

session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 

  include("../include/navegacao.php");
?>

<main id="container_sobrenos">

 <div class="container">
    <div class="row">
            <div class="col-2"></div>
            <div class="col-8" id="txt_sobre_nos">     
                <h6>E aí! Que bom te ver por aqui. O que tá achando do site? Uma dica: Você sempre pode nos dar 
                    sua opinião enviando um e-mail pra ecoage@gmail.com ou direto pela <a href="../src/ajuda.php" id="paginaduvidas"> página de dúvidas!</a>
                </h6>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8" id="txt_sobre_nos">     
                <h3>
                    Um pouco sobre nós:
                    </h3>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row">
            <div class="col-3"></div>

            <div class="col-2" id="sobre_nos_ana">
                <h6>Ana Beatriz</h6>
                <img src="../assets/Ana_avatar.png" id="Ana_img">
                <div class="col-6" id="txt_apresentacao">
                    <p>Oi galera! Sou a Ana, estudo no Instituto Federal de São Paulo - Câmpus Araraquara.
                        Amo ouvir música e conversar com os meus amigos. Fiz parte do desenvolvimento do site ecoage como Trabalho
                        de Conclusão de Curso.
                        Vocês podem conhecer mais sobre mim me seguindo nas redes sociais:<br>

                    <a href="https://www.facebook.com/anabeatriz.rochaduarte.1" target="_blank"><img src="../assets/facebook.png"></a>
                    <a href="https://www.instagram.com/ana_rocha_duarte_/" target="_blank"><img src="../assets/instagram.png"></a>
                    </p>
                    
                </div>
            </div>

            <div class="col-2" id="sobre_nos_edu">
                <h6>Eduardo</h6>
                <img src="../assets/Edu_avatar.png" id="Edu_img">
                <div class="col-6" id="txt_apresentacao">
                    <p>E aí, pessoal! Sou o Edu, estudo no Instituto Federal de São Paulo - Câmpus Araraquara.
                        Amo ler e escrever. Fiz parte do desenvolvimento do site ecoage como Trabalho
                        de Conclusão de Curso.
                        Vocês podem conhecer mais sobre mim me seguindo nas redes sociais:<br>

                        <a href="https://www.facebook.com/eduardo.bonifacio.3511" target="_blank"><img src="../assets/facebook.png"></a>
                        <a href="https://www.instagram.com/eduu_bonifacio/" target="_blank"><img src="../assets/instagram.png"></a>
                    </p>
                </div>
            </div>

            <div class="col-2" id="sobre_nos_gabi">
                <h6>Gabrielle</h6>
                <img src="../assets/Gabi_avatar.png" id="Gabi_img">
                <div class="col-6" id="txt_apresentacao">
                    <p> Oiii gentee! Sou a Gabi, estudo no Instituto Federal de São Paulo - Câmpus Araraquara.
                        Amo dançar e ouvir música. Fiz parte do desenvolvimento do site ecoage como Trabalho
                        de Conclusão de Curso.
                        Vocês podem conhecer mais sobre mim me seguindo nas redes sociais:<br>

                        <a href="https://www.facebook.com/gabrielle.silva.5055" target="_blank"><img src="../assets/facebook.png"></a>
                        <a href="https://www.instagram.com/_gabiulisses/" target="_blank"><img src="../assets/instagram.png"></a>
                        
                    </p>
                </div>  
            </div>
        <div class="col-3"></div>
    </div>
</div>
</main>
<?php
    include("../include/rodape.php");  
?>
</body>
</html>