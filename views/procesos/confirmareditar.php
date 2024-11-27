<?php

include './conexion.php';

$id_alumno = mysqli_real_escape_string($conn, $_POST['id_alumno']);
$dni_alu = mysqli_real_escape_string($conn, $_POST['dni_alu']);
$nom_alu = mysqli_real_escape_string($conn, $_POST['nom_alu']);
$cognom1_alu = mysqli_real_escape_string($conn, $_POST['cognom1_alu']);
$cognom2_alu = mysqli_real_escape_string($conn, $_POST['cognom2_alu']);
$telf_alu = mysqli_real_escape_string($conn, $_POST['telf_alu']);
$email_alu = mysqli_real_escape_string($conn, $_POST['email_alu']);
$id_curso = mysqli_real_escape_string($conn, $_POST['id_curso']);

try {
    $sqlaceptar = "UPDATE tbl_alumnos 
    SET dni_alu = ? , nom_alu = ?, cognom1_alu = ?, cognom2_alu = ?, telf_alu = ?, email_alu = ?, id_curso = ?
    WHERE id_alumno = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sqlaceptar);
    mysqli_stmt_bind_param($stmt, "ssssssii", $dni_alu, $nom_alu, $cognom1_alu, $cognom2_alu, $telf_alu, $email_alu, $id_curso, $id_alumno);
    mysqli_stmt_execute($stmt);
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('location:../?num_resultados=5&nom_alu=' . $nom_alu . '&cognom1_alu=' . $cognom1_alu . '&curso=' . $id_curso . '');
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}
