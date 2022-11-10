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
