<?php
require_once '../../config/Connect.php';

header('Content-Type: application/json');

$sql = "SELECT i.id_inscripcion, e.nombres AS estudiante_nombres, c.nombre AS curso_nombre, i.fecha_inscripcion 
        FROM inscripciones i 
        JOIN estudiantes e ON i.estudiante_id = e.id_estudiante 
        JOIN cursos c ON i.curso_id = c.id_curso";
$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conexion->close();
?>