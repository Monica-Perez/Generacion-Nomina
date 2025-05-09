<?php require_once __DIR__ . '/../../Config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link rel="stylesheet" href="/ingenieriaSW/ProyectoNomina/Public/CSS/Empleados.css">
</head>
<body>
    <div class="form-container">
    <h1>Agregar Empleado</h1>

    <?php if (isset($error)): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

        <form method="POST" action="index.php?controller=empleado&action=crear">

            <label for="">Primer Nombre: </label>
            <input type="text" name="pri_nombre" required><br>

            <label for="">Segundo Nombre: </label>
            <input type="text" name="seg_nombre"><br>

            <label for="">Primer Apellido: </label>
            <input type="text" name="pri_apellido" required><br>

            <label for="">Segundo Apellido: </label>
            <input type="text" name="seg_apellido"><br>

            <label for="">DPI: </label>
            <input type="text" name="dpi" required><br>
            
            <label for="">Fecha Nacimiento: </label>
            <input type="date" name="fecha_nacimiento" required><br>
            
            <label for="">Dirección: </label>
            <input type="text" name="direccion" required><br>
            
            <label for="">Teléfono: </label>
            <input type="text" name="telefono" required><br>
            
            <label for="">Email: </label>
            <input type="email" name="email" required><br>
            
            <label for="">Fecha Ingreso: </label>
            <input type="date" name="fecha_ingreso" required><br>
            
            <label for="">Fecha Baja: </label>
            <input type="date" name="fecha_baja"><br>
            
            <label for="">Estado: </label> 
            <select name="estado" required>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select><br>

            <label for="">Puesto: </label>
            <select name="id_puesto" required>
                <option value="">Seleccione un puesto</option>
                <?php foreach ($puestos as $puesto): ?>
                <option value="<?php echo $puesto['ID_Puesto']; ?>"><?php echo $puesto['Nombre_Puesto']; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            
            <button>Guardar</button>
        </form>
    </div>
    <style>
        .error-message {
            background-color: #ffdddd;
            border-left: 6px solid #f44336;
            margin-bottom: 15px;
            padding: 10px;
            color: #333;
        }
    </style>
</body>
</html>
