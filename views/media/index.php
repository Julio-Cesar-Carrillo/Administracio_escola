<?php
session_start();
include '../procesos/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-text text-white me-auto">
                    <?php echo htmlspecialchars($_SESSION['nom_prof']); ?>
                </span>
                <div class="d-flex">
                    <a href="../" class="btn btn-primary me-2 btn-sm">Volver</a>
                    <a href="../procesos/logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
        </nav>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <td>Curso</td>
                            <td>Materia</td>
                            <td>Media nota</td>
                            <td>Mejor alumno</td>
                            <td>Nota</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT c.nom_curso AS curso, m.nom_materia AS materia, ROUND(AVG(n.nota), 2) AS media_nota, 
                       (SELECT CONCAT(a2.nom_alu, ' ', a2.cognom1_alu, ' ', a2.cognom2_alu)
                        FROM tbl_notas n2
                        
                        JOIN tbl_alumnos a2 ON n2.id_alumno = a2.id_alumno
                        WHERE n2.id_materia = m.id_materia
                        ORDER BY n2.nota DESC LIMIT 1) AS mejor_alumno,
                        MAX(n.nota) AS mejor_nota

                        FROM tbl_notas n
                        JOIN tbl_materias m ON n.id_materia = m.id_materia
                        JOIN tbl_cursos c ON m.id_curso = c.id_curso
                        GROUP BY c.nom_curso, m.nom_materia
                        ORDER BY c.nom_curso, m.nom_materia;";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            foreach ($result as $dato) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($dato['curso']) ?></td>
                                    <td><?php echo htmlspecialchars($dato['materia']) ?></td>
                                    <td><?php echo htmlspecialchars($dato['media_nota']) ?></td>
                                    <td><?php echo htmlspecialchars($dato['mejor_alumno']) ?></td>
                                    <td><?php echo htmlspecialchars($dato['mejor_nota']) ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                </table>
            <?php
                        } else {
            ?>
                <td colspan="5">Aun no se han asignado notas</td>
            <?php
                        }
                        $stmt->close();
                        $conn->close();
            ?>
            </tbody>
            </table>
            </div>
        </div>
    </div>
</body>

</html>