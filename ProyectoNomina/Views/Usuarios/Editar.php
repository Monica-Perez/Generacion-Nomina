<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVerEmp.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Sistema de Nómina</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php"  class="active"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=usuario&action=ver"><i class="fas fa-user-shield"></i> Usuarios</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=indemnizacion&action=ver"><i class="fas fa-money-check"></i> Indemnización</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
        <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
        <li><a href="index.php?controller=login&action=logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-user-edit text-primary"></i> Editar Usuario</h1>
                    <p class="text-muted">Modificar información del usuario</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Formulario de Edición</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="index.php?controller=usuario&action=editar&id=<?= $usuario['ID_Usuario'] ?>">
                        <div class="form-group">
                            <label for="Nombre_Empleado">Empleado:</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Nombre_Empleado']) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Nombre_Usuario">Nombre de Usuario:</label>
                            <input type="text" name="Nombre_Usuario" id="Nombre_Usuario" class="form-control" value="<?= htmlspecialchars($usuario['Nombre_Usuario']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="Rol">Rol:</label>
                            <select name="Rol" id="Rol" class="form-control" required>
                                <option value="Admin" <?= $usuario['Rol'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="RRHH" <?= $usuario['Rol'] === 'RRHH' ? 'selected' : '' ?>>RRHH</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="NuevaContrasena">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="NuevaContrasena" name="NuevaContrasena" placeholder="Dejar en blanco si no se desea cambiar">
                        </div>

                        <div class="form-group">
                            <label for="Estado_Emp">Estado del Empleado:</label>
                            <input type="text" class="form-control" id="Estado_Emp" value="<?= htmlspecialchars($usuario['Estado_Emp']) ?>" readonly>
                        </div>

                        <hr>
                        <h5>Preguntas de Seguridad</h5>

                        <?php
                        $preguntasDisponibles = [
                            1 => [
                                "¿Restaurante de tu infancia?",
                                "¿Nombre de tu primera mascota?",
                                "¿Nombre de tu primer/a novia/o?",
                                "¿Película de héroes favorita?"
                            ],
                            2 => [
                                "¿Nombre de tu mejor amigo en primaria?",
                                "¿Nombre de tu ingeniero favorito?",
                                "¿Canción que más te marcó de adolescente?",
                                "¿Nombre de tu personaje animado favorito?"
                            ],
                            3 => [
                                "¿Lugar de fantasía favorito?",
                                "¿Nombre del primer videojuego que jugaste?",
                                "¿Plataforma de streaming favorita?",
                                "¿Nombre de tu profesor universitario más estricto?"
                            ],
                            4 => [
                                "¿Nombre de tu comadre?",
                                "¿Nombre de tu equipo deportivo favorito?",
                                "¿Nombre de tu abuela materna?",
                                "¿Lugar donde diste tu primer beso 😳?"
                            ]
                        ];
                        ?>

                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <div class="form-group">
                                <label for="Pregunta<?= $i ?>">Pregunta <?= $i ?>:</label>
                                <select name="Pregunta<?= $i ?>" id="Pregunta<?= $i ?>" class="form-control" required>
                                    <option value="">Seleccione una pregunta</option>
                                    <?php foreach ($preguntasDisponibles[$i] as $pregunta): ?>
                                        <option value="<?= $pregunta ?>" <?= $usuario["Pregunta$i"] === $pregunta ? 'selected' : '' ?>>
                                            <?= $pregunta ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Respuesta<?= $i ?>">Respuesta <?= $i ?>:</label>
                                <input type="text" name="Respuesta<?= $i ?>" id="Respuesta<?= $i ?>" class="form-control" value="<?= htmlspecialchars($usuario["Respuesta$i"]) ?>" required>
                            </div>
                        <?php endfor; ?>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                        <a href="index.php?controller=usuario&action=ver" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>