<?php
if (!isset($_GET['id'])) {
    die("ID de alumno no especificado.");
}

include 'conexion.php';
$id = $_GET['id'];

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_alumno = $_POST['id_alumno'];
    $id_materia = $_POST['id_materia'];
    $nota = $_POST['nota'];

    // Verificar si ya existe una nota para esta materia y alumno
    $sqlCheck = "SELECT * FROM tbl_notas WHERE id_alumno = ? AND id_materia = ?";
    $stmtCheck = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmtCheck, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "ii", $id_alumno, $id_materia);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    mysqli_stmt_close($stmtCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        // Ya existe una nota para este alumno y materia
        echo "Ya existe una nota registrada para esta materia.";
    } else {
        // Insertar la nueva nota
        $sql = "INSERT INTO tbl_notas (id_alumno, id_materia, nota) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "iis", $id_alumno, $id_materia, $nota);
            $execute = mysqli_stmt_execute($stmt);

            
            if ($execute) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                header('Location: http://localhost/adminescola/Administracio_escola/views/notas/procesos/index.php?id=' . $id_alumno);
                exit(); 
            } else {
                echo "Error al guardar la nota.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
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
        <form action="añadir.php?id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id_alumno" value="<?php echo $id; ?>">

            <label for="materia">Materia:</label>
            <select name="id_materia" id="materia" required>
                <option value="">Seleccione una materia</option>
                <?php
                // Consultar las materias disponibles
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

                foreach ($materias as $materia) {
                    echo '<option value="' . $materia['id_materia'] . '">' . $materia['nom_materia'] . '</option>';
                }
                ?>
            </select>

            <label for="nota">Nota:</label>
            <input type="number" step="0.01" name="nota" id="nota" required min="0" max="10">

            <button type="submit">Guardar Nota</button>
        </form>
    </div>
</body>

</html>
