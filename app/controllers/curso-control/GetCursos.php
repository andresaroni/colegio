<?php
require_once '../../config/Connect.php';

header('Content-Type: application/json');

$sql = "SELECT c.id_curso, c.nombre, c.descripcion, m.nombres AS maestro_nombres 
        FROM cursos c 
        JOIN maestros m ON c.maestro_id = m.id_maestro";
$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conexion->close();
?>