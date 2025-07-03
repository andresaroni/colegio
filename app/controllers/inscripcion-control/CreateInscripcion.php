<?php 

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $estudiante = $_POST['estudiante-inscripcion'];
        $curso = $_POST['curso-inscripcion'];

        $createInscripcion = $conexion -> prepare("INSERT INTO inscripciones (estudiante_id, curso_id, fecha_inscripcion) VALUES (?,?,NOW())");
        $createInscripcion ->   bind_param("ii", $estudiante, $curso);

        if ($createInscripcion -> execute()){
            $_SESSION['mensaje'] = "¡Inscripción con Éxito!";
        }else{
            $_SESSION['mensaje'] = "¡No se pudo inscribir!";
        }

        $createInscripcion -> close();
        $conexion -> close();
        header('Location: ../../../index.php');
        exit;
    }


?>