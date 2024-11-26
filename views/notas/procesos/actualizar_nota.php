<?php
include './conexion.php';

if (isset($_POST['id_nota']) && isset($_POST['nota']) && isset($_POST['id_alumno'])) {
    $id_nota = $_POST['id_nota'];
    $nota = $_POST['nota'];
    $id_alumno = $_POST['id_alumno'];

    // Validar que la nota esté en el rango permitido (por ejemplo, 0-10)
    if ($nota < 0 || $nota > 10) {
        echo "La nota debe estar entre 0 y 10.";
        exit();
    }

    // Actualizar la nota en la base de datos
    $sql = "UPDATE tbl_notas SET nota = ? WHERE id_nota = ? AND id_alumno = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "dii", $nota, $id_nota, $id_alumno);

    if (mysqli_stmt_execute($stmt)) {
        // Redirigir de vuelta al listado de notas del alumno
        header("Location: ../index.php?id=" . $id_alumno);
        exit();
    } else {
        echo "Error al actualizar la nota.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Datos inválidos.";
}
?>
