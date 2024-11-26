<?php
session_start();
if (!isset($_POST['id']) || !isset($_SESSION['nom_prof'])) {
    header('location:../index.php');
    exit();
} else {
    include './procesos/conexion.php';
    $id = $_POST['id'];

    // Consulta para obtener información del alumno
    $sqlAlumno = "SELECT dni_alu, nom_alu, cognom1_alu, cognom2_alu, telf_alu, email_alu FROM tbl_alumnos WHERE id_alumno = ?";
    $stmtAlumno = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmtAlumno, $sqlAlumno);
    mysqli_stmt_bind_param($stmtAlumno, "i", $id);
    mysqli_stmt_execute($stmtAlumno);
    $resultadoAlumno = mysqli_stmt_get_result($stmtAlumno);
    $infoAlumno = mysqli_fetch_assoc($resultadoAlumno);
    mysqli_stmt_close($stmtAlumno);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Notas</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-text text-white me-auto">
                    <?php echo htmlspecialchars($_SESSION['nom_prof']); ?>
                </span>
                <div class="d-flex">
                    <a href="../" class="btn btn-primary me-2 btn-sm">Volver</a>
                    <a href="../procesos/logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container my-5">
            <!-- Información del alumno -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Información del Alumno</h5>
                    <p><strong>DNI:</strong> <?php echo htmlspecialchars($infoAlumno['dni_alu']); ?></p>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($infoAlumno['nom_alu']); ?></p>
                    <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($infoAlumno['cognom1_alu'] . " " . $infoAlumno['cognom2_alu']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($infoAlumno['telf_alu']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($infoAlumno['email_alu']); ?></p>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3">Notas de <?php echo htmlspecialchars($infoAlumno['nom_alu']); ?></h1>
                <form action="./añadir.php" method="post">
                    <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($infoAlumno['nom_alu']); ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-primary">Añadir Nota</button>
                </form>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Nota</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT n.*, m.nom_materia FROM tbl_notas n 
                                  INNER JOIN tbl_materias m ON n.id_materia = m.id_materia 
                                  WHERE n.id_alumno = ?";
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt, $sql);
                            mysqli_stmt_bind_param($stmt, "i", $id);
                            mysqli_stmt_execute($stmt);
                            $notas = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);

                            if (mysqli_num_rows($notas) > 0) {
                                foreach ($notas as $nota) {
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($nota['nom_materia']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['nota']); ?></td>
                                        <td>
                                            <form action="./editar.php" method="post" class="d-inline">
                                                <input type="hidden" name="id_nota" value="<?php echo htmlspecialchars($nota['id_nota']); ?>">
                                                <button type="submit" class="btn btn-info btn-sm">Editar</button>
                                            </form>
                                            <form action="./procesos/eliminar.php" method="post" class="d-inline">
                                                <input type="hidden" name="id_materia" value="<?php echo htmlspecialchars($nota['id_materia']); ?>">
                                                <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($infoAlumno['nom_alu']); ?>">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="3" class="text-center">No hay notas disponibles.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
}
