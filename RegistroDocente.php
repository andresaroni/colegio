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
    <title>Registro de Docentes</title>
    <link rel="stylesheet" href="styles/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>



    <form class="form-docente" action="./app/controllers/docente-control/CreateDocente.php" method="post">
        <?php if (!empty($mensaje)): ?>
            <h3><?= htmlspecialchars($mensaje) ?></h3>
        <?php endif; ?>
        <h2>Registro de Docentes</h2>

        <div class="content-input">
            <i class='bx bxs-user' ></i>
            <input type="text" name="nombres" placeholder="Nombres Completos" required>
        </div>

        <div class="content-input">
            <i class='bx bxs-user' ></i>
            <input type="text" name="apellidos" placeholder="Apellidos Completos" required>
        </div>
        
        <div class="content-input">
            <i class='bx bxs-book-bookmark'></i>
            <input type="text" name="especialidad" placeholder="Especialidad" required>
        </div>
        
        <button type="submit">Registrar</button>

    </form>

</body>
</html>