<?php
if (!isset($_POST['id'])) {
    header('location:./index.php');
    exit();
} else {
    include 'conexion.php';
    $id = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver notas</title>
</head>

<body>
    <div>
        <?php
        $sql = "SELECT n.*, m.nom_materia FROM tbl_notas n 
                INNER JOIN tbl_materias m ON n.id_materia = m.id_materia 
                WHERE n.id_alumno = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $notas = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        ?>
        <!-- Botón de "Añadir nota" con enlace a añadir.php -->
        <a href="añadir.php?id=<?php echo $id; ?>"><button>Añadir nota</button></a>

        <table>
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($notas as $nota) {
                ?>
                    <tr>
                        <td><?php echo $nota['nom_materia']; ?></td>
                        <td><?php echo $nota['nota']; ?></td>
                        <td>
                            <form action="./editar.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $nota['id_materia']; ?>">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="eliminar.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $nota['id_materia']; ?>">
                                <input type="hidden" name="alumno" value="<?php echo $id; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php
}
?>
