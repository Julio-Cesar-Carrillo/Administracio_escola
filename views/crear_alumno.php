<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear alumno</title>
</head>

<body>
    <form action="./procesos/crear_alumno.php" method="post">
        <div>
            <label for="dni_alu">dni_alu</label>
            <input type="text" name="dni_alu">
        </div>
        <div>
            <label for="nom_alu">nom_alu</label>
            <input type="text" name="nom_alu">
        </div>
        <div>
            <label for="cognom1_alu">cognom1_alu</label>
            <input type="text" name="cognom1_alu">
        </div>
        <div>
            <label for="cognom2_alu">cognom2_alu</label>
            <input type="text" name="cognom2_alu">
        </div>
        <div>
            <label for="telf_alu">telf_alu</label>
            <input type="text" name="telf_alu">
        </div>
        <div>
            <label for="email_alu">email_alu</label>
            <input type="text" name="email_alu">
        </div>
        <div>
            <select name="id_curso">
                <?php
                include './procesos/conexion.php';
                include './datos/cursos.php';
                foreach ($cursos as $curso) {
                ?>
                    <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['nom_curso']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <button type="submit">Crear</button>
        <a type="button" href="./index.php" style="text-decoration: none; color:black;">Volver</a>
    </form>
</body>

</html>