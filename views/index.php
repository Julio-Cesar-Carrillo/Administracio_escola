<?php
session_start();
if (!isset($_SESSION['id_prof'])) {
    header("Location: ../index.php");
    exit();
}
include './procesos/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">Sistema de Alumnos</a>
                <div class="d-flex align-items-center">
                    <span class="navbar-text text-white me-3">¡Hola, <?php echo htmlspecialchars($_SESSION['nom_prof']); ?>!</span>
                    <a href="./procesos/logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
        </nav>

        <!-- Filtros de búsqueda -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="" method="get" class="row g-3">
                    <div class="col-md-2">
                        <label for="num_resultados" class="form-label">Resultados por página:</label>
                        <select name="num_resultados" id="num_resultados" class="form-select">
                            <option value="3" <?php echo isset($_GET['num_resultados']) && $_GET['num_resultados'] == 3 ? "selected" : ""; ?>>3</option>
                            <option value="5" <?php echo isset($_GET['num_resultados']) && $_GET['num_resultados'] == 5 ? "selected" : ""; ?>>5</option>
                            <option value="10" <?php echo isset($_GET['num_resultados']) && $_GET['num_resultados'] == 10 ? "selected" : ""; ?>>10</option>
                            <option value="20" <?php echo isset($_GET['num_resultados']) && $_GET['num_resultados'] == 20 ? "selected" : ""; ?>>20</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="nom_alu" class="form-label">Nombre:</label>
                        <input type="text" name="nom_alu" id="nom_alu" class="form-control" value="<?php echo isset($_GET['nom_alu']) ? htmlspecialchars($_GET['nom_alu']) : ''; ?>" placeholder="Nombre">
                    </div>
                    <div class="col-md-3">
                        <label for="cognom1_alu" class="form-label">Primer apellido:</label>
                        <input type="text" name="cognom1_alu" id="cognom1_alu" class="form-control" value="<?php echo isset($_GET['cognom1_alu']) ? htmlspecialchars($_GET['cognom1_alu']) : ''; ?>" placeholder="Primer apellido">
                    </div>
                    <div class="col-md-3">
                        <label for="curso" class="form-label">Curso:</label>
                        <select name="curso" id="curso" class="form-select">
                            <option value="">Seleccionar curso</option>
                            <?php
                            include './datos/cursos.php';
                            foreach ($cursos as $curso) {
                                $selected = isset($_GET['curso']) && $_GET['curso'] == $curso['id_curso'] ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($curso['id_curso']) . '" ' . $selected . '>' . htmlspecialchars($curso['nom_curso']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-success me-2">Buscar</button>
                        <a href="./index.php" class="btn btn-secondary me-2">Limpiar</a>
                        <a href="./media" class="btn btn-info me-2">Media de notas</a>
                        <a href="./crear_alumno.php" class="btn btn-primary me-2">Nuevo Alumno</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de alumnos -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Notas</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num_resultados = isset($_GET['num_resultados']) ? $_GET['num_resultados'] : 3;

                        // Consulta para contar registros totales
                        $sql = "SELECT COUNT(*) as total_alumnos 
                                FROM tbl_alumnos a 
                                INNER JOIN tbl_cursos c ON a.id_curso = c.id_curso 
                                WHERE 1=1";

                        if (!empty($_GET['nom_alu'])) {
                            $filtronombre = mysqli_real_escape_string($conn, $_GET['nom_alu']);
                            $sql .= " AND a.nom_alu LIKE '%$filtronombre%'";
                        }
                        if (!empty($_GET['cognom1_alu'])) {
                            $filtroapellido1 = mysqli_real_escape_string($conn, $_GET['cognom1_alu']);
                            $sql .= " AND a.cognom1_alu LIKE '%$filtroapellido1%'";
                        }
                        if (!empty($_GET['curso'])) {
                            $filtrocurso = (int)$_GET['curso'];
                            $sql .= " AND c.id_curso = $filtrocurso";
                        }

                        $result = mysqli_query($conn, $sql);
                        if ($result && $row = mysqli_fetch_assoc($result)) {
                            $num_total_rows = $row['total_alumnos'];

                            if ($num_total_rows > 0) {
                                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                $page = max(1, $page);
                                $start = ($page - 1) * $num_resultados;
                                $total_pages = ceil($num_total_rows / $num_resultados);

                                $sql = "SELECT a.*, c.nom_curso 
                                        FROM tbl_alumnos a 
                                        INNER JOIN tbl_cursos c ON a.id_curso = c.id_curso 
                                        WHERE 1=1 ";

                                if (!empty($_GET['nom_alu'])) {
                                    $sql .= " AND a.nom_alu LIKE '%$filtronombre%'";
                                }
                                if (!empty($_GET['cognom1_alu'])) {
                                    $sql .= " AND a.cognom1_alu LIKE '%$filtroapellido1%'";
                                }
                                if (!empty($_GET['curso'])) {
                                    $sql .= " AND c.id_curso = $filtrocurso";
                                }

                                $sql .= " ORDER BY a.id_alumno ASC LIMIT $start, $num_resultados";
                                $alumnos = mysqli_query($conn, $sql);
                                foreach ($alumnos as $alumno) {
                        ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($alumno['nom_alu']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['cognom1_alu']) . ' ' . htmlspecialchars($alumno['cognom2_alu']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['nom_curso']); ?></td>
                                        <td>
                                            <form action="./notas/index.php" method="post">
                                                <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($alumno['nom_alu']); ?>">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($alumno['id_alumno']); ?>">
                                                <button type="submit" class="btn btn-info btn-sm">Notas</button>
                                            </form>
                                        </td>

                                        <td>
                                            <form action="./editar.php" method="post" class="d-inline">
                                                <input type="hidden" name="nom_alu" value="<?php echo htmlspecialchars($alumno['nom_alu']); ?>">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($alumno['id_alumno']); ?>">
                                                <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                            </form>
                                            <form action="./procesos/eliminar.php" method="post" class="d-inline" onsubmit="confirmarEliminacion(event, '<?php echo htmlspecialchars($alumno['nom_alu']); ?>')">
                                                <input type="hidden" name="Link" value="<?php $enlace_actual = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                                                                        echo $enlace_actual; ?>">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($alumno['id_alumno']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>

                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center">No hay alumnos que mostrar.</td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    <?php
                    if ($num_total_rows > 0) {
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $query_params = $_GET; // Obtener los parámetros actuales
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $query_params['page'] = $i; // Establecer el número de página
                                $url = '?' . http_build_query($query_params); // Construir la URL con los parámetros
                                $active_class = $i == $page ? 'btn-primary' : 'btn-secondary'; // Clase para la página activa
                                echo '<a href="' . $url . '" class="btn ' . $active_class . ' btn-sm mx-1">' . $i . '</a>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Función para confirmar la eliminación con SweetAlert
    function confirmarEliminacion(event, nombre) {
        event.preventDefault(); // Evitar el envío inmediato del formulario

        // Mostrar SweetAlert de confirmación
        Swal.fire({
            title: '¿Estás seguro de eliminar a ' + nombre + '?',
            text: "¡No podrás deshacer esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario
                event.target.submit();
            }
        });
    }
</script>

</html>