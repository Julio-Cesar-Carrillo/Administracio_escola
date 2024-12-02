<?php
include 'conexion.php';

// Validar datos recibidos
if (!isset($_POST['id_alumno']) || !isset($_POST['id_materia']) || !isset($_POST['nota'])) {
    echo "Faltan datos para guardar la nota.";
    exit;
}

$idAlumno = $_POST['id_alumno'];
$idMateria = $_POST['id_materia'];
$nota = $_POST['nota'];

// Insertar la nueva nota en la base de datos
$sql = "INSERT INTO tbl_notas (id_alumno, id_materia, nota) VALUES (?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "iis", $idAlumno, $idMateria, $nota);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header('Location: ../listado.php');
exit;
?>
