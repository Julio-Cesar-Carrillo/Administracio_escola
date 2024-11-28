<?php
session_start();
if (!isset($_POST['id'])) {
    header('location:index.php');
} else {
    include './procesos/conexion.php';
    $id_alumno = $_POST['id'];
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Añadir Nota</title>
    </head>

    <body>
        <div>
            <h1>Añadir Nota</h1>
            <form action="procesos/guardar_nota.php" method="post">
                <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">

                <div>
                    <label for="id_materia">Materia:</label>
                    <select name="id_materia" required>
                        <option value="">Selecciona una materia</option>
                        <?php
                        $sql = "SELECT id_materia, nom_materia FROM tbl_materias";
                        $result = mysqli_query($conn, $sql);
                        while ($materia = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $materia['id_materia']; ?>">
                                <?php echo $materia['nom_materia']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="nota">Nota:</label>
                    <input type="number" name="nota" step="0.1" min="0" max="10" required>
                </div>

                <button type="submit">Guardar Nota</button>
                <a href="index.php" style="text-decoration: none; color: black;">Cancelar</a>
            </form>
        </div>
    </body>

    </html>
<?php
}
?>
