<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap">
    <title>Attendify - Login</title>
    <link rel="stylesheet" href="/pagina/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="image-section">
            <img src="/pagina/img/login1.jpg" alt="Classroom Image">
        </div>
        <div class="login-section">
          <div class="header"> <h1 class="header-title">Attendify</h1> </div>
            <h2>Acceso</h2>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
                <p>¿No tienes una cuenta? <a href="/pagina/registro/registro.php">Regístrate</a></p>
            </form>
        </div>
    </div>
</body> 
</html>