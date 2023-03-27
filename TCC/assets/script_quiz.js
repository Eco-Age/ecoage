let pontuacao_quiz = 0;

let id_usuario = chave_sessao;

sessionStorage.setItem('quizCompleto_', + id_usuario, 'false');
function quiz() {

  if (sessionStorage.getItem('quizCompleto_' + id_usuario) === 'true'){
    Swal.fire({
        title: 'Você já finalizou esse quiz. Gostaria de jogar outra vez?',
        html: `<p>Sua pontuação anterior foi de ${pontuacao_quiz} de 4</p>
               <p style="font-size: 15px;">OBS: Seus pontos são resetados ao sair da conta</p>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sim, vamos jogar!',
        cancelButtonText: 'Talvez mais tarde'
      }).then((result) => {
        if (result.isConfirmed){
            sessionStorage.setItem('quizCompleto_' + id_usuario, 'false');
            pontuacao_quiz = 0;
            pergunta1();
        }
      });
  }else {
  Swal.fire({
    icon: 'info',
    title: 'Olá, meu nobre!',
    text: 'Antes de continuar navegando, que tal avaliar seu nível de conhecimento sobre tecidos sustentáveis?',
    showCancelButton: true,
    confirmButtonText: 'Quero avaliar!',
    cancelButtonText: 'Mais tarde'
  }).then((result) => {
    if (result.isConfirmed) {
      pergunta1();
    }
  });
}
}

function pergunta1() {
    Swal.fire({
      icon: 'question',
      title: 'Pergunta 1',
      text: 'Dentre os tecidos abaixo, qual é o mais sustentável?',
      confirmButtonText: 'Responder',
      allowOutsideClick: false,
      input: 'radio',
      inputOptions: {
        'Poliéster': 'Poliéster',
        'Linho': 'Linho'
      },
      inputValidator: (value) => {
        if (value === 'Linho') {
          pontuacao_quiz++;
          Swal.fire({
            title: 'Parabéns!',
            text: 'Você acertou!',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Próxima pergunta',
            cancelButtonText: 'Sair'
          }).then((result) => {
            if (result.isConfirmed) {
              pergunta2();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.fire({
                title: 'Quiz fechado',
                text: 'Seu progresso foi resetado',
                icon: 'info',
                confirmButtonText: 'Ok'
              });
              pontuacao_quiz = 0;
            }
          });
        } else {
          Swal.fire({
            title: 'Resposta incorreta!',
            text: 'A resposta correta é Linho!',
            icon: 'error',
            confirmButtonText: 'Próxima pergunta',
            showCancelButton: true,
            cancelButtonText: 'Sair'
          }).then((result) => {
            if (result.isConfirmed) {
              pergunta2();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.fire({
                title: 'Quiz fechado',
                text: 'Seu progresso foi resetado',
                icon: 'info',
                confirmButtonText: 'Ok'
              });
              pontuacao_quiz = 0;
            }
          });
        }
      }
    });
  }
  
  function pergunta2() {
    Swal.fire({
      icon: 'question',
      title: 'Pergunta 2',
      text: 'Dentre os tecidos abaixo, qual gasta mais água na fábricação?',
      confirmButtonText: 'Responder',
      allowOutsideClick: false,
      input: 'radio',
      inputOptions: {
        'Seda': 'Seda',
        'Bambu': 'Bambu'
      },
      inputValidator: (value) => {
        if (value === 'Seda') {
          pontuacao_quiz++;
          Swal.fire({
            title: 'Parabéns!',
            text: 'Você acertou!',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Próxima pergunta',
            cancelButtonText: 'Sair'
          }).then((result) => {
            if (result.isConfirmed) {
              pergunta3();
            } else if (result.dismiss) {
              Swal.fire({
                title: 'Quiz fechado',
                text: 'Seu progresso foi resetado',
                icon: 'info',
                confirmButtonText: 'Ok'
              });
              pontuacao_quiz = 0;
            }
          });
        } else {
          Swal.fire({
            title: 'Resposta incorreta!',
            text: 'A resposta correta é Seda!',
            icon: 'error',
            confirmButtonText: 'Próxima pergunta',
            showCancelButton: true,
            cancelButtonText: 'Sair'
          }).then((result) => {
            if (result.isConfirmed) {
              pergunta3();
            } else if (result.dismiss) {
              Swal.fire({
                title: 'Quiz fechado',
                text: 'Seu progresso foi resetado',
                icon: 'info',
                confirmButtonText: 'Ok'
              });
              pontuacao_quiz = 0;
            }
          });
        }
      }
    });
  }
  

function pergunta3() {
    let acertou_3 = false;
  acertou_3 = false;

  Swal.fire({
    icon: 'question',
    title: 'Pergunta 3',
    allowOutsideClick: false,
    text: 'Qual a porcentagem de fibras naturais que um tecido deve ter para ser considerado sustentável?',
    input: 'range',
    inputAttributes: {
      min: 0,
      max: 100,
      step: 5,
      value: 50
    },
    inputValue: 50,
    inputLabel: 'Porcentagem:',
    confirmButtonText: 'Responder',
    preConfirm: (value) => {
      if (value >= 50 && value <= 80) {
        pontuacao_quiz++;
        acertou_3 = true;
        return true;
      }
    }
  }).then((result) => {
    if (result.isConfirmed) {
      if (acertou_3) {
        Swal.fire({
          title: 'Parabéns!',
          text: `Você está certo! A resposta é entre 50% e 80%!`,
          icon: 'success',
          showCancelButton: true,
          cancelButtonText: 'Sair',
          confirmButtonText: 'Próxima pergunta'
        }).then((result) => {
            if (result.isConfirmed) {
              pergunta4();
            } else if (result.dismiss) {
              Swal.fire({
                title: 'Quiz fechado',
                text: 'Seu progresso foi resetado',
                icon: 'info',
                confirmButtonText: 'Ok'
              });
              pontuacao_quiz = 0;
            }
          });
      } else {
        Swal.fire({
          title: 'Resposta incorreta!',
          text: 'A resposta correta é entre 50% e 80%!',
          icon: 'error',
          showCancelButton: true,
          cancelButtonText: 'Sair',
          confirmButtonText: 'Próxima pergunta'
        }).then((result) => {
            if (result.isConfirmed) {
              pergunta4();
            } else if (result.dismiss) {
              Swal.fire({
                title: 'Quiz fechado',
                text: 'Seu progresso foi resetado',
                icon: 'info',
                confirmButtonText: 'Ok',
              });
              pontuacao_quiz = 0;
            }
        });
      }
    }
  });
}


function pergunta4() {
  Swal.fire({
    title: 'Pergunta final!',
    text: 'Qual tecido é considerado o mais ecológico?',
    confirmButtonText: 'Responder',
    allowOutsideClick: false,
    input: 'radio',
    inputOptions: {
      'Algodão Orgânico': 'Algodão Orgânico',
      'Linho': 'Linho',
      'Bambu': 'Bambu',
      'Tencel': 'Tencel'
    },
    inputValidator: (value) => {
      if (value === 'Tencel') {
        pontuacao_quiz++;
        Swal.fire({
          title: 'Parabéns!',
          text: 'Você acertou!',
          icon: 'success',
          showCancelButton: true,
          confirmButtonText: 'Finalizar quiz',
          cancelButtonText: 'Sair'
        }).then((result) => {
          if (result.isConfirmed) {
            sessionStorage.setItem('quizCompleto_' + id_usuario, 'true');
            Swal.fire({
              title: 'Pontuação',
              text: `Parabéns por terminar o quiz! Sua pontuação é ${pontuacao_quiz} de 4.`,
              icon: 'info',
              confirmButtonText: 'Finalizar quiz'
            });
          }
        });
      } else {
        Swal.fire({
          title: 'Resposta incorreta!',
          text: 'A resposta correta é Tencel!',
          icon: 'error',
          confirmButtonText: 'Finalizar quiz'
        }).then((result) => {
          sessionStorage.setItem('quizCompleto_' + id_usuario, 'true');
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Pontuação',
              text: `Parabéns por terminar o quiz! Sua pontuação é ${pontuacao_quiz} de 4.`,
              icon: 'info',
              confirmButtonText: 'Finalizar quiz'
            });
          }
        });
      }
    }
  });
}

  