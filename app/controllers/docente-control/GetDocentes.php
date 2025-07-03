<?php
require_once '../../config/Connect.php';

header('Content-Type: application/json');

$sql = "SELECT id_maestro, cedula, nombres, telefono, email, especialidad FROM maestros";
$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conexion->close();
?>