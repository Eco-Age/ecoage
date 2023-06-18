const canvas = document.getElementById("jogoCanvas");
const ctx = canvas.getContext("2d");

// Variáveis do jogo
let frames = 0;
const gravidade = 0.25;
const tempoInvencibilidade = 5000; // Tempo em milissegundos para o personagem ficar invencível
const tempoFramesRapidos = 5000; // Tempo em milissegundos para os frames passarem mais rápido
let framesRapidos = false;
let contador = 5; // tempo restante qnd ta imortal
let intervaloContagemRegressiva;
const imgPersonagemImortal = [
  '../assets/personagemImortal1.png',
  '../assets/personagemImortal2.png',
  '../assets/personagemImortal3.png'
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
    imagemPersonagem.src = '../assets/personagem.png';
    ctx.drawImage(imagemPersonagem, personagem.x, personagem.y, personagem.width, personagem.height);
  }
}

// Carregar as imagens antes de iniciar a animação
let velocidadeNormalTubo = 2;
carregarImagens();
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
        tubos.velocidade += 1;
      }
    } else {
      tubos.velocidade = velocidadeNormalTubo;
    }
  },
  desenhar() {
    const animacaoPersonagemImortal = new Image();
    const imagemPersonagem = new Image();
    if (personagem.estaImortal) {
      animacaoPersonagemImortal.src = imgPersonagemImortal[quadroAtual];
      ctx.drawImage(animacaoPersonagemImortal, this.x, this.y, this.imortalWidth, this.imortalHeight);
    } else {
      imagemPersonagem.src = '../assets/personagem.png';
      ctx.drawImage(imagemPersonagem, this.x, this.y, this.width, this.height);
    }
  },
  pegarEstrela() {
    this.estaImortal = true;

    framesRapidos = true;

    // Inicializa o contador e o intervalo
    contador = 5;
    intervaloContagemRegressiva = setInterval(() => {
      if (contador > 0) {
        contador--;
      } else {
        // Se o contador atingir 0, limpe o intervalo
        clearInterval(intervaloContagemRegressiva);
      }
    }, 1000);

    setTimeout(() => {
      this.estaImortal = false;
      framesRapidos = false;
      // Limpa o intervalo quando a imortalidade acaba
      clearInterval(intervaloContagemRegressiva);
    }, tempoInvencibilidade);
  },
};

function atualizarQuadro(tempoAtual) {
  const deltaTempo = tempoAtual - tempoUltimoQuadro;

  if (deltaTempo > quadroIntervalo) {
    quadroAtual = (quadroAtual + 1) % imgPersonagemImortal.length;
    tempoUltimoQuadro = tempoAtual;
  }

  requestAnimationFrame(atualizarQuadro);
}

// Função de atualização do jogo
/*function atualizarJogo() {
  frames++;
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  personagem.atualizar();
  personagem.desenhar();
  requestAnimationFrame(atualizarJogo);
}*/ // parece inutil 

// aqui começa a gerar os tubos
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
    const imagemTubo = new Image();
    imagemTubo.src = '../assets/tubo.png';
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
    const imagemEstrela = new Image();
    imagemEstrela.src = '../assets/estrela.png';
    const deslocamentoHorizontal = (tubos.width - this.width) / 2;
    for (const estrela of this.list) {
      const x = estrela.x + deslocamentoHorizontal;
      ctx.drawImage(imagemEstrela, x, estrela.y, this.width, this.height);
    }
  },
};

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
    const imagemCarretel = new Image();
    imagemCarretel.src = '../assets/carretel.png';
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
  carretelImg.src = "../assets/carretel.png";
  ctx.drawImage(carretelImg, 10, 10, 20, 20);

  // Desenhar imagem de um relógio
  const relogioImg = new Image();
  relogioImg.src = "../assets/relogio.png";
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

// Adicione o evento de teclado global para capturar as teclas pressionadas
window.addEventListener("keydown", (event) => {
  keys[event.keyCode] = true;

  // Verifique se o evento ocorreu dentro do canvas do jogo antes de executar a ação de pulo
  if (canvas && ([SPACE_BAR_KEY_CODE, UP_ARROW_KEY_CODE].includes(event.keyCode))) {
    event.preventDefault();
    personagem.velocidade = -personagem.pulo;
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
        scale += 0.1; // Aumenta a escala na primeira metade da animação
      } else {
        scale -= 0.1; // Diminui a escala na segunda metade da animação
      }

      ctx.save();
      ctx.translate(canvas.width / 2, canvas.height / 2);
      ctx.scale(scale, scale);
      ctx.fillStyle = "#910ba3";
      ctx.fillText(contador.toString(), -20, 20); // Desenha o número no ponto central deslocado (-20, 20)
      ctx.restore();

      currentFrame++;

      if (currentFrame >= numFrames) {
        currentFrame = 0;
        contador--;
      }
    } else {
      clearInterval(intervalo);

      // Redefinir as variáveis relacionadas ao tempo
      tempoInicial = null;
      tempoPausado = 0;
      jogoFinalizado = false;

      // Iniciar o cronômetro
      requestAnimationFrame(atualizarTempoDecorrido);

      // Iniciar o loop do jogo
      startGameLoop();
    }
  }, frameRate);
}


$(document).ready(function () {
  var currentPage = window.location.pathname.split("/").pop();
  if (currentPage == 'jogo.php') {
    let id_usuario = chave_sessao;
    sessionStorage.setItem('id_usuario', id_usuario);
    let showAlert = localStorage.getItem('showAlert_' + id_usuario);
    if (showAlert !== 'false') {
      Swal.fire({
        title: 'Bem vindo(a)!',
        html: `<div class="container" id="popup_instrucoes">
                <div class="row">
                    <div class="col-12">
                      <h3></h3>
                    </div>
                </div>
                
                <div class="row">
                <div class="col-12">
                  <div id="instrucoes" class="carousel slide" data-ride="carousel">
                    <ol id="indicadoresCarrosel" class="carousel-indicators">
                      <li data-target="#instrucoes" data-slide-to="0" class="indicador active"></li>
                      <li data-target="#instrucoes" data-slide-to="1" class="indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="2" class="indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="3" class="indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="4" class="indicador"></li>
                    </ol>
                  <div class="carousel-inner">
                    <div class="carrosel_item carousel-item active">
                        <img src="../assets/personageminicio.png" alt="" id="instrucao1">
                        <p>Olá!Para jogar o Guess The Tissue siga as intruções a seguir</p>
                      </div>
                      <div class="carrosel_item carousel-item">
                        <img src="../assets/instrucao1.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                        <img src="../assets/instrucao5.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                        <img src="../assets/instrucao2.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                        <img src="../assets/instrucao3.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carrosel_item carousel-item">
                        <img src="../assets/instrucao4.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                    </div>
                    
                    <a class="carousel-control-prev" href="#instrucoes" role="button" data-slide="prev">
                      <span class="carousel-control  material-icons" aria-hidden="true" id="ante_jogo">
                        chevron_left
                      </span>
                    </a>
                    <a class="carousel-control-next" href="#instrucoes" role="button" data-slide="next">
                      <span class="carousel-control  material-icons" aria-hidden="true" id="next_jogo">
                        chevron_right                     
                      </span>
                    </a>
                  </div>                 
                </div>
              </div>
              
                  <input type="checkbox" class="form-check-input" id="checkbox-avisar" />
                  <label class="form-check-label" for="checkbox-avisar">Não ver novamente</label>
          </div>`,
        icon: 'info',
        showCloseButton: true,
        confirmButtonText: 'Estou preparado!',
        didRender: () => {
          $('.carousel').carousel();
        },
      }).then((result) => {
        if (result.isConfirmed) {
          if ($('#checkbox-avisar').is(':checked')) {
            localStorage.setItem('showAlert_' + id_usuario, 'false');
          } else {
            localStorage.setItem('showAlert_' + id_usuario, 'true');
          }
        }
      });

      $('.swal2-close').on('click', function () {
        if ($('#checkbox-avisar').is(':checked')) {
          localStorage.setItem('showAlert_' + id_usuario, 'false');
        }
      });

      $('.popover-link').popover({ trigger: 'focus' });
    }
  }
});

function ajudaJogo() {
  Swal.fire({
    title: 'Bem vindo(a)!',
    html: `<div class="container" id="popup_instrucoes">
                <div class="row">
                    <div class="col-12">
                      <h3></h3>
                    </div>
                </div>
                
                <div class="row">
                <div class="col-12">
                  <div id="instrucoes" class="carousel slide" data-ride="carousel">
                    <ol id="indicadoresCarrosel" class="carousel-indicators">
                      <li data-target="#instrucoes" data-slide-to="0" class="indicador active"></li>
                      <li data-target="#instrucoes" data-slide-to="1" class="indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="2" class="indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="3" class="indicador"></li>
                      <li data-target="#instrucoes" data-slide-to="4" class="indicador"></li>
                    </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../assets/personageminicio.png" alt="" id="instrucao1">
                        <p>Olá!Para jogar o Guess The Tissue siga as intruções a seguir</p>
                      </div>
                      <div class="carousel-item">
                        <img src="../assets/instrucao1.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carousel-item">
                        <img src="../assets/instrucao5.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carousel-item">
                        <img src="../assets/instrucao2.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carousel-item">
                        <img src="../assets/instrucao3.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                      <div class="carousel-item">
                        <img src="../assets/instrucao4.gif" alt="" class="instrucao">
                        <p></p>
                      </div>
                    </div>
                    
                    <a class="carousel-control-prev" href="#instrucoes" role="button" data-slide="prev">
                      <span class="carousel-control  material-icons" aria-hidden="true" id="ante_jogo">
                        chevron_left
                      </span>
                    </a>
                    <a class="carousel-control-next" href="#instrucoes" role="button" data-slide="next">
                      <span class="carousel-control  material-icons" aria-hidden="true" id="next_jogo">
                        chevron_right                     
                      </span>
                    </a>
                  </div>                 
                </div>
              </div>
          </div>`,
    icon: "info",
    confirmButtonText: 'Entendi!',
    allowOutsideClick: true
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
  const buttonY = canvas.height / 2 - buttonHeight; // Centralizado verticalmente

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
 // feito pq a fonte nao tava carregando ao entrar na pagina 
  async function checkFontsReady() {
    return document.fonts.ready.then(function() {
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
    canvas.style.cursor = iniciarButton.isHovered || duvidaButton.isHovered ? "pointer" : "default";
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
      canvas.removeEventListener('click', gameLoop);
      canvas.style.cursor = "default";
      contagemRegressiva();
    }

    if (mouseX >= duvidaButton.x && mouseX <= duvidaButton.x + duvidaButton.width &&
      mouseY >= duvidaButton.y && mouseY <= duvidaButton.y + duvidaButton.height) {
      ajudaJogo();
    }
  });

  drawButtons();
}


function startGameLoop() {

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (personagem.tempoImortal > 0) {
    personagem.tempoImortal--;
  }
  tubos.atualizar();
  carreteis.atualizar();
  estrelas.atualizar();
  personagem.atualizar();
  atualizarQuadro();
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
  Swal.fire({
    title: "Fim de jogo!",
    html:
      "<img id='imgpersonagem' src='../assets/personagemtriste.png'>" +
      "<p>Carretéis coletados: " + carreteisColetados + "</p>" +
      "<p>Tempo decorrido: " + formatarTempo(tempoDecorrido) + "</p>" +
      "<br>",
    confirmButtonColor: '#8614e9',
    showCancelButton: false,
    confirmButtonText: 'Jogar Novamente',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCloseButton: true, // Adiciona o botão de fechar
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

  contagemRegressiva();
}

function atualizartempoDecorrido() {
  tempoDecorrido++;
  setTimeout(atualizartempoDecorrido, 1000);
}

gameLoop();