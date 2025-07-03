<?php

    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idMateria = intval($_POST['id-materia']);
        $nombreMateria = trim($_POST['nombreMateria']);
        $nombreEstudiante = trim($_POST['nombreEstudiante']);
        $apellidosEstudiante = trim($_POST['apellidosEstudiante']);
        $nombreDocente = trim($_POST['nombreDocente']);
        $apellidosDocente = trim($_POST['apellidosDocente']);
        error_log($idMateria);

        // 1. Obtener IDs relacionados
        $query = $conexion->prepare("
            SELECT estudiante_id, docente_id FROM materias WHERE id_materia = ?
        ");
        $query->bind_param("i", $idMateria);
        $query->execute();
        $query->bind_result($idEstudiante, $idDocente);
        $query->fetch();
        $query->close();

        // 2. Actualizar tabla materias
        $query = $conexion->prepare("UPDATE materias SET nombre = ? WHERE id_materia = ?");
        $query->bind_param("si", $nombreMateria, $idMateria);
        $query->execute();
        $query->close();

        // 3. Actualizar estudiante
        $query = $conexion->prepare("UPDATE estudiantes SET nombres = ?, apellidos = ? WHERE id_estudiante = ?");
        $query->bind_param("ssi", $nombreEstudiante, $apellidosEstudiante, $idEstudiante);
        $query->execute();
        $query->close();

        // 4. Actualizar docente
        $query = $conexion->prepare("UPDATE docentes SET nombres = ?, apellidos = ? WHERE id_docente = ?");
        $query->bind_param("ssi", $nombreDocente, $apellidosDocente, $idDocente);
        $query->execute();
        $query->close();
    }

    header("Location: ../../../RegistrosTabla.php");
    exit;

?>
