<?php 

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $cedula = trim($_POST['cedula']);
        $nombresEstudiante = trim($_POST['nombres']);
        $apellidosEstudiante = trim($_POST['apellidos']);
        $fechaNacimiento = $_POST['fecha-nacimiento'];
        $grado = trim($_POST['grado']);

        $createEstudiante = $conexion -> prepare("INSERT INTO estudiantes (cedula, nombres, apellidos, fechaNacimiento, grado) VALUES (?,?,?,?,?)");
        $createEstudiante ->   bind_param("sssss", $cedula, $nombresEstudiante, $apellidosEstudiante, $fechaNacimiento, $grado);

        if ($createEstudiante -> execute()){
            $_SESSION['mensaje'] = "¡Estudiante Registrado con Éxito!";
        }else{
            $_SESSION['mensaje'] = "¡No se pudo registrar al estudiante!";
        }

        $createEstudiante -> close();
        $conexion -> close();
        header('Location: ../../../RegistroEstudiante.php');
        exit;
    }


?>