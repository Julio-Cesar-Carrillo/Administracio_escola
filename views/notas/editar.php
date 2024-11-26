<?php
if (!isset($_POST['id_nota']) || !isset($_POST['id_alumno'])) {
    header('location:./index.php');
    exit();
} else {
    include './procesos/conexion.php';

    $id_nota = $_POST['id_nota'];
    $id_alumno = $_POST['id_alumno'];

    // Consulta para obtener la información de la nota
    $sql = "SELECT n.*, m.nom_materia 
            FROM tbl_notas n 
            INNER JOIN tbl_materias m ON n.id_materia = m.id_materia 
            WHERE n.id_nota = ? AND n.id_alumno = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_nota, $id_alumno);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $nota = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$nota) {
        echo "Nota no encontrada o no corresponde al alumno.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="./index.php" class="btn btn-light btn-sm">Volver</a>
            </div>
        </nav>

        <div class="container my-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h4 mb-4">Editar Nota</h1>
                    <form action="./procesos/actualizar.php" method="post">
                        <div class="mb-3">
                            <label for="materia" class="form-label">Materia</label>
                            <input type="text" id="materia" class="form-control" value="<?php echo htmlspecialchars($nota['nom_materia']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nota" class="form-label">Nota</label>
                            <input type="number" name="nota" id="nota" class="form-control" value="<?php echo htmlspecialchars($nota['nota']); ?>" required min="0" max="100" step="0.1">
                        </div>
                        <input type="hidden" name="id_nota" value="<?php echo htmlspecialchars($id_nota); ?>">
                        <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($id_alumno); ?>">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="./index.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
