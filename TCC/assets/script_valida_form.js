function verificarApelido(input) {
  var apelido = input.value;
  var apelidoInput = document.getElementById('apelido');
  var apelidoError = document.querySelector('#apelido_erro');
  if (apelido.trim() !== "") {
    $.ajax({
      type: 'POST',
      url: '../src/verificar_apelido_email.php',
      data: { apelido: apelido },
      success: function(response) {
        if (response === 'existe') {
          apelidoInput.classList.add('erro-border-preencher');
          apelidoError.classList.add('show');
          apelidoError.textContent = 'Esse apelido já está cadastrado. Favor escolher outro.';
          apelidoInput.focus();
          return false;
        } else {
          apelidoInput.classList.remove('erro-border-preencher');
          apelidoError.classList.remove('show');
          apelidoError.textContent = '';
          return true;
        }
      }
    });
  } else {
    apelidoError.textContent = '';
    return true;
  }
}

function verificarEmail(input) {
  var email = input.value;
  var emailInput = document.getElementById('email_cadastro');
  var emailError = document.querySelector('#email_erro');
  if (email.trim() !== "") {
    console.log("im here");
    $.ajax({
      type: 'POST',
      url: '../src/verificar_apelido_email.php',
      data: { email_cadastro: email },
      success: function(response) {
        if (response === 'existe') {
          emailInput.classList.add('erro-border-preencher');
          emailError.classList.add('show');
          emailError.textContent = 'Esse email já está cadastrado. Se tiver perdido a senha, vá em recuperar senha.';
          emailInput.focus();
          return false;
        } else {
          emailInput.classList.remove('erro-border-preencher');
          emailError.classList.remove('show');
          emailError.textContent = '';
          return true;
        }
      }
    });
  } else {
    emailError.textContent = '';
    return true;
  }
}


function perguntaVerificacao(form) {

  var nomeCompleto = form.nome_completo.value;
  var nomeCompletoInput = form.nome_completo;
  var nomeCompletoError = document.querySelector('#nome_completo_erro');
  if (nomeCompleto == "") {
    nomeCompletoInput.classList.add('erro-border-preencher');
    nomeCompletoError.classList.add('show');
    nomeCompletoError.textContent = 'Por favor, preencha seu nome completo';
    nomeCompletoInput.focus();
    return false;
  } else if (nomeCompleto !== "") {
    nomeCompletoInput.classList.remove('erro-border-preencher');
    nomeCompletoError.classList.remove('show');
    nomeCompletoError.textContent = '';
  }

  var dataNasc = form.data_nasc.value;
  var dataNascInput = form.data_nasc;
  var dataNascError = document.querySelector('#data_nasc_erro');
  if (dataNasc == "") {
    dataNascInput.classList.add('erro-border-preencher');
    dataNascError.classList.add('show');
    dataNascError.textContent = 'Por favor, preencha a data de nascimento';
    dataNascInput.focus();
    return false;
  } else if (dataNasc !== "") {
    dataNascInput.classList.remove('erro-border-preencher');
    dataNascError.classList.remove('show');
    dataNascError.textContent = '';
  }

  var tel = form.tel.value;
  var telInput = form.tel;
  var telError = document.querySelector('#tel_erro');
  var padraoTel = /^\d{0,15}$/;
  if (tel !== "" && !tel.match(padraoTel)) {
    telInput.classList.add('erro-border-preencher');
    telError.classList.add('show');
    telError.textContent = 'Seu número de telefone pode ter no máximo 15 dígitos!';
    telInput.focus();
    return false;
  } else if (tel !== "" && tel.match(padraoTel)) {
    telInput.classList.remove('erro-border-preencher');
    telError.classList.remove('show');
    telError.textContent = '';
  }

  var apelido = form.apelido.value;
  var apelidoInput = form.apelido;
  var apelidoError = document.querySelector('#apelido_erro');
  if (apelido == "") {
    apelidoInput.classList.add('erro-border-preencher');
    apelidoError.classList.add('show');
    apelidoError.textContent = 'Por favor, insira um apelido';
    apelidoInput.focus();
    return false;
  } else if (apelido !== "") {
    apelidoInput.classList.remove('erro-border-preencher');
    apelidoError.classList.remove('show');
    apelidoError.textContent = '';
  }

  var email = form.email_cadastro.value;
  var emailInput = form.email_cadastro;
  var emailError = document.querySelector('#email_erro');
  var padraoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email.match(padraoEmail) ) {
    emailInput.classList.add('erro-border-preencher');
    emailError.classList.add('show');
    emailError.textContent = 'Por favor, insira um email válido';
    emailInput.focus();
    return false;
  } else if (email.match(padraoEmail)) {
    emailInput.classList.remove('erro-border-preencher');
    emailError.classList.remove('show');
    emailError.textContent = '';
  }

  var senha = form.senha_cadastro.value;
  var senhaInput = form.senha_cadastro;
  var senhaError = document.querySelector('#senha_erro');
  var padraoSenha = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
  if (!senha.match(padraoSenha)) {
    senhaInput.classList.add('erro-border-preencher');
    senhaError.classList.add('show');
    senhaError.textContent = 'Sua senha precisa obedecer aos critérios acima';
    senhaInput.focus();
    form.senha_cadastro.focus();
    return false;
  } else if (senha.match(padraoSenha)) {
    senhaInput.classList.remove('erro-border-preencher');
    senhaError.classList.remove('show');
    senhaError.textContent = '';
  }


  var avatarSelecionado = false;
  var radios = document.getElementsByName("id_avatar");
  var avatarInput = document.querySelector('.avatar-container');
  var avatarError = document.querySelector('#avatar_erro');
  for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
      avatarSelecionado = true;
      break;
    }
  }
  if (!avatarSelecionado) {
    avatarError.classList.add('show');
    avatarError.textContent = 'Selecione o seu avatar';
    return false;
  } else if (avatarSelecionado) {
    avatarError.classList.remove('show');
    avatarInput.focus();
    avatarError.textContent = '';
  }

  swal.fire({
    title: "Deseja verificar seu email?",
    text: "Isso é muito importante!",
    icon: "question",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Continuar sem verificar',
    confirmButtonText: 'Verificar',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: false,

  })
    .then((result) => {
      if (result.value) {
        form.verifica.value = 1;
        form.submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: "Tem certeza?",
          text: "Sem verificar, você NÃO será capaz de recuperar a sua senha caso a perda.",
          icon: "warning",
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
          showCancelButton: true,
          cancelButtonText: 'Verificar mais tarde',
          confirmButtonText: 'Verificar agora',
          allowOutsideClick: false,
          closeOnConfirm: false,
          closeOnCancel: false
        }).then((result) => {
          if (result.value) {
            form.verifica.value = 1;
            form.submit();
          } else {
            form.verifica.value = 0;
            form.submit();
          }
        });
      }
    });
  return false;
}

function validacao(form) {
  // Adiciona um event listener no botão de submit
  var nomeCompleto = form.nome_completo.value;
  var nomeCompletoInput = form.nome_completo;
  var nomeCompletoError = document.querySelector('#nome_completo_erro');
  if (nomeCompleto == "") {
    nomeCompletoInput.classList.add('erro-border-preencher');
    nomeCompletoError.classList.add('show');
    nomeCompletoError.textContent = 'Por favor, preencha seu nome completo';
    nomeCompletoInput.focus();
    return false;
  } else if (nomeCompleto !== "") {
    nomeCompletoInput.classList.remove('erro-border-preencher');
    nomeCompletoError.classList.remove('show');
    nomeCompletoError.textContent = '';
  }

  var dataNasc = form.data_nasc.value;
  var dataNascInput = form.data_nasc;
  var dataNascError = document.querySelector('#data_nasc_erro');
  if (dataNasc == "") {
    dataNascInput.classList.add('erro-border-preencher');
    dataNascError.classList.add('show');
    dataNascError.textContent = 'Por favor, preencha a data de nascimento';
    dataNascInput.focus();
    return false;
  } else if (dataNasc !== "") {
    dataNascInput.classList.remove('erro-border-preencher');
    dataNascError.classList.remove('show');
    dataNascError.textContent = '';
  }

  var tel = form.tel.value;
  var telInput = form.tel;
  var telError = document.querySelector('#tel_erro');
  var padraoTel = /^\d{0,15}$/;
  if (tel !== "" && !tel.match(padraoTel)) {
    telInput.classList.add('erro-border-preencher');
    telError.classList.add('show');
    telError.textContent = 'Seu número de telefone precisa ser como "(XX) 9XXXX-XXXX"';
    telInput.focus();
    return false;
  } else if (tel !== "" && tel.match(padraoTel)) {
    telInput.classList.remove('erro-border-preencher');
    telError.classList.remove('show');
    telError.textContent = '';
  }

  var apelido = form.apelido.value;
  var apelidoInput = form.apelido;
  var apelidoError = document.querySelector('#apelido_erro');
  if (apelido == "") {
    apelidoInput.classList.add('erro-border-preencher');
    apelidoError.classList.add('show');
    apelidoError.textContent = 'Por favor, insira um apelido';
    apelidoInput.focus();
    return false;
  } else if (apelido !== "") {
    apelidoInput.classList.remove('erro-border-preencher');
    apelidoError.classList.remove('show');
    apelidoError.textContent = '';
  }

  var email = form.email_cadastro.value;
  var emailInput = form.email_cadastro;
  var emailError = document.querySelector('#email_erro');
  var padraoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email.match(padraoEmail)) {
    emailInput.classList.add('erro-border-preencher');
    emailError.classList.add('show');
    emailError.textContent = 'Por favor, insira um email válido';
    emailInput.focus();
    return false;
  } else if (email.match(padraoEmail)) {
    emailInput.classList.remove('erro-border-preencher');
    emailError.classList.remove('show');
    emailError.textContent = '';
  }


  event.preventDefault();
  Swal.fire({
    title: "Deseja realmente alterar seus dados?",
    text: "Cuidado! Em caso de arrependimento, seus dados deverão novamente ser editados.",
    icon: "question",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, editar',
    allowOutsideClick: true,
    closeOnConfirm: false,
    closeOnCancel: true
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        title: "Confirme sua senha",
        icon: "warning",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#BEBEBE', // cor antiga : #8A2BE2
        showCancelButton: true,
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off'
        },
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.value) {
          const senhaInput = document.createElement('input');
          senhaInput.setAttribute('type', 'hidden');
          senhaInput.setAttribute('name', 'confirmar_senha');
          senhaInput.setAttribute('value', result.value);
          form.appendChild(senhaInput);
          form.submit();
        }
      })
      return false;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire(
        'Edição cancelada.',
        'Seus dados permanecem inalterados',
        'success'
      )
    }
  });
}

$(document).ready(function () {
  $('#form_busca').submit(function (event) {
    var palavraChaveInput = $('#palavra_chave');
    var palavraChaveError = $('#palavra_chave_erro');
    var regex = /^\s*$/;

    if (!regex.test(palavraChaveInput.val()) && palavraChaveInput.val().trim().length < 3) {
      palavraChaveInput.addClass('erro-border-preencher');
      palavraChaveError.addClass('show');
      palavraChaveError.text('Por favor, preencha com pelo menos 3 caracteres');
      palavraChaveInput.focus();
      event.preventDefault();
    } else {
      palavraChaveInput.removeClass('erro-border-preencher');
      palavraChaveError.removeClass('show');
      palavraChaveError.text('');
    }
  });
});



