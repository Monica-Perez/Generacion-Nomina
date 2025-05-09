<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados | Sistema de Nómina</title>
    <!-- Hojas de estilo de Bootstrap y Font Awesome para iconos y estilos básicos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/ingenieriaSW/ProyectoNomina/Public/CSS/styleVerEmp.css">
    <!-- jQuery para funcionalidades como la búsqueda -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- Menú lateral del sistema -->
    <div class="sidebar">
        <div class="sidebar-header">
            <!-- Logo y título del sistema -->
            <h3>Sistema de Nómina</h3>
        </div>
        <!-- Opciones de navegación principal -->
        <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver" class="active"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=bonificacion&action=crearbon"><i class="fas fa-gift"></i> Bonificaciones</a></li>
            <li><a href="index.php?controller=deduccion&action=index"><i class="fas fa-hand-holding-usd"></i> Deducciones</a></li>
            <li><a href="index.php?controller=nomina&action=index"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
        </ul>
    </div>

    <!-- Contenido principal a la derecha del menú -->
    <div class="main-content">
        <div class="content-container">
            <!-- Encabezado de la página -->
            <div class="header">
                <div class="header-title">
                    <!-- Título con icono de usuarios -->
                    <h1><i class="fas fa-users text-primary"></i> Lista de Empleados</h1>
                    <!-- <p class="text-muted">Administración del personal</p> -->
                </div>
                <div class="header-actions">
                    <!-- Botón para agregar nuevo empleado -->
                    <a href="index.php?controller=empleado&action=crear" class="btn btn-primary ">
                        <i class="fas fa-plus"></i> Nuevo Empleado
                    </a>
                    <!-- Botón para ir a la página de selección para editar -->
                    <a href="index.php?controller=empleado&action=editar" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar Empleado
                    </a>
                    <!-- Botón para dar de BAJA -->
                    <a href="index.php?controller=empleado&action=seleccionar" class="btn btn-danger">
                        <i class="fas fa-ban"></i> Baja de Empleado
                    </a>
                </div>
            </div>

            <!-- Contenedor de la tabla con tarjeta -->
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <!-- Título de la sección -->
                            <h5 class="mb-0">Empleados Registrados</h5>
                        </div>
                        <div class="col-md-6">
                            <!-- Buscador de empleados -->
                            <div class="input-group search-box">
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Cuerpo de la tarjeta con tabla de desplazamiento -->
                <div class="card-body p-0">
                    <?php if (empty($empleados)): ?>
                        <!-- Mensaje cuando no hay empleados -->
                        <div class="alert alert-info m-3">
                            <i class="fas fa-info-circle"></i> No hay empleados registrados en el sistema.
                        </div>
                    <?php else: ?>
                        <!-- Contenedor con desplazamiento solo para la tabla -->
                        <div class="table-container">
                            <table class="table table-striped table-hover" id="employeeTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>DPI</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Fecha Baja</th>
                                        <th>Estado</th>
                                        <th>Puesto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($empleados as $empleado): ?>
                                        <tr>
                                            <!-- Datos de cada empleado -->
                                            <td><?php echo $empleado['ID_Emp'];?></td>
                                            <td>
                                                <?php 
                                                    echo $empleado['PriNombre_Emp'] . ' ' . 
                                                        ($empleado['SegNombre_Emp'] ? $empleado['SegNombre_Emp'] . ' ' : '') . 
                                                        $empleado['PriApellido_Emp'] . ' ' . 
                                                        ($empleado['SegApellido_Emp'] ? $empleado['SegApellido_Emp'] : '');
                                                ?>
                                            </td>
                                            <td><?php echo $empleado['DPI_Emp']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($empleado['FechaNacimiento_Emp'])); ?></td>
                                            <td><?php echo $empleado['Direccion_Emp']; ?></td>
                                            <td><?php echo $empleado['Telefono_Emp']; ?></td>
                                            <td><?php echo $empleado['Email_Emp']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($empleado['FechaIngreso_Emp'])); ?></td>
                                            <td><?php echo $empleado['FechaBaja_Emp'] ? date('d/m/Y', strtotime($empleado['FechaBaja_Emp'])) : '-'; ?></td>
                                            <td>
                                                <!-- Indicador visual del estado del empleado -->
                                                <?php if ($empleado['Estado_Emp'] == 'Activo'): ?>
                                                    <span class="badge badge-success">Activo</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $empleado['Nombre_Puesto']; ?></td>
                                            <td>
                                                <a href="index.php?controller=empleado&action=editar&id=<?php echo $empleado['ID_Emp']; ?>" class="btn btn-primary btn-sm">Editar Empleado</a>
                                                <br><br>
                                                <a href="index.php?controller=empleado&action=editar&id=<?= $empleado['ID_Emp']; ?>"><img src="/ingenieriaSW/ProyectoNomina/Public/IMG/Icons/edit.png" alt="Editar" width="30" height="30"></a>
                                                <br><br>
                                                <a href="index.php?controller=empleado&action=editar&id=1" class="fas fa-user-edit"> (ID 1)</a> 
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Pie de la tarjeta con contador de empleados -->
                <div class="card-footer bg-white">
                    <div class="row">
                        <!-- <div class="col">
                            <small class="text-muted">Mostrando <?php echo count($empleados); ?> empleados</small>
                        </div> -->
                        <div class="col text-right">
                            <button type="button" class="btn btn-info btn-sm mr-2" onclick="window.print()">
                                <i class="fas fa-print"></i> Imprimir
                            </button>
                            <!-- Botón para volver al inicio -->
                            <a href="index.php" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para la funcionalidad de búsqueda -->
    <script>
        // Cuando el documento esté listo
        $(document).ready(function(){
            // Evento que se activa al escribir en el campo de búsqueda
            $("#searchInput").on("keyup", function() {
                // Obtener el valor de búsqueda y convertirlo a minúsculas
                var value = $(this).val().toLowerCase();
                // Filtrar las filas de la tabla
                $("#employeeTable tbody tr").filter(function() {
                    // Mostrar u ocultar filas según si contienen el texto buscado
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>