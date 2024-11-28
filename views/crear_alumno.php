<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear alumno</title>
    <script src="./js/validaciones.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center">
        <div style="width: 100%; max-width: 500px;">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
                <div class="container-fluid">
                    <span class="navbar-text text-white me-auto">
                        <?php session_start();
                        echo htmlspecialchars($_SESSION['nom_prof']); ?>
                    </span>
                    <span class="navbar-text text-white me-auto"></span>
                    <span class="navbar-text text-white me-auto">
                        Crear alumno
                    </span>
                    <div class="d-flex">
                        <a href="./" class="btn btn-primary me-2 btn-sm">Volver</a>
                        <a href="./procesos/logout.php" class="btn btn-danger btn-sm">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Formulario -->
            <div class="form-container card shadow-sm p-4 rounded">
                <form action="./procesos/crear_alumno.php" method="post">
                    <div class="row flex-row">
                        <div class="col-6 col-md-12 mb-2">
                            <label for="dni_alu" class="form-label">DNI</label>
                            <input type="text" name="dni_alu" class="form-control">
                        </div>
                        <div class="col-6 col-md-12 mb-2">
                            <label for="nom_alu" class="form-label">Nombre</label>
                            <input type="text" name="nom_alu" class="form-control">
                        </div>
                    </div>
                    <div class="row flex-row">
                        <div class="col-6 col-md-12 mb-2">
                            <label for="cognom1_alu" class="form-label">Apellido</label>
                            <input type="text" name="cognom1_alu" class="form-control">
                        </div>
                        <div class="col-6 col-md-12 mb-2">
                            <label for="cognom2_alu" class="form-label">Segundo apellido</label>
                            <input type="text" name="cognom2_alu" class="form-control">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="telf_alu" class="form-label">Telefono</label>
                        <input type="text" name="telf_alu" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="email_alu" class="form-label">Email</label>
                        <input type="text" name="email_alu" class="form-control">
                    </div>
                    <div class="mb-2 col-12">
                        <label for="curso" class="form-label">Curso</label>
                        <select name="id_curso" class="form-select">
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
                    <div class="mt-3 d-flex justify-content-between">
                        <button type="submit" class="btn btn-success w-50 me-2">Crear</button>
                        <a href="./" class="btn btn-danger w-50">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>