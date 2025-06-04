<?php
// authenticate.php
require_once 'conexion.php';

$username = $_POST['username'] ?? '';
$rol = '';

if ($username) {
    $stmt = $conn->prepare('SELECT Rol FROM Usuarios WHERE NombreUsuario = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($rol);
        $stmt->fetch();
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['rol'] = $rol;
        if ($rol === 'Admin') {
            header('Location: dashboard.php');
            exit();
        } elseif ($rol === 'Consulta') {
            header('Location: consulta.php');
            exit();
        } else {
            echo 'Rol no válido.';
        }
    } else {
        echo 'Usuario no encontrado.';
    }
    $stmt->close();
} else {
    echo 'Por favor, ingrese el nombre de usuario.';
}
$conn->close();
?>
