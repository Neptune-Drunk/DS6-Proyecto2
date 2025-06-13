<?php
// authenticar.php
require_once 'conexion.php';

session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $stmt = $conn->prepare('SELECT Contrasena, Rol FROM Usuarios WHERE NombreUsuario = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password, $rol);
        $stmt->fetch();
        if ($password === $stored_password) {
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
            echo 'Contraseña incorrecta.';
        }
    } else {
        echo 'Usuario no encontrado.';
    }
    $stmt->close();
} else {
    echo 'Por favor, ingrese el nombre de usuario y la contraseña.';
}
$conn->close();
?>
