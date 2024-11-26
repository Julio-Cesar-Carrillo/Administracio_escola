<?php
include './procesos/conexion.php';

if (isset($_POST['id_nota']) && isset($_POST['alumno'])) {
    $id_nota = $_POST['id_nota'];
    $id_alumno = $_POST['alumno'];

    $sqlVerificar = "SELECT * FROM tbl_notas WHERE id_nota = ? AND id_alumno = ?";
    $stmtVerificar = mysqli_prepare($conn, $sqlVerificar);
    mysqli_stmt_bind_param($stmtVerificar, "ii", $id_nota, $id_alumno);
    mysqli_stmt_execute($stmtVerificar);
    $resultado = mysqli_stmt_get_result($stmtVerificar);

    if (mysqli_num_rows($resultado) > 0) {
        
        $sqlEliminar = "DELETE FROM tbl_notas WHERE id_nota = ?";
        $stmtEliminar = mysqli_prepare($conn, $sqlEliminar);
        mysqli_stmt_bind_param($stmtEliminar, "i", $id_nota);
        if (mysqli_stmt_execute($stmtEliminar)) {
          
            header("Location: ../index.php?id=" . $id_alumno);
            exit();
        } else {
            echo "Error al eliminar la nota.";
        }
    } else {
        echo "No se encontró ninguna nota con ese ID.";
    }

    mysqli_stmt_close($stmtVerificar);
    mysqli_stmt_close($stmtEliminar);
}
?>
