<?php
if (!isset($_POST['id_nota']) || !isset($_POST['alumno'])) {
    echo "Nota no encontrada.";
    exit();
} else {
    include './procesos/conexion.php';
    session_start();
    $id_nota = $_POST['id_nota']; // id de la nota
    $id_alumno = $_POST['alumno']; // id del alumno

    // Obtener los datos de la nota actual
    $sql = "SELECT n.id_nota, n.nota, m.nom_materia FROM tbl_notas n 
            INNER JOIN tbl_materias m ON n.id_materia = m.id_materia 
            WHERE n.id_nota = ? AND n.id_alumno = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_nota, $id_alumno);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $nota = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if (!$nota) {
        echo "Nota no encontrada.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistema de Notas</a>
            <div class="d-flex align-items-center">
                <span class="navbar-text text-white me-3">¡Hola, <?php echo htmlspecialchars($_SESSION['nom_prof']); ?>!</span>
                <form action="./procesos/logout.php" method="post" class="d-inline">
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1>Editar Nota</h1>
        <form action="./procesos/actualizar_nota.php" method="post">
            <input type="hidden" name="id_nota" value="<?php echo htmlspecialchars($nota['id_nota']); ?>">
            <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($id_alumno); ?>">

            <div class="mb-3">
                <label for="materia" class="form-label">Materia</label>
                <input type="text" class="form-control" id="materia" value="<?php echo htmlspecialchars($nota['nom_materia']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="nota" class="form-label">Nota</label>
                <input type="number" class="form-control" id="nota" name="nota" step="0.01" min="0" max="10" value="<?php echo htmlspecialchars($nota['nota']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Nota</button>
        </form>
    </div>
</body>

</html>
