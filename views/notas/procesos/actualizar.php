<?php
if (!isset($_POST['id_nota']) || !isset($_POST['id_alumno']) || !isset($_POST['nota'])) {
    header('location:../index.php');
    exit();
} else {
    include './conexion.php';

    $id_nota = $_POST['id_nota'];
    $id_alumno = $_POST['id_alumno'];
    $nota = $_POST['nota'];

    // Validar que la nota esté en el rango permitido
    if ($nota < 0 || $nota > 10) {
        echo "La nota debe estar entre 0 y 10.";
        exit();
    }

    // Actualizar la nota en la base de datos
    $sql = "UPDATE tbl_notas SET nota = ? WHERE id_nota = ? AND id_alumno = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error en la consulta: " . mysqli_error($conn);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "dii", $nota, $id_nota, $id_alumno);
    if (mysqli_stmt_execute($stmt)) {
        // Redirigir al usuario de vuelta a la página principal o de notas
        header("location:../index.php?mensaje=nota_actualizada");
        exit();
    } else {
        echo "Error al actualizar la nota: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
