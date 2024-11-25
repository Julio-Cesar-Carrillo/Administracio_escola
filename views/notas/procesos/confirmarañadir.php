<?php
$id = $_POST['id'];
$id_materia = $_POST['id_materia'];
$nota = $_POST['nota'];
include './conexion.php';
try {
    $sql = "INSERT INTO tbl_notas (id_alumno, id_materia, nota) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iis", $id, $id_materia, $nota);
        $execute = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
?>
        <form action="../index.php" method="POST" name="formulario">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        </form>
        <script language="JavaScript">
            document.formulario.submit();
        </script>
<?php
        exit();
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
} catch (\Throwable $th) {
    //throw $th;
}
