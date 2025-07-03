<?php
require_once '../../config/Connect.php';

header('Content-Type: application/json');

$sql = "SELECT id_estudiante, cedula, nombres, telefono, fecha_nacimiento FROM estudiantes";
$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conexion->close();
?>