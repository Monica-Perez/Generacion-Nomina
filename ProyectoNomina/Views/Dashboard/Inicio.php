<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Nómina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="Public/CSS/styleVer.css">
    </head>
    <body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Sistema de Nómina</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php"  class="active"><i class="fas fa-home"></i> Inicio</a></li>
            <?php if ($_SESSION['Rol'] === 'admin'): ?>
                <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
                <li><a href="index.php?controller=usuario&action=ver"><i class="fas fa-user-shield"></i> Usuarios</a></li>
            <?php endif; ?>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=indemnizacion&action=ver"><i class="fas fa-money-check"></i> Indemnización</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
            <li><a href="index.php?controller=login&action=logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="content-container">
            <div class="card">
                <div class="header">
                    <div class="header-title">
                        <h1><i class="fas fa-folder-open text-primary"></i> Recursos Humanos</h1>
                    </div>
                </div>
                <img src="Public/IMG/rrhh3.jpg" alt="RRHH" class="imagen-rrhh">
            </div>
        </div>
    </div>

    <style>
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            height: 100vh;
            overflow-y: auto;
        }
        .content-container {
            padding: 30px;
            max-width: 1800px;
            height: 100vh;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            margin-left: 60px;
            margin-bottom: 10px;
        }
        .header-title h1 {
            margin: 1;
            font-size: 3.5rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
        }
        .imagen-rrhh {
            max-width: 800px;
            width: 45%;
            height: auto;
            margin-left: 30rem;
        } 
    </style>
</body>
</html>