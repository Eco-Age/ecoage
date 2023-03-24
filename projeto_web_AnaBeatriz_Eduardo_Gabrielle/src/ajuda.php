<?php
session_start();

 if(!isset($_SESSION["id_usuario"])){
   header("Location: ../public/index.php");
 }
 
    include("../include/navegacao.php");
?>
<body>
<main class="container">
    <div id="pagina_de_duvidas">
        <div class="row">
            <div class="col-3"></div>
                <div class="col-6" id="duvidas_frequentes">
                    <h1>Dúvidas frequentes:</h1>
                </div>
            <div class="col-3"></div>
        </div>


        <div class="row" id="caixas_duvidas">
            <div class="col-3"></div>
                <div class="col-6">
                    <div id="carrosel_duvidas" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            
                            <div class="carousel-item active">
                                <div class="d-block w-100" id="duvida1">
                                    <h5>Como acesso o jogo?</h5>
                                    <p>
                                        Basta clicar no ícone de controle na barra de navegação.
                                    </p>
                                </div> 
                            </div>  

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida2">
                                    <h5>Como faço para jogar?</h5>
                                    <p>
                                        Verifique o tutorial na página do jogo.
                                    </p> 
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida3">
                                    <h5>Como altero minha senha?</h5>
                                    <p>
                                        Para modificar sua senha basta ir ao seu perfil na barra de navegação, 
                                        alterar sua senha e salvar as alterações.
                                    </p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="d-block w-100" id="duvida4">
                                    <h5>Esqueci a senha, e agora?</h5>
                                    <p>
                                        Clique na opção "esqueci minha senha" no formulário de login.
                                    </p>
                                </div>
                            </div>

                        </div>
                    
                        <a class="carousel-control-prev" href="#carrosel_duvidas" role="button" data-slide="prev">
                            <span class="carousel-control material-icons" aria-hidden="true" id="ante">
                                chevron_left
                            </span>    
                        </a>
                        <a class="carousel-control-next" href="#carrosel_duvidas" role="button" data-slide="next">
                            <span class="carousel-control material-icons" aria-hidden="true" id="next">
                                navigate_next
                            </span>            
                        </a>
                    </div>
                </div>
            <div class="col-3"></div>  
          </div>
    
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                    <h3>Ainda precisa de ajuda?</h3>
                    <h5>Envie-nos sua dúvida!</h5>
                    <br>
                </div>
            <div class="col-4"></div>
        </div>
        
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="email_ajuda">
                        <small id="emailHelp" class="form-text text-muted">Seu e-mail não será compartilhado com ninguém.</small>
                    </div>
                    <div class="form-group"> 
                        <input type="text" class="form-control" placeholder="Assunto" name="assunto_ajuda">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Sua dúvida..." name="duvida"></textarea>
                    </div>
                    <input type="submit" class="main-btn btn btn-primary" id="enviarDuvida" value="Enviar">
                </form>
                </div>
            <div class="col-4"></div>
        </div>  
    </div>
</main>
<?php
    include("../include/rodape.php");  
?>
</body>
</html>

function perguntaVerificacao(form) {
  var nome = form.nome_completo.value.trim();
  var data_nasc = form.data_nasc.value.trim();
  var tel = form.tel.value.trim();
  var apelido = form.apelido.value.trim();
  var email = form.email_cadastro.value.trim();
  var senha = form.senha_cadastro.value.trim();
  var formValido = true; // variável para verificar se o formulário está válido

  // Verifica se todos os campos foram preenchidos
  if (nome == "") {
    form.nome_completo.classList.add("campo-invalido"); // adiciona classe CSS para destacar campo vazio
    form.nome_completo.nextElementSibling.innerHTML = "Por favor, preencha este campo."; // adiciona mensagem de erro
    formValido = false; // define formulário como inválido
  } else {
    form.nome_completo.classList.remove("campo-invalido"); // remove classe CSS caso o campo esteja preenchido
    form.nome_completo.nextElementSibling.innerHTML = ""; // remove mensagem de erro
  }

  // Repita o processo para os outros campos
  if (data_nasc == "") {
    form.data_nasc.classList.add("campo-invalido");
    form.data_nasc.nextElementSibling.innerHTML = "Por favor, preencha este campo.";
    formValido = false;
  } else {
    form.data_nasc.classList.remove("campo-invalido");
    form.data_nasc.nextElementSibling.innerHTML = "";
  }

  if (tel == "") {
    form.tel.classList.add("campo-invalido");
    form.tel.nextElementSibling.innerHTML = "Por favor, preencha este campo.";
    formValido = false;
  } else {
    form.tel.classList.remove("campo-invalido");
    form.tel.nextElementSibling.innerHTML = "";
  }

  if (apelido == "") {
    form.apelido.classList.add("campo-invalido");
    form.apelido.nextElementSibling.innerHTML = "Por favor, preencha este campo.";
    formValido = false;
  } else {
    form.apelido.classList.remove("campo-invalido");
    form.apelido.nextElementSibling.innerHTML = "";
  }

  if (email == "") {
    form.email_cadastro.classList.add("campo-invalido");
    form.email_cadastro.nextElementSibling.innerHTML = "Por favor, preencha este campo.";
    formValido = false;
  } else {
    form.email_cadastro.classList.remove("campo-invalido");
    form.email_cadastro.nextElementSibling.innerHTML = "";
  }

  if (senha == "") {
form.senha_cadastro.classList.add("campo-invalido");
form.senha_cadastro.nextElementSibling.innerHTML = "Por favor, preencha este campo.";
formValido = false;
} else {
form.senha_cadastro.classList.remove("campo-invalido");
form.senha_cadastro.nextElementSibling.innerHTML = "";
}

// Verifica se o e-mail é válido
var emailValido = /^[^\s@]+@[^\s@]+.[^\s@]+$/.test(email);
if (!emailValido) {
form.email_cadastro.classList.add("campo-invalido");
form.email_cadastro.nextElementSibling.innerHTML = "Por favor, digite um e-mail válido.";
formValido = false;
} else {
form.email_cadastro.classList.remove("campo-invalido");
form.email_cadastro.nextElementSibling.innerHTML = "";
}

// Verifica se a senha é forte o suficiente
var senhaForte = /(?=.\d)(?=.[a-z])(?=.*[A-Z]).{8,}/.test(senha);
if (!senhaForte) {
form.senha_cadastro.classList.add("campo-invalido");
form.senha_cadastro.nextElementSibling.innerHTML = "A senha deve ter pelo menos 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula e um número.";
formValido = false;
} else {
form.senha_cadastro.classList.remove("campo-invalido");
form.senha_cadastro.nextElementSibling.innerHTML = "";
}

if (formValido){
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
  
      }).then((result) => {
        if (result.value) {
           form.verifica.value = 1; 
           form.submit();
        } else if (result.dismiss === Swal.DismissReason.cancel){
          Swal.fire({
            title: "Tem certeza?",
            text: "Sem verificar, você NÃO será capaz de recuperar a sua senha caso a perca.",
            icon: "warning",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#9370DB', // cor antiga : #8A2BE2
            showCancelButton: true,
            cancelButtonText: 'Verificar mais tarde',
            confirmButtonText: 'Verificar agora',
            allowOutsideClick: true,
            closeOnConfirm: false,
            closeOnCancel: false
          }).then((result) => {
              if (result.value){
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
  
    // Se tudo estiver ok, permite o envio do formulário
    return true;
}
