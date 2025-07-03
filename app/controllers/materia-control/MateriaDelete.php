<?php

    require_once '../../config/Connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = intval($_POST['id-materia']);
        $query = $conexion->prepare("DELETE FROM materias WHERE id_materia = ?");
        $query->bind_param("i", $id);

        $query->execute();
        $query->close();
    }

    header("Location: ../../../RegistrosTabla.php");

exit;
