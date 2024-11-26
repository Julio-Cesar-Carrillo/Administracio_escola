<?php

session_start();
if (!isset($_SESSION['id_prof'])) {
    header("location:../index.php");
}
include './procesos/conexion.php';

$id_alumno = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center">
        <div style="width: 100%; max-width: 500px;">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
                <div class="container-fluid">
                    <span class="navbar-text text-white me-auto">
                        <?php echo htmlspecialchars($_SESSION['nom_prof']); ?>
                    </span>
                    <span class="navbar-text text-white me-auto">

                    </span>
                    <span class="navbar-text text-white me-auto">
                        Editar alumno
                    </span>
                    <div class="d-flex">
                        <a href="./" class="btn btn-primary me-2 btn-sm">Volver</a>
                        <a href="./procesos/logout.php" class="btn btn-danger btn-sm">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Formulario -->
            <div class="form-container card shadow-sm p-4 rounded">
                <?php
                $sql = "SELECT a.*, c.nom_curso 
                        FROM tbl_alumnos a 
                        INNER JOIN tbl_cursos c ON a.id_curso = c.id_curso 
                        WHERE a.id_alumno = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_alumno);
                mysqli_stmt_execute($stmt);
                $datos = mysqli_stmt_get_result($stmt);
                $dato = mysqli_fetch_assoc($datos);
                ?>
                <form action="./procesos/confirmareditar.php" method="post">
                    <input type="hidden" name="id_alumno" value="<?php echo $dato['id_alumno']; ?>">
                    <div class="row flex-row">
                        <div class="col-6 col-md-12 mb-2">
                            <label for="dni_alu" class="form-label">DNI</label>
                            <input type="text" id="dni_alu" name="dni_alu" class="form-control" value="<?php echo $dato['dni_alu']; ?>" required>
                        </div>

                        <div class="col-6 col-md-12 mb-2">
                            <label for="nom_alu" class="form-label">Nombre</label>
                            <input type="text" id="nom_alu" name="nom_alu" class="form-control" value="<?php echo $dato['nom_alu']; ?>" required>
                        </div>
                    </div>

                    <div class="row flex-row">
                        <div class="col-6 col-md-12 mb-2">
                            <label for="cognom1_alu" class="form-label">Primer Apellido</label>
                            <input type="text" id="cognom1_alu" name="cognom1_alu" class="form-control" value="<?php echo $dato['cognom1_alu']; ?>" required>
                        </div>

                        <div class="col-6 col-md-12 mb-2">
                            <label for="cognom2_alu" class="form-label">Segundo Apellido</label>
                            <input type="text" id="cognom2_alu" name="cognom2_alu" class="form-control" value="<?php echo $dato['cognom2_alu']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="telf_alu" class="form-label">Teléfono</label>
                        <input type="text" id="telf_alu" name="telf_alu" class="form-control" value="<?php echo $dato['telf_alu']; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="email_alu" class="form-label">Email</label>
                        <input type="email" id="email_alu" name="email_alu" class="form-control" value="<?php echo $dato['email_alu']; ?>" required>
                    </div>

                    <div class="mb-2 col-12">
                        <label for="curso" class="form-label">Curso</label>
                        <select id="curso" name="id_curso" class="form-select">
                            <?php
                            include './datos/cursos.php';
                            foreach ($cursos as $curso) {
                            ?>
                                <option value="<?php echo $curso['id_curso']; ?>" <?php echo $dato['id_curso'] == $curso['id_curso'] ? 'selected' : ''; ?>>
                                    <?php echo $curso['nom_curso']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mt-3 d-flex justify-content-between">
                        <button type="submit" class="btn btn-success w-50 me-2">Confirmar</button>
                        <a href="./" class="btn btn-danger w-50">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>