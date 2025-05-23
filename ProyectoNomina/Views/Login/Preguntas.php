<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validación de Seguridad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Contesta tus preguntas de seguridad</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="Nombre_Usuario" value="<?= htmlspecialchars($_POST['Nombre_Usuario']) ?>">

                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <div class="form-group">
                                <label><?= htmlspecialchars($datos["Pregunta$i"]) ?></label>
                                <input type="text" name="Respuesta<?= $i ?>" class="form-control" required>
                            </div>
                        <?php endfor; ?>

                        <div class="form-group">
                            <label for="NuevaContrasena">Nueva Contraseña</label>
                            <input type="password" name="NuevaContrasena" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Actualizar Contraseña</button>
                    </form>
                    <a href="index.php?controller=login&action=login" class="btn btn-link btn-block">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>