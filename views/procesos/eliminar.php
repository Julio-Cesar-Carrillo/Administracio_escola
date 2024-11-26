<?php
include './conexion.php';
$id_alumno = $_POST['id'];
$link = $_POST['Link'];
// echo $link;
// exit();
try {
    // Iniciar transacción
    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

    // Eliminar historial de chat
    $sqlChat = "DELETE FROM tbl_notas WHERE id_alumno = ?";
    $stmtChat = mysqli_prepare($conn, $sqlChat);
    mysqli_stmt_bind_param($stmtChat, "i", $id_alumno);
    mysqli_stmt_execute($stmtChat);
    mysqli_stmt_close($stmtChat);

    // Eliminar amistad
    $sql = "DELETE FROM tbl_alumnos WHERE id_alumno = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_alumno);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Commit de la transacción
    mysqli_commit($conn);
    header('location:' . $link . '');
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo $e->getMessage();
}
mysqli_close($conn);
