
<?php
if (!isset($_POST['id'])) {
    header('Location: vernotas.php');
    exit();
}

include './procesos/conexion.php';

// Validar y sanitizar el ID recibido
$id_materia = filter_var($_POST['id'], FILTER_VALIDATE_INT);

if (!$id_materia) {
    header('Location: vernotas.php');
    exit();
}

// Obtener los datos actuales de la nota
$sql = "SELECT n.nota, m.nom_materia 
        FROM tbl_notas n 
        INNER JOIN tbl_materias m 
        ON n.id_materia = m.id_materia 
        WHERE n.id_materia = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error al preparar la consulta.";
    exit();
}

mysqli_stmt_bind_param($stmt, "i", $id_materia);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$nota_data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$nota_data) {
    echo "No se encontró la nota.";
    exit();
}

// Procesar la edición si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nueva_nota'])) {
    $nueva_nota = filter_var($_POST['nueva_nota'], FILTER_VALIDATE_FLOAT);

    if ($nueva_nota !== false && $nueva_nota >= 0 && $nueva_nota <= 10) {
        $sql_update = "UPDATE tbl_notas SET nota = ? WHERE id_materia = ?";
        $stmt_update = mysqli_stmt_init($conn);

    ?>


    <form action="../notas/vernotas.php" method="POST" name="formulario">
            <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>


    <?php

        if (!mysqli_stmt_prepare($stmt_update, $sql_update)) {
            echo "Error al preparar la consulta de actualización.";
            exit();
        }

        mysqli_stmt_bind_param($stmt_update, "di", $nueva_nota, $id_materia);
        mysqli_stmt_execute($stmt_update);

        if (mysqli_stmt_affected_rows($stmt_update) > 0) {
            mysqli_stmt_close($stmt_update);
            header('Location: vernotas.php?exito=1'); // Bandera para mostrar un mensaje de éxito
            exit();
        } else {
            echo "No se pudo actualizar la nota o no hubo cambios.";
        }

        mysqli_stmt_close($stmt_update);
    } else {
        echo "Por favor, ingresa una nota válida (entre 0 y 10).";
    }
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
    <h1>Editar Nota</h1>

    <form action="" method="post">
        <label for="materia">Materia:</label>
        <input type="text" name="materia" id="materia" value="<?php echo htmlspecialchars($nota_data['nom_materia']); ?>" readonly>

        <label for="nueva_nota">Nota:</label>
        <input type="number" name="nueva_nota" id="nueva_nota" step="0.1" min="0" max="10" 
            value="<?php echo htmlspecialchars($nota_data['nota']); ?>" required>

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id_materia); ?>">
        <button type="submit">Guardar</button>
    </form>

    <a href="vernotas.php">Cancelar</a>
</body>

</html>
