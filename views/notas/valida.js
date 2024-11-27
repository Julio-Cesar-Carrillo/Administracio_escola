document.getElementById("frmañadirnota").addEventListener("submit", function (event) {
    validaNota()
    validaMateria()
    if (!validaNota() || !validaMateria()) {
        event.preventDefault();
    }
});

document.getElementById("materia").addEventListener("click", validaMateria);

function validaMateria() {
    var materia = document.getElementById("materia").value;
    var errorMateria = document.getElementById("error-materia");
    var esValido = true;
    if (materia === "") {
        errorMateria.innerHTML = "Seleccionar una materia";
        esValido = false;
    } else {
        errorMateria.innerHTML = "";
    }
    return esValido;
}

document.getElementById("nota").addEventListener("blur", validaNota);

function validaNota() {
    var nota = parseFloat(document.getElementById("nota").value);
    var errorNota = document.getElementById("error-nota");
    var esValido = true;

    if (isNaN(nota)) {
        errorNota.innerHTML = "ingresar numeros número ejemplo: 1.50";
        esValido = false;
    } else if (nota === "") {
        errorNota.innerHTML = "ingresar una nota";
        esValido = false;
    } else if (nota < 0 || nota > 10) {
        errorNota.innerHTML = "La nota debe estar entre 0 y 10.";
        esValido = false;
    } else {
        errorNota.innerHTML = "";
    }
    return esValido;
}

