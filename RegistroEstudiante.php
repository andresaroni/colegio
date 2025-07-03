<?php 
    session_start();
    $mensaje = $_SESSION['mensaje'] ?? '';
    unset($_SESSION['mensaje']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="styles/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>



    <form class="form-estudiante" action="./app/controllers/estudiante-control/CreateEstudiante.php" method="post">
        <?php if (!empty($mensaje)): ?>
            <h3><?= htmlspecialchars($mensaje) ?></h3>
        <?php endif; ?>
        <h2>Registro de Estudiantes</h2>

        <div class="content-input">
            <i class='bx bx-id-card'></i>
            <input type="text" name="cedula" placeholder="Cedula" required>
        </div>

        <div class="content-input">
            <i class='bx bxs-user' ></i>
            <input type="text" name="nombres" placeholder="Nombres Completos" required>
        </div>

        <div class="content-input">
            <i class='bx bxs-user' ></i>
            <input type="text" name="apellidos" placeholder="Apellidos Completos" required>
        </div>

        <div class="content-input">
            <i class='bx bx-calendar' ></i>
            <input type="date" name="fecha-nacimiento" placeholder="Fecha Nacimiento" required>
        </div>
        
        <div class="content-input">
            <i class='bx bxs-graduation' ></i>
            <input type="text" name="grado" placeholder="Grado" required>
        </div>
        
        <button type="submit">Registrar</button>

    </form>

</body>
</html>