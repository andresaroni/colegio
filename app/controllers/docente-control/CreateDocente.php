<?php 

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $cedula = $_POST['cedula'];
        $nombres = trim($_POST['nombres']);
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $especialidad = trim($_POST['especialidad']);

        $createDocente = $conexion -> prepare("INSERT INTO maestros (cedula, nombres, telefono, email, especialidad) VALUES (?,?,?,?,?)");
        $createDocente ->   bind_param("sssss", $cedula, $nombres, $telefono, $email, $especialidad);

        if ($createDocente -> execute()){
            $_SESSION['mensaje'] = "¡Docente Registrado con Éxito!";
        }else{
            $_SESSION['mensaje'] = "¡No se pudo registrar al docente!";
        }

        $createDocente -> close();
        $conexion -> close();
        header('Location: ../../../index.php');
        exit;
    }


?>