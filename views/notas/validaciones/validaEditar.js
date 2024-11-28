document.getElementById("frmeditarnota").addEventListener("submit", function (event) {
    validaNota()
    if (!validaNota()) {
        event.preventDefault();
    }
});

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
