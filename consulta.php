<?php
// consulta.php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Consulta') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Consulta</title>
</head>
<body>
    <h1>Bienvenido, Usuario de Consulta</h1>
    <p>Este es el panel de consulta.</p>
</body>
</html>
