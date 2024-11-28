<?php

$servidor = "localhost";
$user = "root";
$pass = "Agustin51";
$db = "db_escuela";

try {
    $conn = mysqli_connect($servidor, $user, $pass, $db);
} catch (Exception $e) {
    echo $e->getMessage();
}
