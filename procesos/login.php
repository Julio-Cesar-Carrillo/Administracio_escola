<?php

$nombre = htmlspecialchars($_POST['user']);
$pwd = htmlspecialchars($_POST['pwd']);

include 'validaCampo.php';


include 'conexion.php';
try {
    $sql = "SELECT * FROM tbl_profesores WHERE nom_prof=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nombre);
    mysqli_stmt_execute($stmt);
    $datos = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($datos);
    if ($num_rows > 0) {
        $fila = mysqli_fetch_assoc($datos);
        if (password_verify($pwd, $fila['pwd_prof'])) {
            session_start();
            $_SESSION['id_prof'] = $fila['id_prof'];
            $_SESSION['nom_prof'] = $fila['nom_prof'];
            header('location: ../views');
            die();
        } else {
            header('Location:../index.php?error=5');
            die();
        }
    } else {
        header("Location:../index.php?error=5");
        die();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    mysqli_close($conn);
    die();
}
