<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
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
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver" class="active"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver" class="active"><i class="fas fa-chart-line"></i> Productividad</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-users text-primary"></i> Lista de Empleados</h1>
                </div>
                <div class="header-actions">
                    <a href="index.php?controller=empleado&action=crear" class="btn btn-primary ">
                        <i class="fas fa-plus"></i> Nuevo Empleado
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Empleados Registrados</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group search-box">
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <?php if (empty($empleados)): ?>
                        <div class="alert alert-info m-3">
                            <i class="fas fa-info-circle"></i> No hay empleados registrados en el sistema.
                        </div>
                    <?php else: ?>
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
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($empleados as $empleado): ?>
                                        <tr>
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
                                                <?php if ($empleado['Estado_Emp'] == 'Activo'): ?>
                                                    <span class="badge badge-success">Activo</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $empleado['Nombre_Puesto']; ?></td>
                                            <td>
                                                <a href="index.php?controller=empleado&action=editar&id=<?= $empleado['ID_Emp']; ?>" class="btn btn-sm btn-warning mb-1">
                                                    <i class="fas fa-edit"></i></a>
                                                <br> 
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="card-footer bg-white">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="btn btn-info btn-sm mr-2" onclick="window.print()">
                                <i class="fas fa-print"></i> Imprimir
                            </button>
                            <a href="index.php" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#employeeTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>