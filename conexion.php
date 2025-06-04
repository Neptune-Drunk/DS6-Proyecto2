<?php
// conexion.php
$host = 'localhost';
$db = 'ds6proy2';
$user = 'root'; // Cambia si tu usuario de MySQL es diferente
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
