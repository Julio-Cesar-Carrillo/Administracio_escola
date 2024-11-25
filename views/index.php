<?php

session_start();
if (!isset($_SESSION['id_prof'])) {
    header("location:../index.php");
} else {
    include './procesos/conexion.php';

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alumnos</title>
        <link rel="stylesheet" href="./css/styles.css">
    </head>

    <body>
        <div class="container">
            <h1>Bienvenido, <?php
                            echo $_SESSION['nom_prof'];
                            ?>!</h1>
        </div>

        <div>
            <form action="" method="post">
                <input type="text" name="nom_alu" value="<?php
                                                            if (isset($_POST['nom_alu'])) {
                                                                echo $_POST['nom_alu'];
                                                            }
                                                            ?>">
                <input type="text" name="cognom1_alu" value="<?php
                                                                if (isset($_POST['cognom1_alu'])) {
                                                                    echo $_POST['cognom1_alu'];
                                                                }
                                                                ?>">
                <select name="curso">
                    <option value="">Selecciona un curso</option>
                    <?php
                    include './datos/cursos.php';

                    foreach ($cursos as $curso) {
                    ?>
                        <option value="<?php echo $curso['id_curso']; ?>" <?php echo isset($_POST['curso']) && $_POST['curso'] === $curso['id_curso'] ? "selected" : ""  ?>><?php echo $curso['nom_curso']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <button type="submit">Buscar</button>
                <button><a href="./index.php" style="text-decoration: none; color:black;">Limpiar filtros</a></button>
                <a type="button" href="./crear_alumno.php" style="text-decoration: none; color:black;">Crear alumno</a>
            </form>

        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apllidos</th>
                        <th>Curso</th>
                        <th>Notas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT a.*, c.nom_curso FROM tbl_alumnos a INNER JOIN tbl_cursos c ON a.id_curso=c.id_curso WHERE 1=1";
                    if (!empty($_POST['nom_alu'])) {
                        $filtronombre = $_POST['nom_alu'];
                        $sql .= " AND a.nom_alu LIKE '%$filtronombre%'";
                    }
                    if (!empty($_POST['cognom1_alu'])) {
                        $filtroapellido1 = $_POST['cognom1_alu'];
                        $sql .= " AND a.cognom1_alu LIKE '%$filtroapellido1%'";
                    }
                    if (!empty($_POST['curso'])) {
                        $filtrocurso = $_POST['curso'];
                        $sql .= " AND c.id_curso = $filtrocurso";
                    }
                    $alumnos = mysqli_query($conn, $sql);
                    foreach ($alumnos as $alumno) {
                    ?>
                        <tr>
                            <td><?php echo $alumno['nom_alu']; ?></td>
                            <td><?php echo $alumno['cognom1_alu']; ?>
                                <?php echo $alumno['cognom2_alu']; ?></td>
                            <td><?php echo $alumno['nom_curso']; ?></td>
                            <td>
                                <form action="./notas/procesos/index.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $alumno['id_alumno']; ?>">
                                    <button type="submit">Notas</button>
                                </form>
                            </td>
                            <td>
                                <form action="./editar.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $alumno['id_alumno']; ?>">
                                    <button type="submit">Editar</button>
                                </form>
                                <form action="./procesos/eliminar.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $alumno['id_alumno']; ?>">
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