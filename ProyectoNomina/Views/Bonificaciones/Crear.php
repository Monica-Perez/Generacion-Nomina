<?php require_once __DIR__ . '/../../Config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonificaciones</title>
    <link rel="stylesheet" href="/ingenieriaSW/ProyectoNomina/Public/CSS/Empleados.css">
</head>
<body>
    <div class="form-container">
    <h1>Agregar Bonificacion</h1>
        <form method="POST" action="index.php?controller=bonificacion&action=crear">

            <label for="">Nombre Bonificacion: </label>
            <input type="text" name="nombre" required><br>

            <label for="">Monto: </label>
            <input type="text" name="monto"><br>

            <button>Guardar</button>
        </form>
    </div>
</body>
</html>
