<?php 

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $maestro_asignado = $_POST['maestro-asignado'];

        $createCurso = $conexion -> prepare("INSERT INTO cursos (nombre, descripcion, maestro_id) VALUES (?,?,?)");
        $createCurso ->   bind_param("ssi", $nombre, $descripcion, $maestro_asignado);

        if ($createCurso -> execute()){
            $_SESSION['mensaje'] = "¡Docente Registrado con Éxito!";
        }else{
            $_SESSION['mensaje'] = "¡No se pudo registrar al docente!";
        }

        $createCurso -> close();
        $conexion -> close();
        header('Location: ../../../index.php');
        exit;
    }


?>