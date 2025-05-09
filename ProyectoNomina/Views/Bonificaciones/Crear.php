<?php require_once __DIR__ . '/../../Config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonificaciones</title>
    <link rel="stylesheet" href="/ProyectoNomina/Public/CSS/Empleados.css">
</head>
<body>
    <h1>Crear Bonificación</h1>
    <form action="index.php?controller=bonificacion&action=crearBonificacion" method="POST">
        <label for="TipoBonificacion_Bonif">Tipo de Bonificación:</label>
        <input type="text" name="TipoBonificacion_Bonif" id="TipoBonificacion_Bonif" required><br><br>
        
        <label for="Monto_Bonif">Monto:</label>
        <input type="number" step="0.01" name="Monto_Bonif" id="Monto_Bonif" required><br><br>
        
        <label for="Motivo_Bonif">Motivo:</label>
        <textarea name="Motivo_Bonif" id="Motivo_Bonif" required></textarea><br><br>
        
        <button type="submit">Crear Bonificación</button>
    </form>

    <br>
    <a href="index.php?controller=bonificacion&action=verBonificaciones">Volver a Ver Bonificaciones</a>
</body>
</html>
