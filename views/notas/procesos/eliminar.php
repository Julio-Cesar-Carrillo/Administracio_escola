<?php
include './conexion.php';
$id_materia = $_POST['id_materia'];
try {
    $sqlChat = "DELETE FROM tbl_notas WHERE id_materia = ?";
    $stmtChat = mysqli_prepare($conn, $sqlChat);
    mysqli_stmt_bind_param($stmtChat, "i", $id_materia);
    mysqli_stmt_execute($stmtChat);
    mysqli_stmt_close($stmtChat);
    mysqli_commit($conn);
?>
    <form action="../index.php" method="POST" name="formulario">
        <input type="hidden" name="nom_alu" value="<?php echo $_POST['nom_alu']; ?>">
        <input type="hidden" name="id" value="<?php echo  $_POST['id']; ?>">
    </form>
    <script language="JavaScript">
        document.formulario.submit();
    </script>
<?php
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo $e->getMessage();
}
mysqli_close($conn);
