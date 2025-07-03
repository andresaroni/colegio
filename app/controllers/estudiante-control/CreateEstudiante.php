<?php 

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $cedula = $_POST['cedula'];
        $nombres = trim($_POST['nombres']);
        $telefono = trim($_POST['telefono']);
        $fechaNacimiento = $_POST['fecha-nacimiento'];

        $createEstudiante = $conexion -> prepare("INSERT INTO estudiantes (cedula, nombres, telefono, fecha_nacimiento) VALUES (?,?,?,?)");
        $createEstudiante ->   bind_param("ssss", $cedula, $nombres, $telefono, $fechaNacimiento);

        if ($createEstudiante -> execute()){
            $_SESSION['mensaje'] = "¡Estudiante Registrado con Éxito!";
        }else{
            $_SESSION['mensaje'] = "¡No se pudo registrar al estudiante!";
        }

        $createEstudiante -> close();
        $conexion -> close();
        header('Location: ../../../index.php');
        exit;
    }


?>