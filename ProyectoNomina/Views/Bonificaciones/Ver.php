<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
    <!-- <link rel="stylesheet" href="Public/CSS/styleVer.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<!-- <pre>
    <?php var_dump($bonificaciones); ?>
</pre> -->

    <h1>Lista de Bonificaciones</h1>
    <table class="table table-striped table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($bonificaciones)): ?>
            <?php foreach ($bonificaciones as $empleado): ?>
                <tr>
                    <td><?php echo $empleado['Nombre']; ?></td>
                    <td><?php echo $empleado['Monto']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="14">No se encontraron bonificaciones.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<a href="index.php" id="Regreso">
    <img src="Public/IMG/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
</a>
<style>
/* Estilos generales */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #4361ee;
    --primary-light: #4895ef;
    --dark: #2b2d42;
    --light: #f8f9fa;
    --gray: #6c757d;
    --success: #4cc9f0;
    --warning: #ff9e00;
    --danger: #ef476f;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa, #e4e7ec);
    height: 100vh;
    justify-content: center;
    align-items: center;
    color: var(--dark);
} 
 
h1 {
    font-size: 3em;
    font-weight: 600;
    color: var(--primary);
    text-align: center;
    margin-bottom: 10%:
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    justify-content: center;
    align-items: center;
} 

  table{
    background-color:white;
  }

  h1{
    margin: 0 auto;
    width: 100%;
    text-align: center;
    padding: 3rem;
  }

  .imgRegreso {
    position: absolute;  /* Posiciona el elemento de manera absoluta */
    top: 10px;           /* Ajusta la distancia desde la parte superior */
    left: 10px;          /* Ajusta la distancia desde el lado izquierdo */
    width: 40px;         /* Ajusta el tamaño de la imagen si es necesario */
    height: auto;
    }

    #Regreso {
        text-decoration: none; /* Quita subrayado del enlace */
    }
</style>
</body>
</html>
