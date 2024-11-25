<?php
if (!isset($_GET['id']) || !isset($_GET['id_alumno'])) {
    die("ID de materia o alumno no especificado.");
}

include 'conexion.php'; 
$id_materia = $_GET['id'];  // ID de la materia
$id_alumno = $_GET['id_alumno'];  // ID del alumno

// Obtener la nota actual
$sql = "SELECT * FROM tbl_notas WHERE id_materia = ? AND id_alumno = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id_materia, $id_alumno);
mysqli_stmt_execute($stmt);
$nota = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

// Si no se encuentra la nota
if (mysqli_num_rows($nota) == 0) {
    die("Nota no encontrada.");
}

$nota = mysqli_fetch_assoc($nota);

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_materia = $_POST['id_materia'];
    $id_alumno = $_POST['id_alumno'];
    $nota_nueva = $_POST['nota'];

    // Actualizar la nota
    $sql = "UPDATE tbl_notas SET nota = ? WHERE id_materia = ? AND id_alumno = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "dii", $nota_nueva, $id_materia, $id_alumno);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: listado.php?id=' . $id_alumno); // Redirigir correctamente
            exit();
        } else {
            echo "Error al actualizar la nota.";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
</head>

<body>
    <div>
        <h2>Editar nota para el alumno</h2>
        <form action="editar.php?id=<?php echo $id_materia; ?>&id_alumno=<?php echo $id_alumno; ?>" method="post">
            <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>">
            <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">

            <label for="nota">Nota:</label>
            <input type="number" step="0.01" name="nota" id="nota" value="<?php echo $nota['nota']; ?>" required min="0" max="10">

            <button type="submit">Guardar Nota</button>
            <a href="listado.php?id=<?php echo $id_alumno; ?>"><button type="button">Cancelar</button></a>
        </form>
    </div>
</body>

</html>
