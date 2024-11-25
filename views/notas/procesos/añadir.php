<?php
include 'conexion.php';

// Validar si se recibe el ID del alumno
if (!isset($_POST['id'])) {
    echo "ID de alumno no especificado.";
    exit;
}

$id = $_POST['id'];

// Consultar las materias disponibles para el curso del alumno
$sqlMaterias = "SELECT m.id_materia, m.nom_materia 
                FROM tbl_materias m 
                INNER JOIN tbl_cursos c ON m.id_curso = c.id_curso
                INNER JOIN tbl_alumnos a ON a.id_curso = c.id_curso
                WHERE a.id_alumno = ?";
$stmtMaterias = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmtMaterias, $sqlMaterias);
mysqli_stmt_bind_param($stmtMaterias, "i", $id);
mysqli_stmt_execute($stmtMaterias);
$materias = mysqli_stmt_get_result($stmtMaterias);
mysqli_stmt_close($stmtMaterias);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nota</title>
</head>

<body>
    <div>
        <h2>Añadir nota para el alumno</h2>
        <form action="guardar_nota.php" method="post">
            <input type="hidden" name="id_alumno" value="<?php echo $id; ?>">
            
            <label for="materia">Materia:</label>
            <select name="id_materia" id="materia" required>
                <option value="">Seleccione una materia</option>
                <?php
                foreach ($materias as $materia) {
                    echo '<option value="' . $materia['id_materia'] . '">' . $materia['nom_materia'] . '</option>';
                }
                ?>
            </select>

            <label for="nota">Nota:</label>
            <input type="number" step="0.01" name="nota" id="nota" required min="0" max="10">

            <button type="submit">Guardar Nota</button>
            <a href="../listado.php"><button type="button">Cancelar</button></a>
        </form>
    </div>
</body>

</html>
