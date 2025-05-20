<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Nómina</title>
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
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=nomina&action=ver" class="active"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-eye text-info"></i> Detalle de Nómina</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5><?= $nomina['nombre_empleado'] ?> - <?= $nomina['Tipo_Nomina'] ?></h5>
                    <p>Fecha de Nómina: <?= date('d/m/Y', strtotime($nomina['Fecha_Nomina'])) ?></p>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th>Salario Base Mensual</th><td>Q<?= number_format($resumen['salario_base'], 2) ?></td></tr>
                            <tr><th>Bono Incentivo</th><td>Q<?= number_format($resumen['bono_incentivo'], 2) ?></td></tr>
                            <tr><th>Bono Antigüedad</th><td>Q<?= number_format($resumen['bono_antiguedad'], 2) ?></td></tr>
                            <tr><th>Bono por Horas Extras</th><td>Q<?= number_format($resumen['bono_horas_extras'], 2) ?></td></tr>
                            <tr><th>Total Bonificaciones</th><td class="text-success font-weight-bold">Q<?= number_format($resumen['total_bonos'], 2) ?></td></tr>
                            <tr><th>ISR</th><td>Q<?= number_format($resumen['ISR'], 2) ?></td></tr>
                            <tr><th>IGSS</th><td>Q<?= number_format($resumen['IGSS'], 2) ?></td></tr>
                            <tr><th>Total Deducciones</th><td class="text-danger font-weight-bold">Q<?= number_format($resumen['total_deducciones'], 2) ?></td></tr>
                            <tr class="table-success">
                                <th>Total Neto del Mes</th>
                                <td><strong>Q<?= number_format($resumen['total_neto'], 2) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if (!empty($detalle)): ?>
                        <h5 class="mt-4">Distribución por Periodo</h5>
                        <table class="table table-sm table-bordered">
                            <thead><tr><th>Periodo</th><th>Monto</th></tr></thead>
                            <tbody>
                                <?php foreach ($detalle as $fila): ?>
                                    <tr>
                                        <td><?= $fila['periodo'] ?></td>
                                        <td>Q<?= number_format($fila['monto'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <div class="card-footer text-right">
                    <a href="core/exportar_detalle.php?id=<?= $nomina['ID_Nomina'] ?>" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Exportar Excel
                    </a>
                    <a href="index.php?controller=nomina&action=ver" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
