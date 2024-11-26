<?php
if (!isset($_POST['id'])) {
    header('location:./index.php');
    exit();
} else {
    include './procesos/conexion.php';
    $id = $_POST['id'];
    session_start();
    // Asume que la sesión ya tiene el nombre del profesor para mostrar
    if (!isset($_SESSION['nom_prof'])) {
        $_SESSION['nom_prof'] = 'Profesor Invitado'; // Fallback
    }
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
                        <form action="./procesos/logout.php" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="container my-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h3">Notas de <?php echo $_POST['nom_alu']; ?></h1>
                    <form action="./añadir.php" method="post">
                        <input type="hidden" name="nom_alu" value="<?php echo $_POST['nom_alu']; ?>">
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
                                                    <input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($id); ?>">
                                                    <button type="submit" class="btn btn-info btn-sm">Editar</button>
                                                </form>
                                                <form action="./procesos/eliminar.php" method="post" class="d-inline">
                                                    <input type="hidden" name="id_materia" value="<?php echo htmlspecialchars($nota['id_materia']); ?>">
                                                    <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($_POST['nom_alu']); ?>">
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
