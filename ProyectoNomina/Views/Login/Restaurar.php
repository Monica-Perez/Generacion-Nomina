<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Recuperar Contraseña</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST" action="index.php?controller=login&action=restaurar">
                        <div class="form-group">
                            <label for="Nombre_Usuario">Nombre de Usuario</label>
                            <input type="text" name="Nombre_Usuario" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Continuar</button>
                    </form>
                    <a href="index.php?controller=login&action=login" class="btn btn-link btn-block">Volver al inicio de sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>