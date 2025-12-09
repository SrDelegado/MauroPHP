<?php

$root_dir = __DIR__ . '/../';
if (file_exists($root_dir . '.env')) {
    $lines = file($root_dir . '.env', FILE_IGNORE_EMPTY_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') === false) {
            list($key, $value) = explode('=', $line, 2);
            putenv(sprintf('%s=%s', trim($key), trim($value)));
        }
    }
}

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

$conexion = mysqli_connect($host, $user, $pass, $name);

if (!$conexion) {

    error_log("Fallo de conexión a la BD: " . mysqli_connect_error()); 
    die("Error crítico: No se pudo establecer la conexión con la base de datos."); 
}

mysqli_set_charset($conexion, "utf8mb4");
?>