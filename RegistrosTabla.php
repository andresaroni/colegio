<?php
    require_once './app/config/Connect.php';

    $query = $conexion->query("
        SELECT m.id_materia, m.nombre AS materia,
            e.nombres AS nombre_estudiante, e.apellidos AS apellido_estudiante,
            d.nombres AS nombre_docente, d.apellidos AS apellido_docente
        FROM materias m
        INNER JOIN estudiantes e ON m.estudiante_id = e.id_estudiante
        INNER JOIN docentes d ON m.docente_id = d.id_docente
    ");

    $datos = $query->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Colegio</title>
    <style>
        body{
            background-color: black !important;
            padding: 1rem ;
        }
    </style>
    <!-- Librería Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Librería Bootstrap 5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

</head>
<body>

    <!-- Tabla -->
    <div class="contenedor py-5">
        <table class="table">
            <thead>
                <tr class="table-dark text-center">
                    <th scope="col">Código</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($datos as $row): ?>
                    <tr class="text-center">
                        <td><strong><?php echo $row['id_materia']; ?></strong></td>
                        <td><strong><?php echo $row['materia']; ?></strong></td>
                        <td><strong><?php echo $row['nombre_estudiante'] . ' ' . $row['apellido_estudiante']; ?></strong></td>
                        <td><strong><?php echo $row['nombre_docente'] . ' ' . $row['apellido_docente']; ?></strong></td>
                        <td>
                            <a  class="btn btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditarTabla"
                                data-id="<?php echo $row['id_materia']; ?>"
                                data-materia="<?php echo $row['materia']; ?>"
                                data-nombres-estudiante="<?php echo $row['nombre_estudiante']; ?>"
                                data-apellidos-estudiante="<?php echo $row['apellido_estudiante']; ?>"
                                data-nombres-docente="<?php echo $row['nombre_docente']; ?>"
                                data-apellidos-docente="<?php echo $row['apellido_docente']; ?>">
                                <i class='bx bxs-edit-alt bx-xs'></i>
                            </a>
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" 
                                data-id="<?php echo $row['id_materia']; ?>">
                                <i class='bx bxs-trash'></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para editar -->
    <div class="modal fade" id="modalEditarTabla" tabindex="-1" aria-labelledby="modalEditarTablaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title w-100 text-center" id="modalEditarTablaLabel"><strong>Editar Campo</strong></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditarTabla" action="./app/controllers/materia-control/MateriaUpdate.php" method="POST">
                        
                        <input type="hidden" id="id-materia-editar" name="id-materia">

                        <div class="mb-3">
                            <label for="nombreM" class="form-label"><strong>Nombre Materia:</strong></label>
                            <input type="text" class="form-control" id="id-nombreMateria" name="nombreMateria" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombreE" class="form-label"><strong>Nombres Estudiante:</strong></label>
                            <input type="text" class="form-control" id="id-nombreEstudiante" name="nombreEstudiante" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidosE" class="form-label"><strong>Apellidos Estudiante:</strong></label>
                            <input type="text" class="form-control" id="id-apellidosEstudiante" name="apellidosEstudiante" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombreD" class="form-label"><strong>Nombres Docente:</strong></label>
                            <input type="text" class="form-control" id="id-nombreDocente" name="nombreDocente" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidosD" class="form-label"><strong>Apellidos Docente:</strong></label>
                            <input type="text" class="form-control" id="id-apellidosDocente" name="apellidosDocente" required>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><strong><i class='bx bxs-x-circle'></i> Cerrar</strong></button>
                            <button type="submit" class="btn btn-primary"><strong><i class='bx bxs-save'></i> Guardar Cambios</strong></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para eliminar --> 
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalLabelEliminar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title text-center w-100" id="modalLabelEliminar"><strong>Eliminar Registro</strong></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <strong>¿Está seguro de eliminar este registro?</strong>
                </div>

                <div class="modal-footer">
                    <form action="./app/controllers/materia-control/MateriaDelete.php" method="post" id="formEliminar">
                        <input type="hidden" id="id-registro" name="id-materia">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><strong>Cancelar</strong></button>
                        <button type="submit" class="btn btn-danger"><strong>Eliminar</strong></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const editar = document.querySelectorAll('[data-bs-target="#modalEditarTabla"]');
            const eliminar = document.querySelectorAll('[data-bs-target="#modalEliminar"]');

            editar.forEach(button => {

                button.addEventListener('click', function() {

                    const id = button.getAttribute('data-id');
                    const materia = button.getAttribute('data-materia');
                    const nombresEstudiante = button.getAttribute('data-nombres-estudiante');
                    const apellidosEstudiante = button.getAttribute('data-apellidos-estudiante');
                    const nombresDocente = button.getAttribute('data-nombres-docente');
                    const apellidosDocente = button.getAttribute('data-apellidos-docente');

                    document.getElementById('id-materia-editar').value = id;
                    document.getElementById('id-nombreMateria').value = materia;
                    document.getElementById('id-nombreEstudiante').value = nombresEstudiante;
                    document.getElementById('id-apellidosEstudiante').value = apellidosEstudiante;
                    document.getElementById('id-nombreDocente').value = nombresDocente;
                    document.getElementById('id-apellidosDocente').value = apellidosDocente;

                });

            });

            eliminar.forEach(button => {

                button.addEventListener('click', function() {

                    const id = button.getAttribute('data-id');

                    document.getElementById('id-registro').value = id;

                });

            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>