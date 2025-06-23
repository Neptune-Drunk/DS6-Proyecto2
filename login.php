<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HyperDrive</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <h1 class="logo">HyperDrive</h1>
                <p class="welcome-text">Bienveido a HyperDrive</p>
            </div>
            
            <form class="login-form" action="autenticar.php" method="post">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="login-btn">Iniciar Sesión</button>
            </form>
            
            <div class="footer-text">
                <p>HyperDrive 2025</p>
            </div>
        </div>
    </div>
</body>
</html>
