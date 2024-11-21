
function validarUser() {
    const user = document.getElementById('user');
    const error = document.getElementById('error_user');
    const value = user.value.trim();
    if (value === '') {
        error.innerText = 'El usuario no puede estar vacio';
    } else if (!isNaN(value)) {
        error.innerText = 'El usuario no puede contener solo numeros';
    } else {
        error.innerText = '';
    }
}

function validarPwd() {
    const pwd = document.getElementById('pwd')
    const error = document.getElementById('error_pwd');
    const value = pwd.value.trim();
    const contieneCaracteres = /[^a-zA-Z0-9]/;

    if (value === '') {
        error.innerText = 'La contraseña no puede estar vacio';
    } else if (value.length <= 5) {
        error.innerText = 'La contraseña debe de contener mas de 6 caracteres';
    } else if (value.length > 20) {
        error.innerText = 'La contraseña no debe de tener mas de 20 caracteres';
    } else if (contieneCaracteres.test(value)) {
        error.innerText = 'La contraseña no puede tener caractres especiales';
    } else {
        error.innerText = '';
    }
}











