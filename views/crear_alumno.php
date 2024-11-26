<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear alumno</title>
    <script src="../js/validaciones.js"></script>
</head>

<body>
    <form action="./procesos/crear_alumno.php" method="post">
        <div>
            <label for="dni_alu">DNI:</label>
            <input type="text" name="dni_alu" required>
        </div>
        <div>
            <label for="nom_alu">Nombre:</label>
            <input type="text" name="nom_alu" required>
        </div>
        <div>
            <label for="cognom1_alu">Primer Apellido:</label>
            <input type="text" name="cognom1_alu" required>
        </div>
        <div>
            <label for="cognom2_alu">Segundo Apellido:</label>
            <input type="text" name="cognom2_alu">
        </div>
        <div>
            <label for="telf_alu">Teléfono:</label>
            <input type="text" name="telf_alu" required>
        </div>
        <div>
            <label for="email_alu">Correo Electrónico:</label>
            <input type="text" name="email_alu" required>
        </div>
        <div>
            <label for="id_curso">Curso:</label>
            <select name="id_curso" required>
                <option value="">Selecciona un curso</option>
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
        <a href="./index.php" style="text-decoration: none; color:black;">Volver</a>
    </form>
</body>

</html>