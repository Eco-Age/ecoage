const canvas = document.getElementById("jogoCanvas");
const ctx = canvas.getContext("2d");

const backgroundMusic = document.getElementById("backgroundMusic");
backgroundMusic.volume = 0.15;

const backgroundMusicImortal = document.getElementById("backgroundMusicImortal");
backgroundMusicImortal.volume = 0.04;

const somPulando = document.getElementById("somPulando");
somPulando.volume = 0.07;
somPulando.playbackRate = 2;
// Variáveis do jogo
let jogando = false;
let estaMutado = false;
let frames = 0;
const gravidade = 0.25;
const tempoInvencibilidade = 10000; // Tempo em milissegundos para o personagem ficar invencível
const tempoFramesRapidos = 10000; // Tempo em milissegundos para os frames passarem mais rápido
let framesRapidos = false;
let intervaloContagemRegressiva;
const imgPersonagemImortal = [
  '../assets/imagens_jogo/personagemImortal1.png',
  '../assets/imagens_jogo/personagemImortal2.png',
  '../assets/imagens_jogo/personagemImortal3.png'
];

let quadroAtual = 0;
let tempoUltimoQuadro = 0;
let quadroIntervalo = 300;
let personagemImortalImages = [];
// fazendo isso pra carregar as imagens antes da animacao
// pq carregando na hora, qnd trocava de uma pra outra, ficava piscando

function carregarImagens() {
  for (let i = 0; i < imgPersonagemImortal.length; i++) {
    const imagem = new Image();
    imagem.src = imgPersonagemImortal[i];
    personagemImortalImages.push(imagem);
  }
}

function desenharPersonagem() {
  if (personagem.estaImortal && personagemImortalImages.length > 0) {
    const animacaoPersonagemImortal = personagemImortalImages[quadroAtual];
    ctx.drawImage(animacaoPersonagemImortal, personagem.x, personagem.y, personagem.imortalWidth, personagem.imortalHeight);
  } else {
    const imagemPersonagem = new Image();
    imagemPersonagem.src = '../assets/imagens_jogo/personagem.png';
    ctx.drawImage(imagemPersonagem, personagem.x, personagem.y, personagem.width, personagem.height);
  }
}

let velocidadeNormalTubo = 2;
carregarImagens();
const animacaoPersonagemImortal = new Image();
const imagemPersonagem = new Image();
const personagem = {
  x: 50,
  y: canvas.height / 2,
  width: 90,
  height: 90,
  imortalWidth: 120,
  imortalHeight: 120,
  velocidade: 0,
  pulo: 4.6,
  estaImortal: false,
  atualizar() {
    this.velocidade += gravidade;
    this.y += this.velocidade;

    if (framesRapidos) {
      if (tubos.velocidade < 5.3) {
        velocidadeNormalTubo = tubos.velocidade;
        tubos.velocidade = 5.3;
      } else if (tubos.velocidade > 5.3 && tubos.velocidade < 6.5) {
        velocidadeNormalTubo = tubos.velocidade;
        tubos.velocidade += 0.6;
      }
    } else {
      tubos.velocidade = velocidadeNormalTubo;
    }
  },
  desenhar() {
    if (personagem.estaImortal) {
      animacaoPersonagemImortal.src = imgPersonagemImortal[quadroAtual];
      ctx.drawImage(animacaoPersonagemImortal, this.x, this.y, this.imortalWidth, this.imortalHeight);
    } else {
      imagemPersonagem.src = '../assets/imagens_jogo/personagem.png';
      ctx.drawImage(imagemPersonagem, this.x, this.y, this.width, this.height);
    }
  },
  pegarEstrela() {
    this.estaImortal = true;

    framesRapidos = true;
    contador = 10;
    intervaloContagemRegressiva = setInterval(() => {
      if (contador > 0) {
        contador--;
      } else {
        clearInterval(intervaloContagemRegressiva);
      }
    }, 1000);

    setTimeout(() => {
      this.estaImortal = false;
      framesRapidos = false;
      clearInterval(intervaloContagemRegressiva);
    }, tempoInvencibilidade);
  },
};

let tempoUltimaAtualizacaoQuadro = 0;
const intervaloAtualizacaoQuadro = 300;

function atualizarAnimacaoPersonagemImortal(tempoAtual) {
  const deltaTempo = tempoAtual - tempoUltimaAtualizacaoQuadro;

  if (deltaTempo > intervaloAtualizacaoQuadro) {
    quadroAtual = (quadroAtual + 1) % imgPersonagemImortal.length;
    tempoUltimaAtualizacaoQuadro = tempoAtual;
  }
}

// aqui começa a gerar os tubos, ta fora da funcao pq ai nao pisca
const imagemTubo = new Image();
imagemTubo.src = '../assets/imagens_jogo/tubo.png';
const tubos = {
  width: 80,
  espaco: 220,
  maxHeight: canvas.height / 2,
  minHeight: 100,
  velocidade: 2,
  espacamentoEntreTubos: 300,
  list: [],

  atualizar() {
    if (frames % 50 === 0) {
      const height = Math.floor(Math.random() * (this.maxHeight - this.minHeight) + this.minHeight);
      const tuboAnterior = this.list[this.list.length - 1];
      const novaDistancia = tuboAnterior ? tuboAnterior.x + this.espacamentoEntreTubos : canvas.width;
      if (this.velocidade < 7 && !framesRapidos) {
        this.velocidade += 0.2;
        velocidadeNormalTubo = this.velocidade;
      }
      this.list.push({
        x: novaDistancia,
        y: 0,
        height,
      });
      this.list.push({
        x: novaDistancia,
        y: height + this.espaco,
        height: canvas.height - height - this.espaco,
      });
    }

    if (frames % 75 === 0) {
      const randomValue = Math.random();
      let tipoItem;
      if (randomValue <= 0.2) {
        tipoItem = 'estrela';
      } else if (randomValue <= 0.8) {
        tipoItem = 'carretel';
      }

      if (tipoItem) {
        const height = Math.floor(Math.random() * (this.maxHeight - this.minHeight) + this.minHeight);
        const tuboAnterior = this.list[this.list.length - 1];
        const novaDistancia = tuboAnterior ? tuboAnterior.x + this.espacamentoEntreTubos : canvas.width;
        this.list.push({
          x: novaDistancia,
          y: 0,
          height,
        });
        this.list.push({
          x: novaDistancia,
          y: height + this.espaco,
          height: canvas.height - height - this.espaco,
        });

        const itemY = height + this.espaco / 2 - (tipoItem === 'estrela' ? estrelas.height : carreteis.height) / 2;
        let itemSobreposto = false;
        for (const tubo of this.list) {
          if (
            tubo.x <= canvas.width &&
            tubo.x + this.width >= canvas.width &&
            (tubo.y > itemY || tubo.y + tubo.height < itemY + (tipoItem === 'estrela' ? estrelas.height : carreteis.height))
          ) {
            itemSobreposto = true;
            break;
          }
        }

        if (!itemSobreposto) {
          if (tipoItem === 'estrela') {
            estrelas.list.push({
              x: canvas.width,
              y: itemY,
              width: estrelas.width,
              height: estrelas.height,
            });
          } else if (tipoItem === 'carretel') {
            carreteis.list.push({
              x: canvas.width,
              y: itemY,
              width: carreteis.width,
              height: carreteis.height,
            });
          }
        }
      }
    }
    for (const tubo of this.list) {
      tubo.x -= this.velocidade;
      if (tubo.x + this.width < 0) this.list.shift();
    }
  },

  desenhar() {
    for (const tubo of this.list) {
      ctx.save();
      if (tubo.y === 0) {
        ctx.scale(1, -1);
        ctx.drawImage(imagemTubo, tubo.x, -tubo.y - tubo.height, this.width, tubo.height);
      } else {
        ctx.drawImage(imagemTubo, tubo.x, tubo.y, this.width, tubo.height);
      }
      ctx.restore();
    }
  },
};

const imagemEstrela = new Image();
imagemEstrela.src = '../assets/imagens_jogo/estrela.png';
const estrelas = {
  width: 40,
  height: 40,
  list: [],

  atualizar() {
    for (const estrela of this.list) {
      estrela.x -= tubos.velocidade;
      if (estrela.x + this.width < 0) this.list.shift();
    }
  },

  desenhar() {
    const deslocamentoHorizontal = (tubos.width - this.width) / 2;
    for (const estrela of this.list) {
      const x = estrela.x + deslocamentoHorizontal;
      ctx.drawImage(imagemEstrela, x, estrela.y, this.width, this.height);
    }
  },
};

const imagemCarretel = new Image();
imagemCarretel.src = '../assets/imagens_jogo/carretel.png';
const carreteis = {
  width: 40,
  height: 40,
  list: [],

  atualizar() {
    for (const carretel of this.list) {
      carretel.x -= tubos.velocidade;
      if (carretel.x + this.width < 0) this.list.shift();
    }
  },

  desenhar() {
    const deslocamentoHorizontal = (tubos.width - this.width) / 2;
    for (const carretel of this.list) {
      const x = carretel.x + deslocamentoHorizontal;
      ctx.drawImage(imagemCarretel, x, carretel.y, this.width, this.height);
    }
  },
};


let carreteisColetados = 0;
let tempoInicial = null; // Variável para armazenar o tempo de início
let tempoDecorrido = 0; // Variável para armazenar o tempo decorrido em segundos
let jogoFinalizado = false; // Variável de controle para verificar se o jogo finalizou
let tempoPausado = 0; // Variável para armazenar o tempo pausado


// função para ver se ocorreu uma colisão entre o personagem e o tubo
function collision(personagem, objeto) {
  const margemPermitida = 20; // margem para a imagem poder entrar um pouco antes de colidir

  const limiteEsquerdo = objeto.x + margemPermitida;
  const limiteDireito = objeto.x + tubos.width - margemPermitida;
  const limiteSuperior = objeto.y + margemPermitida;
  const limiteInferior = objeto.y + objeto.height - margemPermitida;

  // verificando se o personagem está dentro da área permitida
  return (
    personagem.x + personagem.width > limiteEsquerdo &&
    personagem.x < limiteDireito &&
    personagem.y + personagem.height > limiteSuperior &&
    personagem.y < limiteInferior
  );
}
function detectCollisions() {
  // Verifica a colisão com os tubos somente quando o personagem não está imortal
  if (!personagem.estaImortal) {
    for (const tubo of tubos.list) {
      if (collision(personagem, tubo)) {
        return true;
      }
    }
  }

  // Verifica a colisão com as estrelas somente quando o personagem não está imortal
  if (!personagem.estaImortal) {
    for (const estrela of estrelas.list) {
      if (collision(personagem, estrela)) {
        personagem.pegarEstrela();
        const index = estrelas.list.indexOf(estrela);
        if (index > -1) {
          estrelas.list.splice(index, 1);
        }
      }
    }
  } else {
    for (const estrela of estrelas.list) {
      if (collision(personagem, estrela)) {
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 1.7;
        const textoColetou = "Você já possui uma estrela! ";
        ctx.fillStyle = "yellow";


        ctx.font = "18px Silkscreen";
        const metricsColetou = ctx.measureText(textoColetou);
        const textWidthColetou = metricsColetou.width;
        const textXColetou = centerX - textWidthColetou / 2;

        ctx.fillText(textoColetou, textXColetou, centerY + 30);
      }
    }
  }

  // Permitindo que o personagem colete carretéis enquanto está imortal
  for (const carretel of carreteis.list) {
    if (collision(personagem, carretel)) {
      carreteisColetados += 1;
      const index = carreteis.list.indexOf(carretel);
      if (index > -1) {
        carreteis.list.splice(index, 1);
      }
    }
  }

  return personagem.y <= 0 || personagem.y + personagem.height >= canvas.height;
}


function desenharPontuacao() {
  //quadrado branco atrás do relógio
  ctx.fillStyle = "white";
  ctx.fillRect(800, 0, -120, 65);
  if (personagem.estaImortal) {
    const textoPrincipal = "VOCÊ ESTÁ IMORTAL!";
    const textoContador = "Tempo restante: " + contador;
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 3.8;

    ctx.font = "24px Silkscreen";
    const metricsPrincipal = ctx.measureText(textoPrincipal);
    const textWidthPrincipal = metricsPrincipal.width;
    const textXPrincipal = centerX - textWidthPrincipal / 2;

    ctx.fillStyle = "yellow";
    ctx.fillText(textoPrincipal, textXPrincipal, centerY);

    ctx.font = "18px Silkscreen";
    const metricsContador = ctx.measureText(textoContador);
    const textWidthContador = metricsContador.width;
    const textXContador = centerX - textWidthContador / 2;

    ctx.fillText(textoContador, textXContador, centerY + 30);
  }


  // Desenhar imagem de um carretel
  const carretelImg = new Image();
  carretelImg.src = "../assets/imagens_jogo/carretel.png";
  ctx.drawImage(carretelImg, 10, 10, 20, 20);

  // Desenhar imagem de um relógio
  const relogioImg = new Image();
  relogioImg.src = "../assets/imagens_jogo/relogio.png";
  ctx.drawImage(relogioImg, 750, 15, 40, 40);

  ctx.font = "20px Arial";
  ctx.fillStyle = "black";
  ctx.fillText(`${carreteisColetados}`, 40, 30);
  ctx.fillText(`${formatarTempo(tempoDecorrido)}`, 700, 45);
}

function formatarTempo(tempo) {
  const minutos = Math.floor((tempo % 3600) / 60);
  const segundos = tempo % 60;

  const formatoMinutos = minutos.toString().padStart(2, '0');
  const formatoSegundos = segundos.toString().padStart(2, '0');

  return `${formatoMinutos}:${formatoSegundos}`;
}

function atualizarTempoDecorrido(timestamp) {
  if (!tempoInicial) {
    tempoInicial = timestamp - tempoPausado;
  }

  const tempoPassado = Math.floor((timestamp - tempoInicial) / 1000); // Calcula o tempo passado em segundos
  tempoDecorrido = tempoPassado;

  if (!jogoFinalizado) {
    requestAnimationFrame(atualizarTempoDecorrido);
  }
}

let keys = {};
const SPACE_BAR_KEY_CODE = 32; // Código da tecla de espaço
const UP_ARROW_KEY_CODE = 38; // Código da seta para cima

window.addEventListener("keydown", (event) => {
  keys[event.keyCode] = true;

  if (jogando) {
    if (canvas && ([SPACE_BAR_KEY_CODE, UP_ARROW_KEY_CODE].includes(event.keyCode))) {
      event.preventDefault();
      personagem.velocidade = -personagem.pulo;
      if (somPulando.currentTime === 0 || somPulando.ended) {
        somPulando.currentTime = 0;
        somPulando.play();
      }
    }
  }

});

window.addEventListener("keyup", (event) => {
  delete keys[event.keyCode];
});

function contagemRegressiva() {
  let contador = 3;
  let scale = 1;

  const frameRate = 20; // Taxa de atualização dos frames (em milissegundos)
  const duration = 1000; // Duração de cada animação (em milissegundos)
  const numFrames = Math.floor(duration / frameRate); // Número de frames da animação
  let currentFrame = 0;

  const intervalo = setInterval(() => {
    if (contador > 0) {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.font = "80px Arial";

      if (currentFrame < numFrames / 2) {
        scale += 0.1;
      } else {
        scale -= 0.1;
      }

      ctx.save();
      ctx.translate(canvas.width / 2, canvas.height / 2);
      ctx.scale(scale, scale);
      ctx.fillStyle = "#910ba3";
      ctx.fillText(contador.toString(), -20, 20);
      ctx.restore();

      currentFrame++;

      if (currentFrame >= numFrames) {
        currentFrame = 0;
        contador--;
      }
    } else {
      clearInterval(intervalo);

      tempoInicial = null;
      tempoPausado = 0;
      jogoFinalizado = false;

      requestAnimationFrame(atualizarTempoDecorrido);

      startGameLoop();
    }
  }, frameRate);
}

// Pop-up que aparece quando entra na página do jogo: 

$(document).ready(function () {
  var currentPage = window.location.pathname.split("/").pop();
  if (currentPage == 'jogo.php') {
    let id_usuario = chave_sessao;
    sessionStorage.setItem('id_usuario', id_usuario);
    let showAlertJogo = localStorage.getItem('showAlertJogo_' + id_usuario);
    if (showAlertJogo !== 'false') {
      Swal.fire({
        html: `<div class="container" id="popup_instrucoes">
                <div class="row">
                  <div class="col-12">
                    <div id="instrucoes" class="carousel slide d-flex justify-content-center">
                      <ol id="indicadoresCarrosel" class="carousel-indicators carousel-indicators-bottom">
                          <li data-target="#instrucoes" data-slide-to="0" class="indicadorTutorial indicador active"></li>
                          <li data-target="#instrucoes" data-slide-to="1" class="indicadorTutorial indicador"></li>
                          <li data-target="#instrucoes" data-slide-to="2" class="indicadorTutorial indicador"></li>
                          <li data-target="#instrucoes" data-slide-to="3" class="indicadorTutorial indicador"></li>
                          <li data-target="#instrucoes" data-slide-to="4" class="indicadorTutorial indicador"></li>
                          <li data-target="#instrucoes" data-slide-to="5" class="indicadorTutorial indicador"></li>
                          <li data-target="#instrucoes" data-slide-to="6" class="indicadorTutorial indicador"></li>
                          <li data-target="#instrucoes" data-slide-to="7" class="indicadorTutorial indicador"></li>
                        </ol>
                        <div class="carousel-inner" id="carroselInner">
                          <div class="carrosel_item carousel-item active">
                            <h1 id="txtOla">Olá!</h1>    
                            <img src="../assets/imagens_jogo/personageminicio.png" alt="" class="imgInstrucao">
                            <h4 class="txtsJogo">Para jogar o Guess The Tissue siga as instruções a seguir!</h4>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4 class="txtsJogo">Utilize as seguintes teclas para se mover:</h4>    
                              <img src="../assets/imagens_jogo/instrucao1.gif" alt="" class="instrucao">
                              <p></p>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4 class="txtsJogo">O objetivo do jogo é coletar carretéis!</h1>    
                              <img src="../assets/imagens_jogo/instrucao5.gif" alt="" class="instrucao">
                              <p></p>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4 class="txtsJogo">Mas fique atento!</h4>    
                              <img src="../assets/imagens_jogo/instrucao2.gif" alt="" class="instrucao">
                              <p></p>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4 class="txtsJogo">...</h4>    
                              <img src="../assets/imagens_jogo/instrucao3.gif" alt="" class="instrucao">
                              <p></p>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4 class="txtsJogo">...</h4>    
                              <img src="../assets/imagens_jogo/instrucao4.gif" alt="" class="instrucao">
                              <p></p>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4 class="txtsJogo">Quanto mais carretéis coletados, maior a chance de chegar ao pódio do ranking e alcançar conquistas!</h4>    
                              <img src="../assets/imagens_jogo/podio.png" alt="" class="imgInstrucao">
                              <p></p>
                          </div>
                          <div class="carrosel_item carousel-item">
                              <h4>Vamos lá?</h4>    
                              <img src="../assets/imagens_jogo/personagem.png" alt="" class="imgInstrucao">
                              <p></p>
                          </div>
                        </div>
                        
                        <a class="carousel-control-prev carousel-control-start" href="#instrucoes" role="button" data-slide="prev" id="ante_jogo">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"></span>
                      </a>
                      <a class="carousel-control-next carousel-control-end" href="#instrucoes" role="button" data-slide="next" id="next_jogo">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"></span>
                      </a>
                    </div>
                    <div class="text-center">
                      <input type="checkbox" class="form-check-input" id="checkbox-tutorial-jogo" />
                      <label class="form-check-label" for="checkbox-tutorial-jogo">Não ver novamente</label>
                    </div>
                  </div>
                </div>
              </div>`,
        showCloseButton: true,
        confirmButtonText: 'Estou preparado!',
        didRender: () => {
          $('.carousel').carousel();
        },
      }).then((result) => {
        if (result.isConfirmed) {
          if ($('#checkbox-tutorial-jogo').is(':checked')) {
            localStorage.setItem('showAlertJogo_' + id_usuario, 'false');
          } else {
            localStorage.setItem('showAlertJogo_' + id_usuario, 'true');
          }
        }
      });

      $('.swal2-close').on('click', function () {
        if ($('#checkbox-tutorial-jogo').is(':checked')) {
          localStorage.setItem('showAlertJogo_' + id_usuario, 'false');
        }
      });

      $('.popover-link').popover({ trigger: 'focus' });
    }
  }
});

function ajudaJogo() {
  Swal.fire({
    html: `<div class="container" id="popup_instrucoes">
            <div class="row">
              <div class="col-12">
                <div id="instrucoes" class="carousel slide d-flex justify-content-center">
                  <ol id="indicadoresCarrosel" class="carousel-indicators carousel-indicators-bottom">
                      <li data-target="#instrucoes" data-slide-to="0" class="indicadorTutorial indicador active"></li>
                      <li data-target="#instrucoes" data-slide-to="1" class="indicadorTutorial indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="2" class="indicadorTutorial indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="3" class="indicadorTutorial indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="4" class="indicadorTutorial indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="5" class="indicadorTutorial indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="6" class="indicadorTutorial indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="7" class="indicadorTutorial indicador"></li>
                    </ol>
                    <div class="carousel-inner" id="carroselInner">
                      <div class="carrosel_item carousel-item active">
                        <h1 id="txtOla">Olá!</h1>    
                        <img src="../assets/imagens_jogo/personageminicio.png" alt="" class="imgInstrucao">
                        <h4 class="txtsJogo">Para jogar o Guess The Tissue siga as instruções a seguir!</h4>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4 class="txtsJogo">Utilize as seguintes teclas para se mover:</h4>    
                          <img src="../assets/imagens_jogo/instrucao1.gif" alt="" class="instrucao">
                          <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4 class="txtsJogo">O objetivo do jogo é coletar carretéis!</h1>    
                          <img src="../assets/imagens_jogo/instrucao5.gif" alt="" class="instrucao">
                          <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4 class="txtsJogo">Mas fique atento!</h4>    
                          <img src="../assets/imagens_jogo/instrucao2.gif" alt="" class="instrucao">
                          <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4 class="txtsJogo">...</h4>    
                          <img src="../assets/imagens_jogo/instrucao3.gif" alt="" class="instrucao">
                          <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4 class="txtsJogo">...</h4>    
                          <img src="../assets/imagens_jogo/instrucao4.gif" alt="" class="instrucao">
                          <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4 class="txtsJogo">Quanto mais carretéis coletados, maior a chance de chegar ao pódio do ranking e alcançar conquistas!</h4>    
                          <img src="../assets/imagens_jogo/podio.png" alt="" class="imgInstrucao">
                          <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                          <h4>Vamos lá?</h4>    
                          <img src="../assets/imagens_jogo/personagem.png" alt="" class="imgInstrucao">
                          <p></p>
                      </div>
                    </div>
                    
                    <a class="carousel-control-prev carousel-control-start" href="#instrucoes" role="button" data-slide="prev" id="ante_jogo">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"></span>
                  </a>
                  <a class="carousel-control-next carousel-control-end" href="#instrucoes" role="button" data-slide="next" id="next_jogo">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>`,
    showCloseButton: true,
    confirmButtonText: 'Entendi!',
    allowOutsideClick: true
  });


  $(document).ready(function () {
    $('.popover-link').popover({ trigger: 'focus' });
  });
};

function Ranking() {
  $.ajax({
    type: 'GET',
    url: '../database/ranking.php',
    dataType: 'json',
    success: function (data) {
      let html = "<h2>Ranking</h2><br>";
      html += `<table>
          <thead>
              <tr>
                  <th>Rank</th>
                  <th>Nome</th>
                  <th>Carretéis</th>
                  <th>Tempo</th>
                  <th>Patente</th>
              </tr>
          </thead>
          <tbody>`;

      for (var i = 0; i < data.length; i++) {
        var rank = i + 1;
        var apelido = data[i].apelido;
        var carreteis = data[i].carreteis;
        var tempo = data[i].tempo;
        var patente = data[i].patente;

        html += `<tr>
                      <td>${rank}</td>
                      <td>${apelido}</td>
                      <td>${carreteis}</td>
                      <td>${tempo}</td>
                      <td>${patente}</td>
                  </tr>`;
      }

      html += `</tbody>
              </table>`;


      Swal.fire({
        html: html,
        confirmButtonColor: '#8614e9',
        showCancelButton: false,
        confirmButtonText: 'Fechar',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCloseButton: true
      });
    },
  });

  $(document).ready(function () {
    $('.popover-link').popover({ trigger: 'focus' });
  });
};



function gameLoop() {
  let jogoIniciado = false;
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  frames = 0;
  personagem.y = canvas.height / 2;
  personagem.velocidade = 0;
  personagem.x = 50;
  tubos.list = [];
  tubos.velocidade = 2;
  velocidadeNormalTubo = 2;
  carreteis.list = [];
  carreteisColetados = 0;
  tempoDecorrido = 0;
  tempoInicial = null;
  
  const buttonWidth = 300;
  const buttonHeight = 50;
  const buttonX = canvas.width / 2 - buttonWidth / 2;
  const buttonY = canvas.height / 2 - (buttonHeight + 28); // Centralizado verticalmente

  const iniciarButton = {
    x: buttonX,
    y: buttonY,
    width: buttonWidth,
    height: buttonHeight,
    isHovered: false
  };

  const duvidaButton = {
    x: buttonX,
    y: buttonY + buttonHeight + 20,
    width: buttonWidth,
    height: buttonHeight,
    isHovered: false
  };

  const podioButton = {
    x: buttonX,
    y: buttonY + buttonHeight + 90,
    width: buttonWidth,
    height: buttonHeight,
    isHovered: false
  };

  const buttonSom = {
    x: 10,
    y: canvas.height - 50,
    width: 40,
    height: 40,
    isHovered: false,
    somImg: new Image(),
    mutadoImg: new Image()
  };

  buttonSom.somImg.src = "../assets/imagens_jogo/som.png";
  buttonSom.mutadoImg.src = "../assets/imagens_jogo/mutado.png";
  // feito pq a fonte nao tava carregando ao entrar na pagina 
  async function checkFontsReady() {
    return document.fonts.ready.then(function () {
      // Todas as fontes estão prontas
      drawButtons();
    });
  }

  // Verifica se as fontes estão carregadas antes de desenhar os botões
  checkFontsReady();

  function drawButton(button, buttonText) {
    ctx.fillStyle = button.isHovered ? "#a45ceb" : "#8614e9";
    ctx.fillRect(button.x, button.y, button.width, button.height);

    ctx.fillStyle = "#FFFFFF";
    ctx.font = "30px Silkscreen";
    const buttonTextX = button.x + button.width / 2 - ctx.measureText(buttonText).width / 2;
    const buttonTextY = button.y + button.height / 2 + 10;
    ctx.fillText(buttonText, buttonTextX, buttonTextY);
  }

  function drawButtons() {
   
    drawButton(iniciarButton, "Iniciar");
    drawButton(duvidaButton, "TUTORIAL");
    drawButton(podioButton, "PODIO");

    const buttonImg = estaMutado ? buttonSom.mutadoImg : buttonSom.somImg;
    ctx.drawImage(buttonImg, buttonSom.x, buttonSom.y, buttonSom.width, buttonSom.height);
  }


  // Função para verificar se o mouse está sobre o botão
  function checkHover(event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    iniciarButton.isHovered = (mouseX >= iniciarButton.x && mouseX <= iniciarButton.x + iniciarButton.width &&
      mouseY >= iniciarButton.y && mouseY <= iniciarButton.y + iniciarButton.height);
    duvidaButton.isHovered = (mouseX >= duvidaButton.x && mouseX <= duvidaButton.x + duvidaButton.width &&
      mouseY >= duvidaButton.y && mouseY <= duvidaButton.y + duvidaButton.height);
    podioButton.isHovered = (mouseX >= podioButton.x && mouseX <= podioButton.x + podioButton.width &&
      mouseY >= podioButton.y && mouseY <= podioButton.y + podioButton.height);
    buttonSom.isHovered = (mouseX >= buttonSom.x && mouseX <= buttonSom.x + buttonSom.width &&
      mouseY >= buttonSom.y && mouseY <= buttonSom.y + buttonSom.height);
      canvas.style.cursor = iniciarButton.isHovered || duvidaButton.isHovered || podioButton.isHovered || buttonSom.isHovered ? "pointer" : "default";
    drawButtons();
  }

  // Evento de quando o mouse entra nos botões
  canvas.addEventListener('mousemove', checkHover);

  // Evento de quando o mouse sai de cima dos botões
  canvas.addEventListener('mouseout', function (event) {
    iniciarButton.isHovered = false;
    duvidaButton.isHovered = false;
    canvas.style.cursor = "default";
    drawButtons();
  });

  // Evento de clique nos botões
  canvas.addEventListener('click', function (event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    if (mouseX >= iniciarButton.x && mouseX <= iniciarButton.x + iniciarButton.width &&
      mouseY >= iniciarButton.y && mouseY <= iniciarButton.y + iniciarButton.height &&
      !jogoIniciado) {
      jogoIniciado = true;
      canvas.removeEventListener('mousemove', checkHover);
      canvas.removeEventListener('mouseout', arguments.callee);
      canvas.removeEventListener('click', arguments.callee);
      canvas.style.cursor = "default";
      contagemRegressiva();
    }

    if (mouseX >= duvidaButton.x && mouseX <= duvidaButton.x + duvidaButton.width &&
      mouseY >= duvidaButton.y && mouseY <= duvidaButton.y + duvidaButton.height) {
      ajudaJogo();
    }
    if (mouseX >= podioButton.x && mouseX <= podioButton.x + podioButton.width &&
      mouseY >= podioButton.y && mouseY <= podioButton.y + podioButton.height) {
      Ranking();
    }

    if (mouseX >= buttonSom.x && mouseX <= buttonSom.x + buttonSom.width &&
      mouseY >= buttonSom.y && mouseY <= buttonSom.y + buttonSom.height) {
        estaMutado = !estaMutado;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        tocarMusica();
      drawButtons();
    }
  });

  drawButtons();
}

function mutarSom(){
  backgroundMusic.pause();
  somPulando.pause();
  backgroundMusicImortal.pause();
}

function tocarMusica() {
  if (estaMutado) {
    mutarSom();
  } else if (jogando){
    if (personagem.estaImortal) {
      backgroundMusic.pause();
      backgroundMusicImortal.play();
    } else {
      backgroundMusic.play();
      backgroundMusicImortal.pause();
      backgroundMusicImortal.currentTime = 0;
    }
  }
}

function startGameLoop(tempoAtual) {
  jogando = true;
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (personagem.tempoImortal > 0) {
    personagem.tempoImortal--;
  }

  tubos.atualizar();
  carreteis.atualizar();
  estrelas.atualizar();
  personagem.atualizar();
  tocarMusica();
  atualizarAnimacaoPersonagemImortal(tempoAtual);

  tubos.desenhar();
  carreteis.desenhar();
  estrelas.desenhar();
  personagem.desenhar();
  desenharPontuacao();

  if (keys[SPACE_BAR_KEY_CODE] || keys[UP_ARROW_KEY_CODE]) {
    personagem.velocidade = -personagem.pulo;
  }

  const colisaoComTubo = detectCollisions();
  if (colisaoComTubo) {
    gameOver();
    return;
  }

  for (const carretel of carreteis.list) {
    if (collision(personagem, carretel)) {
      carreteisColetados++;
      const index = carreteis.list.indexOf(carretel);
      carreteis.list.splice(index, 1);
    }
  }

  frames++;
  requestAnimationFrame(startGameLoop);
}

function gameOver() {
  let id_usuario = chave_sessao
  let id_patente = 0;

  switch (true) {
    case (carreteisColetados <= 2):
      id_patente = 1; // Poliéster
      break;
    case (carreteisColetados <= 5):
      id_patente = 2; // Seda
      break;
    case (carreteisColetados <= 10):
      id_patente = 3; // Viscose
      break;
    case (carreteisColetados <= 12):
      id_patente = 4; // Malha Sintética
      break;
    case (carreteisColetados <= 15):
      id_patente = 5; // Bambu
      break;
    case (carreteisColetados <= 20):
      id_patente = 6; // Tencel
      break;
    case (carreteisColetados <= 25):
      id_patente = 7; // Linho
      break;
    case (carreteisColetados <= 35):
      id_patente = 8; // Lã
      break;
    case (carreteisColetados <= 49):
      id_patente = 9; // Algodão
      break;
    default:
      id_patente = 9;
      break;
  }

  $.ajax({
    type: 'POST',
    url: '../src/dados_ranking.php',
    data: {
      tempo: formatarTempo(tempoDecorrido),
      carreteisColetados: carreteisColetados,
      id_usuario: id_usuario,
      id_patente: id_patente
    },
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });

  jogando = false;
  backgroundMusic.pause();
  backgroundMusic.currentTime = 0;
  backgroundMusicImortal.pause();
  backgroundMusicImortal.currentTime = 0;
  Swal.fire({
    title: "Fim de jogo!",
    html:
      "<img id='imgpersonagem' src='../assets/imagens_jogo/personagemtriste.png'>" +
      "<p>Carretéis coletados: " + carreteisColetados + "</p>" +
      "<p>Tempo decorrido: " + formatarTempo(tempoDecorrido) + "</p>" +
      "<br>",
    confirmButtonColor: '#8614e9',
    showCancelButton: false,
    confirmButtonText: 'Jogar Novamente',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCloseButton: true,
  })
    .then((result) => {
      if (result.value) {
        restartGame();
      }
      else {
        gameLoop();
      }
    });
}

function restartGame() {

  frames = 0;
  personagem.y = canvas.height / 2;
  personagem.x = 50;
  personagem.velocidade = 0;
  tubos.list = [];
  tubos.velocidade = 2;
  velocidadeNormalTubo = 2;
  carreteis.list = [];
  estrelas.list = [];
  carreteisColetados = 0;
  tempoDecorrido = 0;
  tempoInicial = null;
  personagem.tempoImortal = 0;
  personagem.estaImortal = 0;

  contagemRegressiva();
}

function atualizartempoDecorrido() {
  tempoDecorrido++;
  setTimeout(atualizartempoDecorrido, 1000);
}

gameLoop();