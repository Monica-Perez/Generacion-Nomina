<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
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
                    <h1><i class="fas fa-user-plus text-primary"></i> Crear Usuario</h1>
                    <p class="text-muted">Formulario para registrar nuevos usuarios del sistema</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Formulario de Registro</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="index.php?controller=usuario&action=crear">
                        <div class="form-group">
                            <label for="ID_Emp">Empleado (solo Analistas de RRHH):</label>
                            <select name="ID_Emp" id="ID_Emp" class="form-control" required>
                                <option value="">Seleccione un empleado</option>
                                <?php foreach ($empleados as $emp): ?>
                                    <option value="<?= $emp['ID_Emp'] ?>"><?= htmlspecialchars($emp['Nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Nombre_Usuario">Nombre de Usuario:</label>
                            <input type="text" name="Nombre_Usuario" id="Nombre_Usuario" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Contrasena">Contraseña:</label>
                            <input type="password" name="Contrasena" id="Contrasena" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Rol">Rol:</label>
                            <select name="Rol" id="Rol" class="form-control" required>
                                <option value="">Seleccione un rol</option>
                                <option value="Admin">Admin</option>
                                <option value="RRHH">RRHH</option>
                            </select>
                        </div>

                        <hr>
                        <h5>Preguntas de Seguridad</h5>

                        <!-- Pregunta 1 -->
                        <div class="form-group">
                            <label for="Pregunta1">Pregunta 1:</label>
                            <select name="Pregunta1" id="Pregunta1" class="form-control" required>
                                <option value="">Seleccione una pregunta</option>
                                <option value="¿Restaurante de tu infancia?">¿Restaurante de tu infancia?</option>
                                <option value="¿Nombre de tu primera mascota?">¿Nombre de tu primera mascota?</option>
                                <option value="¿Nombre de tu primer/a novia/o?">¿Nombre de tu primer/a novia/o?</option>
                                <option value="¿Película de héroes favorita?">¿Película de héroes favorita?</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Respuesta1">Respuesta 1:</label>
                            <input type="text" name="Respuesta1" id="Respuesta1" class="form-control" required>
                        </div>

                        <!-- Pregunta 2 -->
                        <div class="form-group">
                            <label for="Pregunta2">Pregunta 2:</label>
                            <select name="Pregunta2" id="Pregunta2" class="form-control" required>
                                <option value="">Seleccione una pregunta</option>
                                <option value="¿Nombre de tu mejor amigo en primaria?">¿Nombre de tu mejor amigo en primaria?</option>
                                <option value="¿Nombre de tu ingeniero favorito?">¿Nombre de tu ingeniero favorito?</option>
                                <option value="¿Canción que más te marcó de adolescente?">¿Canción que más te marcó de adolescente?</option>
                                <option value="¿Nombre de tu personaje animado favorito?">¿Nombre de tu personaje animado favorito?</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Respuesta2">Respuesta 2:</label>
                            <input type="text" name="Respuesta2" id="Respuesta2" class="form-control" required>
                        </div>

                        <!-- Pregunta 3 -->
                        <div class="form-group">
                            <label for="Pregunta3">Pregunta 3:</label>
                            <select name="Pregunta3" id="Pregunta3" class="form-control" required>
                                <option value="">Seleccione una pregunta</option>
                                <option value="¿Lugar de fantasia favorito?">¿Lugar de fantasia favorito?</option>
                                <option value="¿Nombre del primer videojuego que jugaste?">¿Nombre del primer videojuego que jugaste?</option>
                                <option value="¿Plataforma de streaming favorita?">¿Plataforma de streaming favorita?</option>
                                <option value="¿Nombre de tu profesor universitario más estricto?">¿Nombre de tu profesor universitario más estricto?</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Respuesta3">Respuesta 3:</label>
                            <input type="text" name="Respuesta3" id="Respuesta3" class="form-control" required>
                        </div>

                        <!-- Pregunta 4 -->
                        <div class="form-group">
                            <label for="Pregunta4">Pregunta 4:</label>
                            <select name="Pregunta4" id="Pregunta4" class="form-control" required>
                                <option value="">Seleccione una pregunta</option>
                                <option value="¿Nombre de tu comadre?">¿Nombre de tu comadre?</option>
                                <option value="¿Nombre de tu equipo deportivo favorito?">¿Nombre de tu equipo deportivo favorito?</option>
                                <option value="¿Nombre de tu abuela materna?">¿Nombre de tu abuela materna?</option>
                                <option value="¿Lugar donde diste tu primer beso?">¿Lugar donde diste tu primer beso 😳?</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Respuesta4">Respuesta 4:</label>
                            <input type="text" name="Respuesta4" id="Respuesta4" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar Usuario
                        </button>
                        <a href="index.php?controller=usuario&action=ver" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="Public/JS/Usuarios.js?v=<?= time() ?>"></script>
</body>
</html>