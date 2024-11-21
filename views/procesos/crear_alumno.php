<?php

include './conexion.php';

$dni_alu = mysqli_real_escape_string($conn, $_POST['dni_alu']);
$nom_alu = mysqli_real_escape_string($conn, $_POST['nom_alu']);
$cognom1_alu = mysqli_real_escape_string($conn, $_POST['cognom1_alu']);
$cognom2_alu = mysqli_real_escape_string($conn, $_POST['cognom2_alu']);
$telf_alu = mysqli_real_escape_string($conn, $_POST['telf_alu']);
$email_alu = mysqli_real_escape_string($conn, $_POST['email_alu']);
$id_curso = mysqli_real_escape_string($conn, $_POST['id_curso']);
try {

    $sql = "INSERT INTO tbl_alumnos VALUES (NULL,?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $dni_alu, $nom_alu, $cognom1_alu, $cognom2_alu, $telf_alu, $email_alu, $id_curso);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}
