<?php
require_once '../../config/Connect.php';

header('Content-Type: application/json');

$sql = "
    SELECT 
        (SELECT COUNT(*) FROM estudiantes) AS total_estudiantes,
        (SELECT COUNT(*) FROM maestros) AS total_maestros,
        (SELECT COUNT(*) FROM cursos) AS total_cursos,
        (SELECT COUNT(*) FROM inscripciones) AS total_inscripciones
";

$result = $conexion->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);

$conexion->close();
?>