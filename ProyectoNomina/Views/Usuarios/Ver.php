<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios del Sistema</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVerEmp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                    <h1><i class="fas fa-user-shield text-primary"></i> Lista de Usuarios</h1>
                    <p class="text-muted">Usuarios registrados con preguntas de seguridad</p>
                </div>
                <div class="header-actions">
                    <a href="index.php?controller=usuario&action=crear" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Usuario
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-shield text-primary"></i> Usuarios Registrados</h5>
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Buscar usuario...">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (empty($usuarios)): ?>
                        <div class="alert alert-info m-3">
                            <i class="fas fa-info-circle"></i> No hay usuarios registrados en el sistema.
                        </div>
                    <?php else: ?>
                        <div class="table-container">
                            <table class="table table-bordered table-hover" id="usuarioTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Empleado</th>
                                        <th>Pregunta 1</th>
                                        <th>Pregunta 2</th>
                                        <th>Pregunta 3</th>
                                        <th>Pregunta 4</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $u): ?>
                                        <tr>
                                            <td><?= $u['ID_Usuario'] ?></td>
                                            <td><?= htmlspecialchars($u['Nombre_Usuario']) ?></td>
                                            <td><span class="badge badge-info"><?= $u['Rol'] ?></span></td>
                                            <td><?= htmlspecialchars($u['Nombre_Empleado']) ?></td>
                                            <td><?= htmlspecialchars($u['Pregunta1']) ?></td>
                                            <td><?= htmlspecialchars($u['Pregunta2']) ?></td>
                                            <td><?= htmlspecialchars($u['Pregunta3']) ?></td>
                                            <td><?= htmlspecialchars($u['Pregunta4']) ?></td>
                                            <td>
                                                <a href="index.php?controller=usuario&action=editar&id=<?= $u['ID_Usuario'] ?>" class="btn btn-sm btn-warning mb-1" title="Editar usuario">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info btn-sm mr-2" onclick="window.print()" title="Imprimir lista">
                            <i class="fas fa-print"></i> Imprimir
                        </button>
                        <a href="index.php" class="btn btn-secondary btn-sm" title="Volver al inicio">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#usuarioTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>