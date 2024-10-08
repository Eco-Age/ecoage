<?php
    require_once ("../database/usuario.php");
    include("../include/navegacao.php");  
    include ("../util/mensagens.php");
 
    verificaSessao();
?> 

<div class="container" id="conteudo">
    <main>

    <?php
        exibirMsg();

            if (isset($_SESSION["apelido_logado"])) { ?>
            <div class="row">
                <div class="col-4"></div>
                    <div class="col-4">
                        <p class="alert-success nav-link" id="logado">Logado como <?= $_SESSION["apelido_logado"] ?></p>
                    </div>
                <div class="col-4"></div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                <div  class="col-12 col-sm-12 col-md-12 col-lg-10 col-cl-10 carousel slide" id="carroselIntrod" data-interval="30000" data-ride="carousel" style="margin:auto">

                    <ol class="carousel-indicators">
                        <li data-target="#carroselIntrod" data-slide-to="0" class="indicador active"></li>
                        <li data-target="#carroselIntrod" data-slide-to="1" class="indicador"></li>
                        <li data-target="#carroselIntrod" data-slide-to="2" class="indicador"></li>
                        <li data-target="#carroselIntrod" data-slide-to="3" class="indicador"></li>
                        <li data-target="#carroselIntrod" data-slide-to="4" class="indicador"></li>
                        <li data-target="#carroselIntrod" data-slide-to="5" class="indicador"></li>
                        <li data-target="#carroselIntrod" data-slide-to="6" class="indicador"></li>
                    </ol>
                    
                    <div class="carroselInicial carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                            <img src="../assets/img/edu_aplauso.png" id="Edu_img">                                             
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" id="texto_inicial_edu"  style="margin: auto">
                                        <h3>Olá, <?= $_SESSION["apelido_logado"] ?>!</h3>
                                        <p >Com o objetivo de auxiliar na diminuição dos 
                                            impactos ambientais gerados pela indústria têxtil, apresentamos:  
                                            <span class="destaque">  EcoAge</span> - uma aplicação web capaz de 
                                            conscientizar a população, através da gamificação, acerca de tecidos sustentáveis.
                                        </p>
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                        <img src="../assets/img/bibi_desconfiada.png" id="Gabi_img">
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" id="texto_inicial_gabi" style="margin: auto">
                                        <h3>Ei, vamos com calma!</h3>
                                        <p >
                                            Antes de navegar pelo nosso site, convidamos você a saber um pouco o que nos motivou a escolha desse tema.
                                            Afinal, <span class="destaque">você sabe como a roupa que você esta vestindo foi fabricada?</span><span class="destaque"> E qual impacto isso tem no meio ambiente? </span>
                                        </p>
                                    </div>  
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                        <img src="../assets/img/Ana_pensando.png" id="Ana_img">
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="margin: auto" id="texto_inicial_ana">
                                        <h3>Onde tudo começa?</h3>
                                        <p >A industria têxtil, responsável pela transformação de <span class="destaque">fibras em fios, fios em tecidos e de tecidos em peças de vestuário, artigos têxteis para o lar e uso doméstico,</span>
                                            constitui uma etapa da estrutura da cadeia produtiva da <span class="destaque">indústria da moda</span> (a qual atinge milhões de pessoas no mundo, além de gerar muitos empregos).
                                        </p>
                                    </div> 
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                        <img src="../assets/img/edu_surpreso.png" id="Edu_img">
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="margin: auto" id="texto_inicial_edu">
                                        <h3>O que não sabemos sobre?</h3>
                                        <p >Para toda produção é necessária uma grande quantidade de recursos naturais.
                                            Além disso, a indústria têxtil é o terceiro setor mais poluente do mundo, respondendo por até 
                                            <span class="destaque">5% das emissões de gases de efeito estufa</span>, de acordo com um relatório de 2021 do Fórum Econômico Mundial. 
                                        </p>
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                        <img src="../assets/img/bibi_triste.png" id="Gabi_img">
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="margin: auto" id="texto_inicial_edu">
                                        <h3>Então...</h3>
                                        <p >A indústria da moda no cenário têxtil, <span class="destaque">gera gases de efeito estufa e contribui para o aquecimento global</span>, o que prejudica o mundo a longo prazo. 
                                            Ou seja, têm relação direta com quase
                                            todos os tipos de impactos negativos ao meio ambiente, como 
                                            <span class="destaque">mudanças climáticas, poluição química, perda da biodiversidade</span>, entre outros.  
                                        </p>
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                        <img src="../assets/img/Ana_avatar.png" id="Ana_img">
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="margin:auto" id="texto_inicial_ana">
                                        <h3>Temos uma proposta!</h3>
                                        <p >Sabendo do impacto que determinados tecidos têm no meio ambiente, propomos
                                            a vocês conhecer um pouco mais dos <span class="destaque">tecidos sustentáveis</span>! Que geram menos
                                            impactos ambientais. Pois, o processo de produção é consciente e <span class="destaque">evita o uso de químicos poluentes e milhares de litros de água.</span> 
                                        </p>
                                    </div>    
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>                             
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="margin: auto">
                                        <img src="../assets/img/bibi_grata.png" id="Gabi_img">
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
                            </div>
                            <div class="row ">
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="margin: auto" id="texto_inicial_gabi">
                                        <h3>Agora sim!</h3>
                                        <p >Agora que você já sabe a importância dos tecidos no meio ambiente, navegue no menu acima e tenha acesso 
                                            a um <span class="destaque">portal de notícias</span> para se atualizar quanto ao assunto!
                                            Você também pode <span class="destaque">"conquistar tecidos"</span> através do nosso jogo e ficar adentro de seus impactos!
                                            <br><span class="destaque">Obrigado por chegar até aqui!💚</span>
                                        </p>
                                    </div>
                                <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div> 
                            </div>
                        </div> 
                    </div>

                    <a class="carousel-control-prev" href="#carroselIntrod" role="button" data-slide="prev">
                        <div class="carroselControlIntrod">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </div>                    
                    </a>
                    <a class="carousel-control-next" href="#carroselIntrod" role="button" data-slide="next">
                        <div class="carroselControlIntrod">
                            <span id="setaNext" class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>                            
                        </div>
                    </a>
                </div>
            <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
        </div>
    </main>        
</div> 

<?php
        include("../include/rodape.php");
  ?>
<script src="../assets/js/script.js"></script>
</html>
