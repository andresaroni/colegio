<?php

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombreMateria = trim($_POST['nombre']);
        $estudianteId  = intval($_POST['estudiante_id']);
        $docenteId     = intval($_POST['docente_id']);
    
        $createMateria = $conexion -> prepare("INSERT INTO materias (nombre, estudiante_id, docente_id) VALUES (?, ?, ?)");
        $createMateria->bind_param("sii", $nombreMateria, $estudianteId, $docenteId);
    
        if ($createMateria->execute()) {
            $_SESSION['mensaje'] = "¡Materia Registrada con Éxito!";
        } else {
            $_SESSION['mensaje'] = "¡Error al Registrar la materia!";
        }
    
        $createMateria->close();
        $conexion->close();
    
        header("Location: ../../../RegistroMateria.php");
        exit;
    }

?>