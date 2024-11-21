<?php

session_start();
if (!isset($_SESSION['id_prof'])) {
    header("location:../index.php");
} else {
    include './procesos/conexion.php';

    $id_alumno = $_POST['id'];
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
        <div>
            <?php
            $sql = "SELECT a.*, c.nom_curso 
                    FROM tbl_alumnos a 
                    INNER JOIN tbl_cursos c ON a.id_curso = c.id_curso 
                    WHERE a.id_alumno = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id_alumno);
            mysqli_stmt_execute($stmt);
            $datos = mysqli_stmt_get_result($stmt);
            foreach ($datos as $dato) {
            ?>
                <form action="./procesos/confirmareditar.php" method="post">
                    <input type="hidden" name="id_alumno" value="<?php echo $dato['id_alumno']; ?>">
                    <div>
                        <label for="dni_alu">dni_alu</label>
                        <input type="text" name="dni_alu" value="<?php echo $dato['dni_alu']; ?>">
                    </div>
                    <div>
                        <label for="nom_alu">nom_alu</label>
                        <input type="text" name="nom_alu" value="<?php echo $dato['nom_alu']; ?>">
                    </div>
                    <div>
                        <label for="cognom1_alu">cognom1_alu</label>
                        <input type="text" name="cognom1_alu" value="<?php echo $dato['cognom1_alu']; ?>">
                    </div>
                    <div>
                        <label for="cognom2_alu">cognom2_alu</label>
                        <input type="text" name="cognom2_alu" value="<?php echo $dato['cognom2_alu']; ?>">
                    </div>
                    <div>
                        <label for="telf_alu">telf_alu</label>
                        <input type="text" name="telf_alu" value="<?php echo $dato['telf_alu']; ?>">
                    </div>
                    <div>
                        <label for="email_alu">cognom2_alu</label>
                        <input type="text" name="email_alu" value="<?php echo $dato['email_alu']; ?>">
                    </div>
                    <div>
                        <select name="id_curso">
                            <?php
                            include './datos/cursos.php';
                            foreach ($cursos as $curso) {
                            ?>
                                <option value="<?php echo $curso['id_curso']; ?>" <?php echo isset($_POST['curso']) && $_POST['curso'] === $curso['id_curso'] ? "selected" : ""  ?>><?php echo $curso['nom_curso']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit">Confirmar</button>
                </form>
            <?php
            }
            ?>
        </div>
    </body>

    </html>
<?php
        mysqli_stmt_close($stmt);
}
?>