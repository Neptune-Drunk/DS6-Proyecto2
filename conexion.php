<?php
// conexion.php
$host = 'localhost';
$db = 'ds6proy2';
$user = 'ds62025'; // Cambia si tu usuario de MySQL es diferente
$pass = '1234';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
