
document.getElementById("nota").onblur = function validaNota() {
    var nota = document.getElementById("nota").value;
    var errorNota = document.getElementById("error-nota");
   
    if (nota === "") {
        errorNota.innerHTML = "Debes ingresar una nota";
        return false;
    } else if (nota < 0 || nota > 10) {
        errorNota.innerHTML = "La nota debe estar entre 0 y 10.";
        return false;
    } else {
        errorNota.innerHTML = "";
        return true;
    }
};