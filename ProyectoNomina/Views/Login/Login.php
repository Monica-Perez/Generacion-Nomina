<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">Iniciar Sesión</div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if (isset($_GET['cerrado'])): ?>
                        <div class="alert alert-info">Sesión cerrada correctamente.</div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="Nombre_Usuario">Usuario</label>
                            <input type="text" name="Nombre_Usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Contrasena">Contraseña</label>
                            <input type="password" name="Contrasena" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="index.php?controller=login&action=restaurar">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>