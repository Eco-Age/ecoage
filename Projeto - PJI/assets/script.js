const password = document.getElementById('senha_login');
const icon = document.getElementById('icon');

function mostrarOcultar_login(){
    if (password.type === 'password'){
        password.setAttribute('type','text');
        icon.classList.add('ocultar')
    }else{
        password.setAttribute('type','password');
        icon.classList.remove('ocultar')
    }
}

const password_cadastro = document.getElementById('senha_cadastro');
const icon_cadastro = document.getElementById('icon_cadastro');

function mostrarOcultar_cadastro(){
    if (password_cadastro.type === 'password'){
        password_cadastro.setAttribute('type','text');
        icon_cadastro.classList.add('ocultar')
    }else{
        password_cadastro.setAttribute('type','password');
        icon_cadastro.classList.remove('ocultar')
    }
}


function confirmarvisaoadm(){
    if(confirm("Esta aplicação web é um protótipo. Ao clicar em Ok você poderá conhecer algumas funcionalidades de administrador.")){
        window.location="./tecidos_adm.html";
    }
}

function confirmarvisaousu(){
    alert("Você voltará a ver a página como usuário.");
    window.location="./tecidos.html";
}

function excluirtecido(){
    alert("Opa! Apenas administradores podem excluir um tecido!");
}

function editartecido(){
    alert("Opa! Apenas administradores podem editar um tecido!");
}

function inserirtecido(){
    alert("Esta aplicação web é um protótipo. Apenas administradores podem cadastrar novos tecidos, isso foi uma simulação.");
    window.location="./tecidos_adm.html";
}

function confirmarvisaoadm_noticia(){
    if(confirm("Esta aplicação web é um protótipo. Ao clicar em Ok você poderá conhecer algumas funcionalidades de administrador.")){
        window.location="./site_externo_adm.html";
    }
}

function confirmarvisaousu_noticia(){
    alert("Você voltará a ver a página como usuário.");
    window.location="./site_externo.html";
}

function voltaratencao(){
    alert("Você voltará a página inicial do portal de notícias como usuário.");
        window.location="./portal_de_noticias.html";
}

function excluirnoticia(){
    alert("Opa! Apenas administradores podem excluir uma notícia!");
}

function editarnoticia(){
    alert("Opa! Apenas administradores podem editar uma notícia!");
}

function inserirnoticia(){
    alert("Esta aplicação web é um protótipo. Apenas administradores podem cadastrar novas notícias, isso foi uma simulação.");
    window.location="./site_externo_adm.html";
}

function editar_perfil(){
    alert('Seus dados foram alterados com sucesso!\n\n(Trata-se apenas de um protótipo)');
}

function jogo(){
    alert('O jogo não está disponível nesta versão.\nTrata-se apenas de um protótipo');
}