<?php
require_once '../../config/Connect.php';

header('Content-Type: application/json');

$sql = "SELECT e.nombres AS estudiante_nombres, c.nombre AS curso_nombre, m.nombres AS maestro_nombres, i.fecha_inscripcion 
        FROM inscripciones i 
        JOIN estudiantes e ON i.estudiante_id = e.id_estudiante 
        JOIN cursos c ON i.curso_id = c.id_curso 
        JOIN maestros m ON c.maestro_id = m.id_maestro";
$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conexion->close();
?>