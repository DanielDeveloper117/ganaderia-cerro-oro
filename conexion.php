<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rancho_cerro_oro";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa<br>";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

?>