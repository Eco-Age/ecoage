const password = document.getElementById('senha_login');
const icon = document.getElementById('icon');

function mostrarOcultar_login() {
  if (password.type === 'password') {
    password.setAttribute('type', 'text');
    icon.classList.add('ocultar');
  } else {
    password.setAttribute('type', 'password');
    icon.classList.remove('ocultar');
  }
}

const password_cadastro = document.getElementById('senha_cadastro');
const icon_cadastro = document.getElementById('icon_cadastro');

function mostrarOcultar_cadastro() {
  if (password_cadastro.type === 'password') {
    password_cadastro.setAttribute('type', 'text');
    icon_cadastro.classList.add('ocultar');
  } else {
    password_cadastro.setAttribute('type', 'password');
    icon_cadastro.classList.remove('ocultar');
  }
}

const password_edicao = document.getElementById('senha_cadastro');

function mostrarOcultar_edicao() {
  if (password_edicao.type === 'password') {
    password_edicao.setAttribute('type', 'text');
    icon_edicao.classList.add('ocultar');
  } else {
    password_edicao.setAttribute('type', 'password');
    icon_edicao.classList.remove('ocultar');
  }
}

function confirmar_edicao_tecido(form) {

  swal.fire({
    title: "Deseja realmente alterar o tecido?",
    text: "Cuidado! Em caso de arrependimento, seus dados deverão novamente ser editados.",
    icon: "warning",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, editar',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false
  })
    .then((result) => {
      if (result.value) {
        form.submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swal.fire(
          'Edição cancelada.',
          'O Tecido não foi editado',
          'success'
        )
      }
    });
  return false;
}

function confirmar_edicao_noticia(form) {

  swal.fire({
    title: "Deseja realmente alterar a notícia?",
    text: "Cuidado! Em caso de arrependimento, seus dados deverão novamente ser editados.",
    icon: "warning",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, editar',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false
  })
    .then((result) => {
      if (result.value) {
        form.submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swal.fire(
          'Edição cancelada.',
          'O Tecido não foi editado',
          'success'
        )
      }
    });
  return false;
}

function duvida_token() {
  Swal.fire({
    icon: 'question',
    title: 'Por que recebi esse erro?',
    html: `<p>Há uma série de motivos pelos quais este erro pode ter acontecido.</p>
           <p>1. Certifique-se de que o código recebido no email é exatamente o código que foi digitado. </p>
           <p>2. Certifique-se de que o código que está usando ainda não expirou (não passaram mais de 5 minutos).</p>
           <p>3. Certifique-se de estar utilizando o código mais atual (caso solicite a recuperação duas vezes ou mais, o único código válido é o último a ser enviado).</p>`,
    showCancelButton: false,
    confirmButtonText: 'Entendi!'

  })
}

function duvida_codigo() {
  Swal.fire({
    icon: 'question',
    title: 'Por que recebi esse erro?',
    html: `<p>Há uma série de motivos pelos quais este erro pode ter acontecido.</p>
           <p>1. Certifique-se de que o código recebido no email é exatamente o código que foi digitado. </p>
           <p>2. Certifique-se de que o código que está usando ainda não expirou (não passaram mais de 5 minutos).</p>
           <p>3. Certifique-se de estar utilizando o código mais atual (caso solicite a verificação duas vezes ou mais, o único código válido é o último a ser enviado).</p>`,
    showCancelButton: false,
    confirmButtonText: 'Entendi!'

  })
}

function verificarSenha() {

  var senha1 = document.getElementById("senha1").value;
  var senha2 = document.getElementById("senha2").value;
  var resultado = document.getElementById("resultado");
  if (senha1 == senha2) {
    resultado.style.color = "green";
    resultado.innerHTML = "As senhas coincidem!";
    document.getElementById("submit").disabled = false;
  } else {
    resultado.style.color = "red";
    resultado.innerHTML = "As senhas não coincidem.";
    document.getElementById("submit").disabled = true;
  }
}

function deletarTecido(id_tecidos) {
  Swal.fire({
    title: "Deseja deletar este tecido?",
    text: "Cuidado! Não é possível recuperar após a exclusão.",
    icon: "error",
    confirmButtonColor: '#DC3545',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Excluir',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false
  }).then((result) => {
    if (result.value) {
      window.location.href = '../src/remover_tecido.php?id_tecidos=' + id_tecidos;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire(
        'Exclusão cancelada.',
        'Seus dados permanecem salvos',
        'success'
      )
    }
  });
}

function ajudaTecido() {
  Swal.fire({
    title: "Bem vindo!",
    html: `<div class="container">
                  <p>
                    Bem-vindo à pagina de tecidos! <br><br>
                    Aqui você iniciará seu conhecimento em tecidos
                    com as informações abaixo. Mas, de forma alguma, pare por aí! 
                    Acesse nosso <a href="../src/portal_de_noticias.php" class="popover-link" data-placement="top" data-container="body">Portal de Notícias</a>
                    e fique a par e antenado ao conteúdo mais recente no mundo da moda sustentável!
                    <br><br> Para desfrutar de melhor experiência, conheça o nosso
                    <a href="#" class="popover-link" data-placement="top" data-content="Guess the Tissue, disponível na barra de navegação!" data-container="body">Jogo</a>
                    e depois acesse esta página!  
                  </p>
                </div>`,
    icon: "info",
    confirmButtonText: 'Entendi!',
    allowOutsideClick: true
  });

  $(document).ready(function () {
    $('.popover-link').popover({ trigger: 'focus' });
  });
};

function deletarNoticia(id_noticia) {
  Swal.fire({
    title: "Deseja deletar essa noticia?",
    text: "Cuidado! Não é possível recuperar após a exclusão.",
    icon: "error",
    confirmButtonColor: '#DC3545',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Excluir',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false
  }).then((result) => {
    if (result.value) {
      window.location.href = '../src/remover_noticia.php?id_noticia=' + id_noticia;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire(
        'Exclusão cancelada.',
        'Seus dados permanecem salvos',
        'success'
      )
    }
  });
}

function confirmar_edicao_noticia(form) {

  swal.fire({
    title: "Deseja realmente alterar a noticia?",
    text: "Cuidado! Em caso de arrependimento, seus dados deverão novamente ser editados.",
    icon: "warning",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, editar',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false
  })
    .then((result) => {
      if (result.value) {
        form.submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swal.fire(
          'Edição cancelada.',
          'A noticia não foi editada',
          'success'
        )
      }
    });
  return false;
}

$(document).ready(function () {
  $('.popover-link').popover({ trigger: 'focus' });
});



// SESSÃO DO INFERNO DO ALERT DE TECIDOS QUE FINALMENTE ESTA PRONTO INFERNO  

$(document).ready(function () {
  var currentPage = window.location.pathname.split("/").pop();
  if (currentPage == 'tecidos.php' || currentPage == 'tecidos_adm.php') {
    let id_usuario = chave_sessao
    sessionStorage.setItem('id_usuario', id_usuario);
    let showAlertTecidos = localStorage.getItem('showAlertTecidos_' + id_usuario);
    if (showAlertTecidos !== 'false') {
      Swal.fire({
        title: 'Bem-vindo!',
        html: `<div class="container">
                    <p>
                    Bem-vindo à pagina de tecidos! <br><br>
                    Aqui você iniciará seu conhecimento em tecidos
                    com as informações abaixo. Mas, de forma alguma, pare por aí! 
                    Acesse nosso <a href="../src/portal_de_noticias.php">Portal de Notícias</a>
                    e fique a par e antenado ao conteúdo mais recente no mundo da moda sustentável!
                    <br><br> Para desfrutar de melhor experiência, conheça o nosso
                    <a href="#" class="popover-link" data-placement="top" data-content="Guess the Tissue, disponível na barra de navegação!" data-container="body">Jogo</a>
                    e depois acesse esta página!  
                  </p>
                <input type="checkbox" class="form-check-input" id="checkbox-avisar-tecidos" />
                <label class="form-check-label" for="checkbox-avisar-tecidos"> Não me avisar novamente</label>
              </div>`,
        icon: 'info',
        showCloseButton: true,
        confirmButtonText: 'Entendi!',
      }).then((result) => {
        if (result.isConfirmed) {
          if ($('#checkbox-avisar-tecidos').is(':checked')) {
            localStorage.setItem('showAlertTecidos_' + id_usuario, 'false');
          } else {
            localStorage.setItem('showAlertTecidos_' + id_usuario, 'true');
          }
        }
      });

      $('.swal2-close').on('click', function () {
        if ($('#checkbox-avisar-tecidos').is(':checked')) {
          localStorage.setItem('showAlertTecidos_' + id_usuario, 'false');
        }
      });

      $(document).ready(function () {
        $('.popover-link').popover({ trigger: 'focus' });
      });

    }

  }
});


$(document).ready(function () {
  var currentPage = window.location.pathname.split("/").pop();
  if (currentPage == 'portal_de_noticias.php') {
    let id_usuario = chave_sessao
    sessionStorage.setItem('id_usuario', id_usuario);
    let showAlertNoticias = localStorage.getItem('showAlertNoticias_' + id_usuario);
    if (showAlertNoticias !== 'false') {
      Swal.fire({
        title: 'Bem-vindo!',
        html: `<div class="container">
                    <p>
                    Bem-vindo ao nosso Portal de notícias! <br><br>
                    Aqui você ficará antenado aos últimos conteúdos e notícias sobre tecidos e moda 
                    sustentável que ocorreram pelo Brasil e pelo mundo. <br><br>Sinta-se à vontade para destrinchar
                    as reportagens através da nossa ferramenta de busca ou carrossel de entrada.
                    Não se esqueça de curtir aquelas que você achar importante e que te esclarecerem
                    de alguma maneira!<br><br>
                    Para reportar erro de conteúdo ou site fora do ar, notifique-nos pela página de <a href="../src/ajuda.php">Ajuda</a>.
                  </p>
                <input type="checkbox" class="form-check-input" id="checkbox-avisar-noticias" />
                <label class="form-check-label" for="checkbox-avisar-noticias"> Não me avisar novamente</label>
              </div>`,
        icon: 'info',
        showCloseButton: true,
        confirmButtonText: 'Entendi!',
      }).then((result) => {
        if (result.isConfirmed) {
          if ($('#checkbox-avisar-noticias').is(':checked')) {
            localStorage.setItem('showAlertNoticias_' + id_usuario, 'false');
          } else {
            localStorage.setItem('showAlertNoticias_' + id_usuario, 'true');
          }
        }
      });

      $('.swal2-close').on('click', function () {
        if ($('#checkbox-avisar-noticias').is(':checked')) {
          localStorage.setItem('showAlertNoticias_' + id_usuario, 'false');
        }
      });

      $(document).ready(function () {
        $('.popover-link').popover({ trigger: 'focus' });
      });

    }

  }
});


function logout() {
  Swal.fire({
    title: "Deseja mesmo sair da sua conta?",
    icon: "question",
    confirmButtonColor: '#DC3545',
    cancelButtonColor: '#BEBEBE', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Continuar navegando',
    confirmButtonText: 'Sair',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false
  }).then((result) => {
    if (result.value) {
      window.location.href = '../src/sair.php';
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire(
        'Boa navegação!',
        'Você continua logado em nosso sistema',
        'success'
      )
    }
  });
}

// aqui eu to fazendo com que na página do código do email, toda vez q o usuario digitar 1 numero, va pro prox input automatico
// verificando se o nome da página é "email.php"
if (
  window.location.pathname.includes("email.php") ||
  window.location.pathname.includes("token.php")
) {
  $(document).ready(function () {
    $(".digit-only").keydown(function (event) {
      var current_input = $(this);
      var input_index = $(".digit-only").index(current_input);
      var next_input = $(".digit-only").eq(input_index + 1);
      var prev_input = $(".digit-only").eq(input_index - 1);

      if (event.which == 8 && current_input.val() == "" && allInputsEmpty()) {
        return true;
      } else if (event.which == 8 && current_input.val() == "") {
        if (prev_input.val() != "") {
          prev_input.focus();
          prev_input.val("");
        }

        return false;
      } else if (event.which >= 48 && event.which <= 57 && current_input.val() != "") {
        next_input.focus();
      }
    });

    $(".digit-only").keyup(function () {
      var current_input = $(this);
      var input_index = $(".digit-only").index(current_input);
      var next_input = $(".digit-only").eq(input_index + 1);
      var prev_input = $(".digit-only").eq(input_index - 1);

      if (current_input.val() != "" && input_index < 5) {
        next_input.focus();
      }
    });

    function allInputsEmpty() {
      var all_empty = true;
      $(".digit-only").each(function () {
        if ($(this).val() != "") {
          all_empty = false;
          return false;
        }
      });
      return all_empty;
    }
  });
}


document.addEventListener('DOMContentLoaded', () => {
  const btnAlterarSenha = document.getElementById('btnAlterarSenha');
  const form = document.getElementById('formAlterarSenha');

  if (btnAlterarSenha && form) {
    btnAlterarSenha.addEventListener('click', (e) => {
      e.preventDefault();
      Swal.fire({
        title: "Confirme sua senha atual",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#9370DB',
        icon: "warning",
        customClass: "alterasenha",
        showCancelButton: true,
        input: 'password',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: true,
      }).then((result) => {
        if (result.value) {
          const senhaInput = document.createElement('input');
          senhaInput.setAttribute('type', 'hidden');
          senhaInput.setAttribute('name', 'alterar_senha');
          senhaInput.setAttribute('value', result.value);
          form.appendChild(senhaInput);
          form.submit();
        }
      });
    });
  }
});


// para fazer o botao de modo escuro funciona

function setModoCookie(modo) {
  document.cookie = "modo=" + modo + ";path=/"
}

function alternarModo() {
  var body = document.getElementsByTagName("body")[0];
  body.classList.toggle("modo-escuro");

  var modo = body.classList.contains("modo-escuro") ? "escuro" : "claro";
  setModoCookie(modo);
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../database/usuario.php?modo=' + modo);
  xhr.send();
}

var modoCookie = document.cookie.replace(/(?:(?:^|.*;\s*)modo\s*\=\s*([^;]*).*$)|^.*$/, "$1");
var alternarModoEscuro = document.getElementById("alternar-modoescuro");

if (modoCookie === "escuro" && alternarModoEscuro !== null) {
  alternarModoEscuro.checked = true;
}


// fim do botao de modo escuro

// curtir

function Curtida(id_noticia, id_usuario, qtdLikes) {
  let icone = $('.icone-curtir[data-noticia="' + id_noticia + '"] i');
  $.ajax({
    url: '../src/curtidas.php',
    type: 'POST',
    data: { id_noticia: id_noticia, id_usuario: id_usuario },
    success: function (data) {
      qtdLikes.html(data);
      if (icone.hasClass('fa-regular')) {
        icone.removeClass('fa-regular').addClass('fa-solid').css('color', '#ff0000');
        icone.animate({ fontSize: '1.5em' }, 200).animate({ fontSize: '1em' }, 200, function () {
          icone.addClass('animate__heartBeat animate__rubberBand');
          setTimeout(function () {
            icone.removeClass('animate__heartBeat animate__rubberBand');
          }, 1000);
        });
      } else if (icone.hasClass('fa-solid')) {
        icone.removeClass('fa-solid').addClass('fa-regular').css('color', 'black');
      }
    }
  });
}

$(document).ready(function () {
  $('.icone-curtir').click(function () {
    let id_noticia = $(this).data('noticia');
    let id_usuario = id_usuario_curtida
    let qtdLikes = $(this).parent().find('.contar-likes');
    Curtida(id_noticia, id_usuario, qtdLikes);
  });









});
