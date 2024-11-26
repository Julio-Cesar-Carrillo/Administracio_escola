<?php

session_start();

include './procesos/conexion.php';
$id = $_POST['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nota</title>
    <script href="valida.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        nav {
            height: 80px;
            /* Aumentar altura de la barra */
            display: flex;
            align-items: center;
            /* Centrar contenido verticalmente */
        }

        .form-container {
            margin-top: 20px;
            /* Separación del formulario respecto al nav */
        }
        .error-message {
    color: red;
    font-size: 14px;
}
    </style>
</head>

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
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" class="btn btn-primary me-2 btn-sm">Volver</button>
                        </form>
                        <form action="./procesos/logout.php" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Contenido principal -->
            <div class="form-container card shadow-sm p-4 rounded">
                <h3 class="card-title text-center">Añadir Nota para <?php echo htmlspecialchars($_POST['nom_alu']); ?></h3>
                <form action="./procesos/confirmarañadir.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($_POST['nom_alu']); ?>">

                    <!-- Selección de materia -->
                    <div class="mb-3">
                        <label for="materia" class="form-label">Materia:</label>
                        <select name="id_materia" id="materia" class="form-select">
                            <option value="">Seleccione una materia</option>
                            <?php
                            // Consultar las materias disponibles
                            $sqlMaterias = "SELECT m.id_materia as materia, m.nom_materia, n.*
                                            FROM tbl_materias m
                                            INNER JOIN tbl_cursos c ON m.id_curso = c.id_curso
                                            INNER JOIN tbl_alumnos a ON a.id_curso = c.id_curso
                                            LEFT JOIN tbl_notas n ON m.id_materia = n.id_materia AND n.id_alumno = ?
                                            WHERE a.id_alumno = ?
                                            AND n.id_nota IS NULL;";
                            $stmtMaterias = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmtMaterias, $sqlMaterias);
                            mysqli_stmt_bind_param($stmtMaterias, "ii", $id, $id);
                            mysqli_stmt_execute($stmtMaterias);
                            $materias = mysqli_stmt_get_result($stmtMaterias);
                            mysqli_stmt_close($stmtMaterias);
                            foreach ($materias as $materia) {
                                echo '<option value="' . htmlspecialchars($materia['materia']) . '">' . htmlspecialchars($materia['nom_materia']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nota" class="form-label">Nota:</label>
                        <input type="number" step="0.01" name="nota" id="nota" class="form-control" required>
                        <span id="error-pregunta" style="color: red;"></span> 
                    </div>
                    <button type="submit" class="btn btn-success w-100">Crear Nota</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>