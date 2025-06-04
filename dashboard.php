<?php
// dashboard.php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Bienvenido, Administrador</h1>
    <p>Este es el panel de administración.</p>
</body>
</html>
