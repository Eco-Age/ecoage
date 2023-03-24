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

/* eu acho que essa função é removível porque não estamos validando na página login.php?
function validarLogin() {

  let apelido = document.getElementById("apelido_login").value;
  let senha = document.getElementById("senha_login").value;
  let dados_form = new FormData();
  dados_form.append("apelido", apelido);
  dados_form.append("senha", senha);

  fetch("../src/login.php", {
    method: 'POST',
    body: dados_form,
  })
  .then(function(response) {
    if (!response.ok) {
      throw new Error(response.text());
    }
    return response.json();
  })
  .then(function(objeto) {
    if (objeto.autenticado){
      window.location.href = "../src/pagina_inicial.php";
    } else {
      document.getElementById("id_msg").innerHTML = objeto.msg;
    }
  })
  .catch(function(erro) { 
    document.getElementById("id_msg").innerHTML = "Erro na requisição";
    console.error(erro);
  });
}

function limparCampo() {
  document.getElementById("id_msg").innerHTML = "";
}
*/

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

function duvida_token() {
  Swal.fire({
    icon: 'question',
    title: 'Por que recebi esse erro?',
    html: `<p>Há uma série de motivos pelos quais este erro pode ter acontecido.</p>
           <p>1. Certifique-se de que o token recebido no email é exatamente o token que foi digitado. </p>
           <p>2. Certifique-se de que o token que está usando ainda não expirou (não passaram mais de 5 minutos).</p>
           <p>3. Certifique-se de estar utilizando o token mais atual (caso solicite a recuperação duas vezes ou mais, o único token válido é o último a ser enviado).</p>`,
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
                    Essa é a página de tecidos!<br><br> É importante lembrarmos que 
                    ela tem relação direta com as patentes do nosso 
                    <a href="#" class="popover-link" data-placement="top" data-content="Guess the Tissue, disponível na barra de navegação!" data-container="body">Jogo</a>
                    , portanto, para melhor experiência, jogue primeiro e depois nos acesse!
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


// SESSÃO DO INFERNO DO ALERT DE TECIDOS QUE FINALMENTE ESTA PRONTO INFERNO  

$(document).ready(function () {
  var currentPage = window.location.pathname.split("/").pop();
  if (currentPage == 'tecidos.php' || currentPage == 'tecidos_adm.php') {
    let id_usuario = chave_sessao
    sessionStorage.setItem('id_usuario', id_usuario);
    let showAlert = localStorage.getItem('showAlert_' + id_usuario);
    if (showAlert !== 'false') {
      Swal.fire({
        title: 'Bem-vindo!',
        html: `<div class="container">
                <p>
                  Essa é a página de tecidos!<br><br> É importante lembrarmos que 
                  ela tem relação direta com as patentes do nosso 
                  <a href="#" class="popover-link" data-placement="top" data-content="Guess the Tissue, disponível na barra de navegação!" data-container="body">Jogo</a>
                  , portanto para melhor experiência, jogue primeiro e depois nos acesse!
                </p>
                
                <input type="checkbox" class="form-check-input" id="checkbox-avisar" />
                <label class="form-check-label" for="checkbox-avisar"> Não me avisar novamente</label>
              </div>`,
        icon: 'info',
        showCloseButton: true,
        confirmButtonText: 'Entendi!',
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
if (window.location.pathname.includes("email.php")) {
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


const btnAlterarSenha = document.getElementById('btnAlterarSenha');
const form = document.getElementById('formAlterarSenha');
btnAlterarSenha.addEventListener('click', (e) => {
  e.preventDefault();
  Swal.fire({
    title: "Confirme sua senha atual",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#BEBEBE', // cor antiga : #8A2BE2
    icon: "warning",
    showCancelButton: true,
    input: 'password',
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    allowOutsideClick: true,
    closeOnConfirm: false,
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
})












