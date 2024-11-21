<?php

$error = "";
function validaCampo($campo)
{
    if (empty($campo)) {
        $error = true;
    } else {
        $error = false;
    }
    return $error;
}

if (validaCampo($nombre)) {
    $error .= ($error === "") ? '?userVacio=true' : '&userVacio=true';
} else if (!ctype_alpha($nombre)) {
    // ctype_alpha verifica que solo contenga letras
    $error .= ($error === "") ? '?userMal=true' : '&userMal=true';
}

if (validaCampo($pwd)) {
    $error .= ($error === "") ? '?pwdVacio=true' : '&pwdVacio=true';
} else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $pwd)) {
    // verifica que tenga letras minusculas, mayusculas y sean 6 caracteres como minimo
    $error .= ($error === "") ? '?pwdMal=true' : '&pwdMal=true';
}

if ($error !== '') {
    $datosRecibidos = array(
        'user' => $nombre,
        'pwd' => $pwd
    );
    $datosDevolver = http_build_query($datosRecibidos);
    header('Location:../index.php' . $error . '&error=1&' . $datosDevolver);
    exit();
}
