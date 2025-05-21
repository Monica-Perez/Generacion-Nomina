<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nómina General</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Sistema de Nómina</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=indemnizacion&action=ver"><i class="fas fa-money-check"></i> Indemnización</a></li>
            <li><a href="index.php?controller=nomina&action=ver" class="active"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-file-invoice-dollar text-primary"></i> Nómina General</h1>
                    <p class="text-muted">Listado de pagos de empleados con sus bonificaciones y deducciones</p>
                </div>
            </div>

            <div class="card">
                <form id="formEliminarMultiples" method="POST" action="index.php?controller=nomina&action=eliminarMultiples" onsubmit="return confirm('¿Desea eliminar las nóminas seleccionadas?');">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0"><i class="fas fa-table"></i> Detalles de Nómina</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-danger btn-sm mr-2">
                                        <i class="fas fa-trash-alt"></i> Eliminar Seleccionadas
                                    </button>

                                    <div class="search-box mr-3">
                                        <div class="input-group">
                                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="core/exportar_nomina.php" class="btn btn-success btn-sm mr-2">
                                        <i class="fas fa-file-excel"></i> Exportar
                                    </a>
                                    <a href="index.php?controller=nomina&action=crear" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus-circle"></i> Generar Nómina
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-container">
                            <table class="table table-striped table-hover" id="nominaTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <button type="button" class="btn btn-sm btn-outline-primary toggleSelectAll">
                                            ✅
                                            </button>
                                        </th>
                                        <th>Empleado</th>
                                        <th>Tipo</th>
                                        <th>Salario Base</th>
                                        <th>Bonos</th>
                                        <th class="small">Incentivo</th>
                                        <th class="small">Antigüedad</th>
                                        <th class="small">Horas Extra</th>
                                        <th>Deducciones</th>
                                        <th class="small">ISR</th>
                                        <th class="small">IGSS</th>
                                        <th>Total Neto</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nominas as $n): ?>
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" value="<?= $n['ID_Nomina'] ?>" class="custom-checkbox"></td>
                                            <td><?= htmlspecialchars($n['nombre_empleado'] ?? 'Empleado') ?></td>

                                            <td class="tipo-nomina-cell" data-id="<?= $n['ID_Nomina'] ?>">
                                                <span class="tipo-nomina-text"><?= $n['Tipo_Nomina'] ?></span>
                                                <select class="form-control form-control-sm tipo-nomina-select d-none" style="width: 120px;">
                                                    <option value="Mensual" <?= $n['Tipo_Nomina'] == 'Mensual' ? 'selected' : '' ?>>Mensual</option>
                                                    <option value="Quincenal" <?= $n['Tipo_Nomina'] == 'Quincenal' ? 'selected' : '' ?>>Quincenal</option>
                                                    <option value="Semanal" <?= $n['Tipo_Nomina'] == 'Semanal' ? 'selected' : '' ?>>Semanal</option>
                                                </select>
                                            </td>

                                            <td>Q<?= number_format($n['Salario_Base'], 2) ?></td>

                                            <td class="text-success"><strong>Q<?= number_format($n['Bono_Incentivo'] + $n['Bono_Antiguedad'] + $n['Bono_HorasExtras'], 2) ?></strong></td>
                                            <td class="text-success">Q<?= number_format($n['Bono_Incentivo'], 2) ?></td>
                                            <td class="text-success">Q<?= number_format($n['Bono_Antiguedad'], 2) ?></td>
                                            <td class="text-success">Q<?= number_format($n['Bono_HorasExtras'], 2) ?></td>

                                            <td class="text-danger"><strong>Q<?= number_format($n['ISR'] + $n['IGSS'], 2) ?></strong></td>
                                            <td class="text-danger">Q<?= number_format($n['ISR'], 2) ?></td>
                                            <td class="text-danger">Q<?= number_format($n['IGSS'], 2) ?></td>

                                            <td><strong>Q<?= number_format($n['Total_Neto'], 2) ?></strong></td>
                                            <td><?= date('d/m/Y', strtotime($n['Fecha_Nomina'])) ?></td>

                                            <td class="text-center">
                                                <a href="index.php?controller=nomina&action=detalle&id=<?= $n['ID_Nomina'] ?>" class="btn btn-sm btn-info mb-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-warning mb-1 editar-tipo-nomina" data-id="<?= $n['ID_Nomina'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="index.php?controller=nomina&action=eliminar&id=<?= $n['ID_Nomina'] ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('¿Está seguro que desea eliminar esta nómina?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                </form>
            </div>

            <div class="card-footer text-right">
                <button onclick="window.print()" class="btn btn-info btn-sm mr-2">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>
        </div>
    </div>

    <script src="Public/JS/Nomina.js?v=<?= time() ?>"></script>

</body>
</html>