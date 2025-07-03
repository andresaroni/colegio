<?php 

    session_start();
    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $nombresDocente = trim($_POST['nombres']);
        $apellidosDocente = trim($_POST['apellidos']);
        $especialidad = trim($_POST['especialidad']);

        $createDocente = $conexion -> prepare("INSERT INTO docentes (nombres, apellidos, especialidad) VALUES (?,?,?)");
        $createDocente ->   bind_param("sss", $nombresDocente, $apellidosDocente, $especialidad);

        if ($createDocente -> execute()){
            $_SESSION['mensaje'] = "¡Docente Registrado con Éxito!";
        }else{
            $_SESSION['mensaje'] = "¡No se pudo registrar al docente!";
        }

        $createDocente -> close();
        $conexion -> close();
        header('Location: ../../../RegistroDocente.php');
        exit;
    }


?>