<?php
include './procesos/conexion.php';
$id = $_POST['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Añadir Nota</title>
</head>

<body>
    <div>
        <h2>Añadir nota para el alumno</h2>
        <form action="./procesos/confirmarañadir.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="materia">Materia:</label>
            <select name="id_materia" id="materia">
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
                    echo '<option value="' . $materia['materia'] . '">' . $materia['nom_materia'] . '</option>';
                }
                ?>
            </select>

            <label for="nota">Nota:</label>
            <input type="number" step="0.01" name="nota" id="nota" min="0" max="10">

            <button type="submit">Crear Nota</button>
        </form>
    </div>
</body>

</html>