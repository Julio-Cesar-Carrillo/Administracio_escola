<?php
include './conexion.php';
$id_materia = $_POST['id'];
try {
    // Iniciar transacción
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

    // Eliminar historial de chat
    $sqlChat = "DELETE FROM tbl_notas WHERE id_materia = ?";
    $stmtChat = mysqli_prepare($conn, $sqlChat);
    mysqli_stmt_bind_param($stmtChat, "i", $id_materia);
    mysqli_stmt_execute($stmtChat);
    mysqli_stmt_close($stmtChat);

    // Commit de la transacción
    mysqli_commit($conn);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo $e->getMessage();
}
mysqli_close($conn);
