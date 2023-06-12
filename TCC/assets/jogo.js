const canvas = document.getElementById("jogoCanvas");
const ctx = canvas.getContext("2d");

// Variáveis do jogo
let frames = 0;
const gravidade = 0.25;
const personagem = {
  x: 50,
  y: canvas.height / 2,
  width: 90,
  height: 90,
  velocidade: 0,
  pulo: 4.6,
  atualizar() {
    this.velocidade += gravidade;
    this.y += this.velocidade;
  },
  desenhar() {
    const imagemPersonagem = new Image();
    imagemPersonagem.src = '../assets/personagem.png';
    ctx.drawImage(imagemPersonagem, this.x, this.y, this.width, this.height);
  },
};

// Função de atualização do jogo
function atualizarJogo() {
  frames++;
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  personagem.atualizar();
  personagem.desenhar();
  requestAnimationFrame(atualizarJogo);
}


const tubos = {
  width: 80,
  espaco: 220,
  maxHeight: canvas.height / 2,
  minHeight: 100,
  velocidade: 2,
  espacamentoEntreTubos: 300,
  list: [],
  atualizar() {
    if (frames % 100 === 0) {
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

      const existeCarretel = Math.random() < 0.5;
      if (existeCarretel) {
        const carretelY = height + this.espaco / 2 - carreteis.height / 2;
        let carretelSobreposto = false;
        for (const tubo of this.list) {
          if (
            tubo.x <= canvas.width &&
            tubo.x + this.width >= canvas.width &&
            (tubo.y > carretelY || tubo.y + tubo.height < carretelY + carreteis.height)
          ) {
            carretelSobreposto = true;
            break;
          }
        }
        if (!carretelSobreposto) {
          carreteis.list.push({
            x: canvas.width,
            y: carretelY,
            width: carreteis.width,
            height: carreteis.height,
          });
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
      ctx.save(); // Salva o estado atual do contexto
      if (tubo.y === 0) {
        // Inverte a imagem verticalmente se o tubo estiver no topo
        ctx.scale(1, -1);
        ctx.drawImage(imagemTubo, tubo.x, -tubo.y - tubo.height, this.width, tubo.height);
      } else {
        ctx.drawImage(imagemTubo, tubo.x, tubo.y, this.width, tubo.height);
      }
      ctx.restore(); // Restaura o estado anterior do contexto
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

    // Calcular o deslocamento horizontal necessário para centralizar os carretéis
    const deslocamentoHorizontal = (tubos.width - this.width) / 2;

    for (const carretel of this.list) {
      // Definir a posição x do carretel com o deslocamento horizontal
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

function collision(personagem, tubo) {
  const margemPermitida = 20; // margem para a imagem poder entrar um pouco antes de colidir

  const limiteEsquerdo = tubo.x + margemPermitida;
  const limiteDireito = tubo.x + tubos.width - margemPermitida;
  const limiteSuperior = tubo.y + margemPermitida;
  const limiteInferior = tubo.y + tubo.height - margemPermitida;
  // verificando se o personagem ta dentro da area permitida
  return (
    personagem.x + personagem.width > limiteEsquerdo &&
    personagem.x < limiteDireito &&
    personagem.y + personagem.height > limiteSuperior &&
    personagem.y < limiteInferior
  );
}


function detectCollisions() {
  for (const tubo of tubos.list) {
    if (collision(personagem, tubo)) {
      return true;
    }
  }
  for (const carretel of carreteis.list) {
    if (collision(personagem, carretel)) { // se ocorrer uma "colisão" entre o personagem e o carretel,retorna true e adiciona a pontuação de carreteis coletados
      carreteisColetados++;
      const index = carreteis.list.indexOf(carretel);
      carreteis.list.splice(index, 1); // remove o carretel com o indice correto apenas 1 vez
    }
  }

  return personagem.y <= 0 || personagem.y + personagem.height >= canvas.height;
}


function desenharPontuacao() {
  //quadrado branco atrás do relógio
  ctx.fillStyle = "white";
  ctx.fillRect(800, 0, -120, 65);

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

  function pausarTempo() {
    if (!jogoFinalizado && tempoInicial) { // jogoFinalizado é falso, tempoInicial não é nulo, garante que o tempo só será pausado se o jogo estiver em andamento
      tempoPausado = performance.now() - tempoInicial; //tempo percorrido até a pausa , performance.now() retorna o tempo atual,  ex: 10-0 = 10 segundos
      jogoFinalizado = true; //jogo finalizado
    }
  }
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
    
      $(document).ready(function(){
        $('.popover-link').popover({ trigger: 'focus' });
      });
    };
    

function gameLoop() {
  let jogoIniciado = false;
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  frames = 0;
  personagem.y = canvas.height / 2;
  personagem.velocidade = 0;
  tubos.list = [];
  carreteis.list = [];
  carreteisColetados = 0;
  tempoDecorrido = 0;
  tempoInicial = null;

  const buttonWidth = 300;
  const buttonHeight = 50;
  const buttonX = canvas.width / 2 - buttonWidth / 2;
  const buttonY = canvas.height / 2 - buttonHeight / 2; // Centralizado verticalmente

  const button = {
    x: buttonX,
    y: buttonY,
    width: buttonWidth,
    height: buttonHeight,
    isHovered: false
  };

  function drawButton() {
    ctx.fillStyle = button.isHovered ? "#a45ceb" : "#8614e9";
    ctx.fillRect(button.x, button.y, button.width, button.height);

    ctx.fillStyle = "#FFFFFF";
    ctx.font = "30px Silkscreen";
    const buttonText = "Iniciar";
    const buttonTextX = button.x + button.width / 2 - ctx.measureText(buttonText).width / 2;
    const buttonTextY = button.y + button.height / 2 + 10;
    ctx.fillText(buttonText, buttonTextX, buttonTextY);
  }

  // Função para verificar se o mouse está sobre o botão
  function checkHover(event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    button.isHovered = (mouseX >= button.x && mouseX <= button.x + button.width &&
      mouseY >= button.y && mouseY <= button.y + button.height);
    canvas.style.cursor = button.isHovered ? "pointer" : "default";
    drawButton();
  }

  // Evento de quando o mouse entra no botão
  canvas.addEventListener('mousemove', checkHover);

  // Evento de quando o mouse sai de cima do botão
  canvas.addEventListener('mouseout', function (event) {
    button.isHovered = false;
    canvas.style.cursor = "default";
  });

  canvas.addEventListener('click', function (event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    if (mouseX >= button.x && mouseX <= button.x + button.width &&
      mouseY >= button.y && mouseY <= button.y + button.height &&
      !jogoIniciado) {
      jogoIniciado = true;
      canvas.removeEventListener('mousemove', checkHover);
      canvas.removeEventListener('mouseout', arguments.callee);
      canvas.removeEventListener('click', gameLoop);
      canvas.style.cursor = "default";
      contagemRegressiva();
    }
  });

  drawButton();
}

function startGameLoop() {

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  personagem.atualizar();
  tubos.atualizar();
  carreteis.atualizar();


  personagem.desenhar();
  tubos.desenhar();
  carreteis.desenhar();
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
  personagem.velocidade = 0;
  tubos.list = [];
  carreteis.list = [];
  carreteisColetados = 0;
  tempoDecorrido = 0;
  tempoInicial = null;

  contagemRegressiva();
}

function atualizartempoDecorrido() {
  tempoDecorrido++;
  setTimeout(atualizartempoDecorrido, 1000);
}

gameLoop();