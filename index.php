<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $clase = strpos($mensaje, 'Éxito') !== false ? 'success' : 'error';
    echo "<div class='message $clase'>$mensaje</div>";
    unset($_SESSION['mensaje']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Académica</title>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Sistema de Gestión Académica</h1>
            <p>Administra estudiantes, maestros y cursos de manera eficiente</p>
        </div>

        <div class="nav-tabs">
            <button class="tab-button active" onclick="showTab('dashboard')">📊 Dashboard</button>
            <button class="tab-button" onclick="showTab('estudiantes')">👥 Estudiantes</button>
            <button class="tab-button" onclick="showTab('maestros')">👨‍🏫 Maestros</button>
            <button class="tab-button" onclick="showTab('cursos')">📚 Cursos</button>
            <button class="tab-button" onclick="showTab('inscripciones')">📝 Inscripciones</button>
            <button class="tab-button" onclick="showTab('reportes')">📋 Reportes</button>
        </div>

        <!-- Dashboard -->
        <div id="dashboard" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="total-estudiantes">0</div>
                    <div>Total Estudiantes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="total-maestros">0</div>
                    <div>Total Maestros</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="total-cursos">0</div>
                    <div>Total Cursos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="total-inscripciones">0</div>
                    <div>Total Inscripciones</div>
                </div>
            </div>
        </div>

        <!-- Estudiantes -->
        <div id="estudiantes" class="tab-content">
            <h2>Registro de Estudiantes</h2>
            <div id="mensaje-estudiante"></div>

            <form id="form-estudiante" action="./app/controllers/estudiante-control/CreateEstudiante.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cedula-estudiante">Cédula</label>
                        <input type="text" id="cedula-estudiante" name="cedula" maxlength="10" pattern="\d{10}" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre-estudiante">Nombres Completo</label>
                        <input type="text" id="nombre-estudiante" name="nombres" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono-estudiante">Teléfono</label>
                        <input type="tel" id="telefono-estudiante" name="telefono" maxlength="10" pattern="\d{10}">
                    </div>
                    <div class="form-group">
                        <label for="fecha-nacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required>
                    </div>
                </div>
                <button type="submit" class="btn">Registrar Estudiante</button>
            </form>

            <div id="lista-estudiantes"></div>
        </div>

        <!-- Maestros -->
        <div id="maestros" class="tab-content">
            <h2>Registro de Maestros</h2>
            <div id="mensaje-maestro"></div>

            <form id="form-maestro" action="./app/controllers/docente-control/CreateDocente.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cedula-maestro">Cédula</label>
                        <input type="text" id="cedula-maestro" name="cedula" maxlength="10" pattern="\d{10}" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre-maestro">Nombres Completo</label>
                        <input type="text" id="nombre-maestro" name="nombres" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono-maestro">Teléfono</label>
                        <input type="tel" id="telefono-maestro" name="telefono" maxlength="10" pattern="\d{10}">
                    </div>
                    <div class="form-group">
                        <label for="email-maestro">Email</label>
                        <input type="email" id="email-maestro" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="especialidad">Especialidad</label>
                        <input type="text" id="especialidad" name="especialidad" required>
                    </div>
                </div>
                <button type="submit" class="btn">Registrar Maestro</button>
            </form>

            <div id="lista-maestros"></div>
        </div>

        <!-- Cursos -->
        <div id="cursos" class="tab-content">
            <h2>Registro de Cursos</h2>
            <div id="mensaje-curso"></div>

            <form id="form-curso" action="./app/controllers/curso-control/CreateCurso.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre-curso">Nombre del Curso</label>
                        <input type="text" id="nombre-curso" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion-curso">Descripción</label>
                        <textarea id="descripcion-curso" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="maestro-curso">Asignar Maestro a este curso</label>
                        <select id="maestro-curso" name="maestro-asignado" required>
                            <option value="">Seleccionar Maestro</option>
                            <?php
                            require('./app/config/Connect.php');
                            $sql_maestros = "SELECT id_maestro, nombres FROM maestros";
                            $result_maestros = $conexion->query($sql_maestros);
                            while ($row = $result_maestros->fetch_assoc()) {
                                echo "<option value='" . $row['id_maestro'] . "'>" . $row['nombres'] . "</option>";
                            }
                            $conexion->close();
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn">Registrar Curso</button>
            </form>

            <div id="lista-cursos"></div>
        </div>

        <!-- Inscripciones -->
        <div id="inscripciones" class="tab-content">
            <h2>Inscripción de Estudiantes</h2>
            <div id="mensaje-inscripcion"></div>

            <form id="form-inscripcion" action="./app/controllers/inscripcion-control/CreateInscripcion.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="estudiante-inscripcion">Estudiante</label>
                        <select id="estudiante-inscripcion" name="estudiante-inscripcion" required>
                            <option value="">Seleccionar Estudiante</option>
                            <?php
                            require('./app/config/Connect.php');
                            $sql_estudiantes = "SELECT id_estudiante, nombres FROM estudiantes";
                            $result_estudiantes = $conexion->query($sql_estudiantes);
                            while ($row = $result_estudiantes->fetch_assoc()) {
                                echo "<option value='" . $row['id_estudiante'] . "'>" . $row['nombres'] . "</option>";
                            }
                            $conexion->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="curso-inscripcion">Curso</label>
                        <select id="curso-inscripcion" name="curso-inscripcion" required>
                            <option value="">Seleccionar Curso</option>
                            <?php
                            require('./app/config/Connect.php');
                            $sql_cursos = "SELECT id_curso, nombre FROM cursos";
                            $result_cursos = $conexion->query($sql_cursos);
                            while ($row = $result_cursos->fetch_assoc()) {
                                echo "<option value='" . $row['id_curso'] . "'>" . $row['nombre'] . "</option>";
                            }
                            $conexion->close();
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn">Inscribir Estudiante</button>
            </form>

            <div id="lista-inscripciones"></div>
        </div>

        <!-- Reportes -->
        <div id="reportes" class="tab-content">
            <h2>Reportes Detallados</h2>
            <div id="reportes-contenido"></div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');

            // Load data based on tab
            switch (tabName) {
                case 'dashboard':
                    actualizarDashboard();
                    break;
                case 'estudiantes':
                    mostrarEstudiantes();
                    break;
                case 'maestros':
                    mostrarMaestros();
                    break;
                case 'cursos':
                    mostrarCursos();
                    break;
                case 'inscripciones':
                    mostrarInscripciones();
                    break;
                case 'reportes':
                    mostrarReportes();
                    break;
            }
        }

        // Fetch data via AJAX
        function fetchData(url, callback) {
            fetch(url)
                .then(response => response.json())
                .then(data => callback(data))
                .catch(error => console.error('Error:', error));
        }

        // Update dashboard totals
        function actualizarDashboard() {
            fetchData('./app/controllers/dashboard-control/GetDashboard.php', data => {
                document.getElementById('total-estudiantes').textContent = data.total_estudiantes;
                document.getElementById('total-maestros').textContent = data.total_maestros;
                document.getElementById('total-cursos').textContent = data.total_cursos;
                document.getElementById('total-inscripciones').textContent = data.total_inscripciones;
            });
        }

        // Show students list
        function mostrarEstudiantes() {
            fetchData('./app/controllers/estudiante-control/GetEstudiantes.php', data => {
                const lista = document.getElementById('lista-estudiantes');
                lista.innerHTML = '';
                if (data.length === 0) {
                    lista.innerHTML = '<div class="message error">No hay estudiantes registrados.</div>';
                    return;
                }
                data.forEach(estudiante => {
                    lista.innerHTML += `
                <div class="card">
                    <h3>${estudiante.nombres}</h3>
                    <p>Cédula: ${estudiante.cedula}</p>
                    <p>Teléfono: ${estudiante.telefono || 'N/A'}</p>
                    <p>Fecha Nacimiento: ${estudiante.fecha_nacimiento}</p>
                </div>
            `;
                });
            });
        }

        // Show teachers list
        function mostrarMaestros() {
            fetchData('./app/controllers/docente-control/GetDocentes.php', data => {
                const lista = document.getElementById('lista-maestros');
                lista.innerHTML = '';
                if (data.length === 0) {
                    lista.innerHTML = '<div class="message error">No hay maestros registrados.</div>';
                    return;
                }
                data.forEach(maestro => {
                    lista.innerHTML += `
                <div class="card">
                    <h3>${maestro.nombres}</h3>
                    <p>Cédula: ${maestro.cedula}</p>
                    <p>Teléfono: ${maestro.telefono || 'N/A'}</p>
                    <p>Email: ${maestro.email}</p>
                    <p>Especialidad: ${maestro.especialidad}</p>
                </div>
            `;
                });
            });
        }

        // Show courses list
        function mostrarCursos() {
            fetchData('./app/controllers/curso-control/GetCursos.php', data => {
                const lista = document.getElementById('lista-cursos');
                lista.innerHTML = '';
                if (data.length === 0) {
                    lista.innerHTML = '<div class="message error">No hay cursos registrados.</div>';
                    return;
                }
                data.forEach(curso => {
                    lista.innerHTML += `
                <div class="card">
                    <h3>${curso.nombre}</h3>
                    <p>Descripción: ${curso.descripcion || 'N/A'}</p>
                    <p>Maestro: ${curso.maestro_nombres}</p>
                </div>
            `;
                });
            });
        }

        // Show enrollments list
        function mostrarInscripciones() {
            fetchData('./app/controllers/inscripcion-control/GetInscripciones.php', data => {
                const lista = document.getElementById('lista-inscripciones');
                lista.innerHTML = '';
                if (data.length === 0) {
                    lista.innerHTML = '<div class="message error">No hay inscripciones registradas.</div>';
                    return;
                }
                data.forEach(inscripcion => {
                    lista.innerHTML += `
                <div class="card">
                    <h3>${inscripcion.estudiante_nombres}</h3>
                    <p>Curso: ${inscripcion.curso_nombre}</p>
                    <p>Fecha Inscripción: ${inscripcion.fecha_inscripcion}</p>
                </div>
            `;
                });
            });
        }

        // Show reports (students enrolled in courses with teachers)
        function mostrarReportes() {
            fetchData('./app/controllers/reporte-control/GetReportes.php', data => {
                const contenido = document.getElementById('reportes-contenido');
                contenido.innerHTML = '';
                if (data.length === 0) {
                    contenido.innerHTML = '<div class="message error">No hay inscripciones para reportar.</div>';
                    return;
                }
                contenido.innerHTML = '<h3>Listado de Estudiantes Matriculados</h3>';
                data.forEach(reporte => {
                    contenido.innerHTML += `
                <div class="card">
                    <h3>Estudiante: ${reporte.estudiante_nombres}</h3>
                    <p>Curso: ${reporte.curso_nombre}</p>
                    <p>Maestro: ${reporte.maestro_nombres}</p>
                    <p>Fecha Inscripción: ${reporte.fecha_inscripcion}</p>
                </div>
            `;
                });
            });
        }

        // Load dashboard on page load
        document.addEventListener('DOMContentLoaded', actualizarDashboard);
    </script>
</body>

</html>