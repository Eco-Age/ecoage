<?php

session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 if ($_SESSION["id_usuario"] == 1){
    header("Location: ../src/site_externo_adm.php");
}
    include("../include/navegacao.php");
?>
    <div class="container">

        <div class="row">
            <div class="col-1">
                <a class="btn" href="portal_de_noticias.php"><span class="material-icons" id="icone_voltar_noticias">reply</span></a>
            </div>
            <div class="col-11"></div>
        </div>

        <div class="row">    
            <div class="col-3"></div>                
                <div class="col-6">
                    <h1 id="txt_portal2">Notícias:</h1>
                </div>
            <div class="col-3"></div>
        </div>
    
        <div class="row">
            <div class="col-5"></div>
                <form action="../src/site_externo.php" class="form-inline">
                    <input class="form-control" type="search" placeholder="Buscar uma notícia..." aria-label="Pesquisar">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filtros" aria-expanded="false" aria-controls="collapseExample" id="btn_filtros">
                        Filtros<span class="material-symbols-outlined" id="seta_filtro">arrow_drop_down</span>
                    </button>
                </form> 
            <div class="col-5"></div>
        </div> 

        <div class="row">
        <div class="col-5"></div>
            <div class="collapse" id="filtros">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="filtros_" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Em qualquer data
                    </button>
                        <div class="dropdown-menu" id="filtros_menu2" aria-labelledby="filtros_">
                            <a class="dropdown-item" href="../src/site_externo.php">Na última hora</a>
                            <a class="dropdown-item" href="../src/site_externo.php">Nas últimas 24 horas</a>
                            <a class="dropdown-item" href="../src/site_externo.php">Na última semana</a>
                            <a class="dropdown-item" href="../src/site_externo.php">No último mês</a>
                            <a class="dropdown-item" href="../src/site_externo.php">No último ano</a>
                        </div>
                </div>
            </div>
        <div class="col-5"></div>
        </div>

    <div class="container">
        <div class="row">
            <div class="col-0"></div>
            <div class="col-12" id="todos_field">
            
                <a href="https://santaceciliaresiduos.com.br/moda-meio-ambiente/#:~:text=Nosso%20lixo%20t%C3%AAxtil%2C%20consequ%C3%AAncia%20da,de%20desperd%C3%ADcio%20de%20%C3%A1gua%20globalmente." target="_blank" class="link_site_externo">
                <fieldset class="field_site_externo">
                   <h3>Qual o impacto da moda no meio ambiente?</h3>
                   <p>https://santaceciliaresiduos.com.br</p>
                   <p>Nosso lixo têxtil, consequência da lógica da moda descartável, leva cerca de 200 anos para se desintegrar.
                      E as consequência dessa indústria de fast fashion vai além do descarte. 
                      De acordo com relatório da ONU responsável por 20% do total de desperdício de água globalmente.</p>
                </fieldset></a>

                <a href="https://wp.ufpel.edu.br/empauta/um-efeito-borboleta-a-industria-da-moda-e-meio-ambiente/" target="_blank" class="link_site_externo">
                <fieldset class="field_site_externo">
                    <h3>Um efeito borboleta: a indústria da moda e meio-ambiente</h3>
                    <p>https://wp.ufpel.edu.br ›</p>
                    <p>Quando se fala no impacto ambiental da indústria da moda se fala muito mais que apenas na extração de matérias-primas, mas também no consumo de ...</p>
                 </fieldset></a>

                 <a href="https://noticias.r7.com/tecnologia-e-ciencia/qual-e-o-impacto-que-nossas-roupas-causam-ao-meio-ambiente-01122021" target="_blank" class="link_site_externo">
                 <fieldset class="field_site_externo">
                    <h3>Qual é o impacto que nossas roupas causam ao meio ambiente?</h3>
                    <p>https://noticias.r7.com ›</p>
                    <p>O consumo excessivo e rápido de peças de roupa, que surge do padrão de produção do fast-fashion (moda rápida), é cada vez mais nocivo para o ...</p>
                 </fieldset>
                 </a>
            </div>
            <div class="col-0"></div>
        </div>
    </div>
</div>
<?php
    include("../include/rodape.php");  
?>
<script src="../assets/script.js"></script>
</body>
</html>
