<?php

$servidor = "localhost";
$user = "root";
$pass = "A";
$db = "db_escuela";

try {
    $conn = mysqli_connect($servidor, $user, $pass, $db);
} catch (Exception $e) {
    echo $e->getMessage();
}
