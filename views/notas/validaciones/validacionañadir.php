<?php
$error = "";

function validacampovaio($campo)
{
    if (empty($campo)) {
        $error = true;
    } else {
        $error = false;
    }
    return $error;
}
$errores = "";
$id_materia = $_POST['id_materia'];

if (validacampovaio($id_materia)) {
    if (!$errores) {
        $errores .= "?materiavacio=true";
    } else {
        $errores .= "&materiavacio=true";
    }
} else {
    if (!preg_match("/^[0-9]*$/", $id_materia)) {
        if (!$errores) {
            $errores .= "?materiaMalo=true";
        } else {
            $errores .= "&materiaMal=true";
        }
    }
}

$nota = $_POST['nota'];

if (validacampovaio($nota)) {
    if (!$errores) {
        $errores .= "?notavacio=true";
    } else {
        $errores .= "&notavacio=true";
    }
} else {
    if (!preg_match("/^[0-9]*$/", $nota)) {
        if (!$errores) {
            $errores .= "?notaMalo=true";
        } else {
            $errores .= "&notaMal=true";
        }
    }
}


if ($errores != "") {
?>
    <form action="../añadir.php" method="POST" name="formulario">
        <input type="hidden" name="errormateria" value="<?php echo $id_materia; ?>">
        <input type="hidden" name="errornota" value="<?php echo $nota; ?>">
        <input type="hidden" name="nom_alu" value="<?php echo $_POST['nom_alu']; ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>
    <script language="JavaScript">
        document.formulario.submit();
    </script>
<?php
    exit();
}
