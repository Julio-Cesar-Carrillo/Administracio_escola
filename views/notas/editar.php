<?php
<<<<<<< HEAD
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
=======
session_start();
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
>>>>>>> julio
            INNER JOIN tbl_materias m ON n.id_materia = m.id_materia 
            WHERE n.id_nota = ? AND n.id_alumno = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_nota, $id_alumno);
    mysqli_stmt_execute($stmt);
<<<<<<< HEAD
    $resultado = mysqli_stmt_get_result($stmt);
    $nota = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if (!$nota) {
        echo "Nota no encontrada.";
=======
    $result = mysqli_stmt_get_result($stmt);
    $nota = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$nota) {
        echo "Nota no encontrada o no corresponde al alumno.";
>>>>>>> julio
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
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="../style.css">
>>>>>>> julio
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<<<<<<< HEAD
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
=======
<body class="bg-light">
    <div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center">
        <!-- Contenedor limitado -->
        <div style="width: 100%; max-width: 500px;">
            <!-- Barra de navegación -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
                <div class="container-fluid">
                    <span class="navbar-text text-white me-auto">
                        <?php echo htmlspecialchars($_SESSION['nom_prof']); ?>
                    </span>
                    <div class="d-flex">
                        <form action="./" method="post" class="d-inline">
                            <input type="hidden" name="nom_alu" value="<?php echo $_POST['nom_alu']; ?>">
                            <input type="hidden" name="id" value="<?php echo $id_alumno ?>">
                            <button type="submit" class="btn btn-primary me-2 btn-sm">Volver</button>
                        </form>
                        <a href="../procesos/logout.php" class="btn btn-danger btn-sm">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Contenido principal -->
            <div class="form-container card shadow-sm p-4 rounded">
                <h3 class="card-title text-center">Editar Nota para <?php echo htmlspecialchars($_POST['nom_alu']); ?></h3>
                <form action="./procesos/actualizar.php" id="frmeditarnota" method="post">
                    <div class="mb-3">
                        <label for="materia" class="form-label">Materia</label>
                        <input type="text" id="materia" class="form-control" value="<?php echo htmlspecialchars($nota['nom_materia']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nota" class="form-label">Nota</label>
                        <input type="text" name="nota" id="nota" class="form-control" value="<?php echo htmlspecialchars($nota['nota']); ?>">
                        <span id="error-nota" style="color: red;"></span>
                    </div>
                    <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($_POST['nom_alu']); ?>">
                    <input type="hidden" name="id_nota" value="<?php echo htmlspecialchars($id_nota); ?>">
                    <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($id_alumno); ?>">
                    <button type="submit" class="btn  btn-success w-100">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>


</body>

<script src="./validaciones/validaEditar.js"></script>

</html>
>>>>>>> julio
