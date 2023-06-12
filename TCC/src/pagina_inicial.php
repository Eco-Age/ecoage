<?php
    require_once ("../database/usuario.php");
    include("../include/navegacao.php");  
    include ("../util/mensagens.php");
 
    exibirMsg();
    verificaSessao();
?> 
<div id="conteudo">
    <main class="container">
        <?php 
            if (isset($_SESSION["apelido_logado"])) { ?>
                <p class="alert-success nav-link" id="logado">Logado como <?= $_SESSION["apelido_logado"] ?></p>
        <?php } ?>

        <!-- <div class="container-fluid" id="apresentacao_home"> -->
            <div class="row">
                <div class=""></div>
                <div id="carroselIntrod" class="carousel slide col-12" data-interval="30000" data-ride="carousel">
            
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
                                <div class="col-4 col-lg-4"></div>
                                    <div class="col-4 col-sm-3 col-md-3 col-lg-4 col-xl-3">
                                            <img src="../assets/edu_aplauso.png" id="Edu_img">                                             
                                    </div>
                                <div class="col-4 col-lg-4"></div>
                                <div class="col-3 col-lg-3"></div>
                                    <div class="col-6 col-sm-7 col-md-7 col-lg-6 col-xl-7" id="texto_inicial_ana">
                                        <h3>Olá, <?= $_SESSION["nome_logado"] ?>!</h3>
                                        <p >Com o objetivo de auxiliar na diminuição dos 
                                            impactos ambientais gerados pela indústria têxtil, apresentamos: 
                                            <br><span  class="destaque">EcoAge</span> - uma aplicação web capaz de 
                                            conscientizar a população, através da gamificação, acerca de tecidos sustentáveis.
                                    </div>
                                <div class="col-3 col-lg-3"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <img src="../assets/bibi_desconfiada.png" id="Edu_img">
                                </div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7" id="texto_inicial_edu"> 
                                    <h3>Ei, vamos com calma!</h3>
                                    <p >
                                        Antes de navegar pelo nosso site, convidamos você a saber um pouco o que nos motivou a escolha desse tema.
                                        Afinal, <span class="destaque">você sabe como a roupa que você esta vestindo foi fabricada?</span><span class="destaque"> E qual impacto isso tem no meio ambiente? </span>
                                    </p>
                                </div>    
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-1"></div>
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                        <img src="../assets/Ana_pensando.png" id="Edu_img">
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7" id="texto_inicial_edu"> 
                                        <h3>Onde tudo começa?</h3>
                                        <p >A industria têxtil, responsável pela transformação de <span class="destaque">fibras em fios, fios em tecidos e de tecidos em peças de vestuário, artigos têxteis para o lar e uso doméstico,</span>
                                            constitui uma etapa da estrutura da cadeia produtiva da <span class="destaque">indústria da moda</span> (a qual atinge milhões de pessoas no mundo, além de gerar muitos empregos).
                                        </p>
                                    </div>      
                                <div class="col-2"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-1"></div>
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                        <img src="../assets/edu_surpreso.png" id="Edu_img">
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7" id="texto_inicial_edu"> 
                                        <h3>O que não sabemos sobre?</h3>
                                        <p >Para toda produção é necessária uma grande quantidade de recursos naturais.
                                        Além disso, a indústria têxtil é o terceiro setor mais poluente do mundo, respondendo por até 
                                        <span class="destaque">5% das emissões de gases de efeito estufa</span>, de acordo com um relatório de 2021 do Fórum Econômico Mundial. 
                                        </p>
                                    </div>
                                <div class="col-2"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-1"></div>
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                        <img src="../assets/bibi_triste.png" id="Edu_img">
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7" id="texto_inicial_edu"> 
                                        <h3>Então...</h3>
                                        <p >A indústria da moda no cenário têxtil, <span class="destaque">gera gases de efeito estufa e contribui para o aquecimento global</span>, o que prejudica o mundo a longo prazo. 
                                            Ou seja, têm relação direta com quase
                                            todos os tipos de impactos negativos ao meio ambiente, como 
                                            <span class="destaque">mudanças climáticas, poluição química, perda da biodiversidade</span>, entre outros.  
                                        </p>
                                    </div>    
                                <div class="col-2"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-1"></div>
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                        <img src="../assets/Ana_avatar.png" id="Edu_img">
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7" id="texto_inicial_edu"> 
                                        <h3>Temos uma proposta!</h3>
                                        <p >Sabendo do impacto que determinados tecidos têm no meio ambiente, propomos
                                            a vocês conhecer um pouco mais dos <span class="destaque">tecidos sustentáveis</span>! Que geram menos
                                            impactos ambientais. Pois, o processo de produção é consciente e <span class="destaque">evita o uso de químicos poluentes e milhares de litros de água.</span> 
                                        </p>
                                    </div>    
                                <div class="col-2"></div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row ">
                                <div class="col-1"></div>
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                        <img src="../assets/bibi_grata.png" id="Edu_img">
                                    </div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7" id="texto_inicial_edu"> 
                                        <h3>Agora sim!</h3>
                                        <p >Agora que você já sabe a importância dos tecidos no meio ambiente, navegue no menu acima e tenha acesso 
                                            a um <span class="destaque">portal de notícias</span> para se atualizar quanto ao assunto!
                                            Você também pode <span class="destaque">"conquistar tecidos"</span> através do nosso jogo e ficar adentro de seus impactos!
                                            <br><span class="destaque">Obrigado por chegar até aqui!💚</span>
                                        </p>
                                    </div>
                                <div class="col-2"></div>
                            </div>
                        </div> 
                    </div>

                    <a class="carousel-control-prev" href="#carroselIntrod" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carroselIntrod" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
                <div class=""></div>
                </div>
            </div> 
        </div> 
    </main>
</div>
<?php
        include("../include/rodape.php");
  ?>
<script src="../assets/script.js"></script>
</body>
</html>
