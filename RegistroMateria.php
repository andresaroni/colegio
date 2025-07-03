<?php 
    session_start();
    require_once './app/config/Connect.php';
    $mensaje = $_SESSION['mensaje'] ?? '';
    unset($_SESSION['mensaje']);

    $estudiantes = $conexion->query("SELECT id_estudiante, nombres, apellidos FROM estudiantes");
    $docentes = $conexion->query("SELECT id_docente, nombres, apellidos FROM docentes");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Materias</title>
    <link rel="stylesheet" href="styles/main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <form class="form-estudiante" action="./app/controllers/materia-control/MateriaCreate.php" method="post">
        <?php if (!empty($mensaje)): ?>
            <h3><?= htmlspecialchars($mensaje) ?></h3>
        <?php endif; ?>
        <h2>Registro de Materias</h2>

        <div class="content-input">
            <i class='bx bxs-book-alt'></i>
            <input type="text" name="nombre" placeholder="Nombre Materia" required>
        </div>

        <div class="content-input">
            <i class='bx bxs-user'></i>
            <select name="estudiante_id" required>
                <option value="">Seleccione un estudiante</option>
                <?php while ($est = $estudiantes->fetch_assoc()): ?>
                    <option value="<?= $est['id_estudiante'] ?>">
                        <?= htmlspecialchars($est['nombres'] . ' ' . $est['apellidos']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="content-input">
            <i class='bx bxs-user'></i>
            <select name="docente_id" required>
                <option value="">Seleccione un docente</option>
                <?php while ($doc = $docentes->fetch_assoc()): ?>
                    <option value="<?= $doc['id_docente'] ?>">
                        <?= htmlspecialchars($doc['nombres'] . ' ' . $doc['apellidos']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <button type="submit">Registrar</button>

    </form>

</body>
</html>