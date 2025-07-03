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
            
            <form id="form-curso" onsubmit="return registrarCurso(event)">
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
            
            <form id="form-inscripcion" onsubmit="return inscribirEstudiante(event)">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="estudiante-inscripcion">Estudiante</label>
                        <select id="estudiante-inscripcion" name="estudiante-inscripcion" required>
                            <option value="">Seleccionar Estudiante</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="curso-inscripcion">Curso</label>
                        <select id="curso-inscripcion" name="curso-inscripcion" required>
                            <option value="">Seleccionar Curso</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn">Inscribir Estudiante</button>
            </form>
        </div>

        <!-- Reportes -->
        <div id="reportes" class="tab-content">
            <h2>Reportes Detallados</h2>
            <div id="reportes-contenido"></div>
        </div>
    </div>

    <script>
        // Datos simulados (en producción vendrían de MySQL)
        let estudiantes = JSON.parse(localStorage.getItem('estudiantes') || '[]');
        let maestros = JSON.parse(localStorage.getItem('maestros') || '[]');
        let cursos = JSON.parse(localStorage.getItem('cursos') || '[]');
        let inscripciones = JSON.parse(localStorage.getItem('inscripciones') || '[]');

        function showTab(tabName) {
            // Ocultar todas las pestañas
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Mostrar la pestaña seleccionada
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');

            // Cargar datos específicos según la pestaña
            switch(tabName) {
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
                    cargarMaestrosSelect();
                    break;
                case 'inscripciones':
                    cargarEstudiantesSelect();
                    cargarCursosSelect();
                    break;
                case 'reportes':
                    mostrarReportes();
                    break;
            }
        }

        function mostrarMensaje(elementId, mensaje, tipo = 'success') {
            const elemento = document.getElementById(elementId);
            elemento.innerHTML = `<div class="message ${tipo}">${mensaje}</div>`;
            setTimeout(() => {
                elemento.innerHTML = '';
            }, 3000);
        }

        function registrarEstudiante(event) {
            event.preventDefault();
            
            const estudiante = {
                id: Date.now(),
                nombre: document.getElementById('nombre-estudiante').value,
                email: document.getElementById('email-estudiante').value,
                telefono: document.getElementById('telefono-estudiante').value,
                fechaNacimiento: document.getElementById('fecha-nacimiento').value
            };

            // Verificar email único
            if (estudiantes.some(e => e.email === estudiante.email)) {
                mostrarMensaje('mensaje-estudiante', 'El email ya está registrado', 'error');
                return false;
            }

            estudiantes.push(estudiante);
            localStorage.setItem('estudiantes', JSON.stringify(estudiantes));
            
            mostrarMensaje('mensaje-estudiante', 'Estudiante registrado exitosamente');
            document.getElementById('form-estudiante').reset();
            mostrarEstudiantes();
            return false;
        }

        function registrarMaestro(event) {
            event.preventDefault();
            
            const maestro = {
                id: Date.now(),
                nombre: document.getElementById('nombre-maestro').value,
                email: document.getElementById('email-maestro').value,
                telefono: document.getElementById('telefono-maestro').value,
                especialidad: document.getElementById('especialidad').value
            };

            // Verificar email único
            if (maestros.some(m => m.email === maestro.email)) {
                mostrarMensaje('mensaje-maestro', 'El email ya está registrado', 'error');
                return false;
            }

            maestros.push(maestro);
            localStorage.setItem('maestros', JSON.stringify(maestros));
            
            mostrarMensaje('mensaje-maestro', 'Maestro registrado exitosamente');
            document.getElementById('form-maestro').reset();
            mostrarMaestros();
            return false;
        }

        function registrarCurso(event) {
            event.preventDefault();
            
            const maestroId = parseInt(document.getElementById('maestro-curso').value);
            
            // Verificar que el maestro no tenga ya un curso asignado
            if (cursos.some(c => c.maestroId === maestroId)) {
                mostrarMensaje('mensaje-curso', 'Este maestro ya tiene un curso asignado', 'error');
                return false;
            }

            const curso = {
                id: Date.now(),
                nombre: document.getElementById('nombre-curso').value,
                descripcion: document.getElementById('descripcion-curso').value,
                maestroId: maestroId,
                creditos: parseInt(document.getElementById('creditos').value),
                estudiantesInscritos: 0
            };

            cursos.push(curso);
            localStorage.setItem('cursos', JSON.stringify(cursos));
            
            mostrarMensaje('mensaje-curso', 'Curso registrado exitosamente');
            document.getElementById('form-curso').reset();
            mostrarCursos();
            return false;
        }

        function inscribirEstudiante(event) {
            event.preventDefault();
            
            const estudianteId = parseInt(document.getElementById('estudiante-inscripcion').value);
            const cursoId = parseInt(document.getElementById('curso-inscripcion').value);

            // Verificar que el estudiante no esté ya inscrito en el curso
            if (inscripciones.some(i => i.estudianteId === estudianteId && i.cursoId === cursoId)) {
                mostrarMensaje('mensaje-inscripcion', 'El estudiante ya está inscrito en este curso', 'error');
                return false;
            }

            // Verificar límite de 30 estudiantes por curso
            const inscritosEnCurso = inscripciones.filter(i => i.cursoId === cursoId).length;
            if (inscritosEnCurso >= 30) {
                mostrarMensaje('mensaje-inscripcion', 'El curso ha alcanzado el límite máximo de 30 estudiantes', 'error');
                return false;
            }

            const inscripcion = {
                id: Date.now(),
                estudianteId: estudianteId,
                cursoId: cursoId,
                fechaInscripcion: new Date().toISOString().split('T')[0]
            };

            inscripciones.push(inscripcion);
            localStorage.setItem('inscripciones', JSON.stringify(inscripciones));
            
            // Actualizar contador de estudiantes en el curso
            const curso = cursos.find(c => c.id === cursoId);
            if (curso) {
                curso.estudiantesInscritos = inscritosEnCurso + 1;
                localStorage.setItem('cursos', JSON.stringify(cursos));
            }

            mostrarMensaje('mensaje-inscripcion', 'Estudiante inscrito exitosamente');
            document.getElementById('form-inscripcion').reset();
            return false;
        }

        function mostrarEstudiantes() {
            const lista = document.getElementById('lista-estudiantes');
            lista.innerHTML = '<h3>Estudiantes Registrados</h3>';
            
            estudiantes.forEach(estudiante => {
                lista.innerHTML += `
                    <div class="card">
                        <h4>${estudiante.nombre}</h4>
                        <p><strong>Email:</strong> ${estudiante.email}</p>
                        <p><strong>Teléfono:</strong> ${estudiante.telefono}</p>
                        <p><strong>Fecha de Nacimiento:</strong> ${estudiante.fechaNacimiento}</p>
                        <button class="btn btn-danger" onclick="eliminarEstudiante(${estudiante.id})">Eliminar</button>
                    </div>
                `;
            });
        }

        function mostrarMaestros() {
            const lista = document.getElementById('lista-maestros');
            lista.innerHTML = '<h3>Maestros Registrados</h3>';
            
            maestros.forEach(maestro => {
                lista.innerHTML += `
                    <div class="card">
                        <h4>${maestro.nombre}</h4>
                        <p><strong>Email:</strong> ${maestro.email}</p>
                        <p><strong>Teléfono:</strong> ${maestro.telefono}</p>
                        <p><strong>Especialidad:</strong> ${maestro.especialidad}</p>
                        <button class="btn btn-danger" onclick="eliminarMaestro(${maestro.id})">Eliminar</button>
                    </div>
                `;
            });
        }

        function mostrarCursos() {
            const lista = document.getElementById('lista-cursos');
            lista.innerHTML = '<h3>Cursos Registrados</h3>';
            
            cursos.forEach(curso => {
                const maestro = maestros.find(m => m.id === curso.maestroId);
                const inscritosEnCurso = inscripciones.filter(i => i.cursoId === curso.id).length;
                
                lista.innerHTML += `
                    <div class="card">
                        <h4>${curso.nombre}</h4>
                        <p><strong>Descripción:</strong> ${curso.descripcion}</p>
                        <p><strong>Maestro:</strong> ${maestro ? maestro.nombre : 'No asignado'}</p>
                        <p><strong>Créditos:</strong> ${curso.creditos}</p>
                        <p><strong>Estudiantes Inscritos:</strong> ${inscritosEnCurso}/30</p>
                        <button class="btn btn-danger" onclick="eliminarCurso(${curso.id})">Eliminar</button>
                    </div>
                `;
            });
        }

        function cargarMaestrosSelect() {
            const select = document.getElementById('maestro-curso');
            select.innerHTML = '<option value="">Seleccionar Maestro</option>';
            
            // Solo mostrar maestros que no tengan curso asignado
            const maestrosSinCurso = maestros.filter(maestro => 
                !cursos.some(curso => curso.maestroId === maestro.id)
            );
            
            maestrosSinCurso.forEach(maestro => {
                select.innerHTML += `<option value="${maestro.id}">${maestro.nombre}</option>`;
            });
        }

        function cargarEstudiantesSelect() {
            const select = document.getElementById('estudiante-inscripcion');
            select.innerHTML = '<option value="">Seleccionar Estudiante</option>';
            
            estudiantes.forEach(estudiante => {
                select.innerHTML += `<option value="${estudiante.id}">${estudiante.nombre}</option>`;
            });
        }

        function cargarCursosSelect() {
            const select = document.getElementById('curso-inscripcion');
            select.innerHTML = '<option value="">Seleccionar Curso</option>';
            
            cursos.forEach(curso => {
                const inscritosEnCurso = inscripciones.filter(i => i.cursoId === curso.id).length;
                const disponible = inscritosEnCurso < 30 ? '' : ' (LLENO)';
                select.innerHTML += `<option value="${curso.id}" ${inscritosEnCurso >= 30 ? 'disabled' : ''}>${curso.nombre}${disponible}</option>`;
            });
        }

        function actualizarDashboard() {
            document.getElementById('total-estudiantes').textContent = estudiantes.length;
            document.getElementById('total-maestros').textContent = maestros.length;
            document.getElementById('total-cursos').textContent = cursos.length;
            document.getElementById('total-inscripciones').textContent = inscripciones.length;
        }

        function mostrarReportes() {
            const contenido = document.getElementById('reportes-contenido');
            contenido.innerHTML = '';

            cursos.forEach(curso => {
                const maestro = maestros.find(m => m.id === curso.maestroId);
                const estudiantesEnCurso = inscripciones
                    .filter(i => i.cursoId === curso.id)
                    .map(i => estudiantes.find(e => e.id === i.estudianteId))
                    .filter(e => e); // Filtrar valores undefined

                contenido.innerHTML += `
                    <div class="course-details">
                        <h3>📚 ${curso.nombre}</h3>
                        <p><strong>👨‍🏫 Maestro:</strong> ${maestro ? maestro.nombre : 'No asignado'}</p>
                        <p><strong>📖 Descripción:</strong> ${curso.descripcion}</p>
                        <p><strong>🎯 Créditos:</strong> ${curso.creditos}</p>
                        <p><strong>👥 Estudiantes Inscritos:</strong> ${estudiantesEnCurso.length}/30</p>
                        
                        <div class="student-list">
                            ${estudiantesEnCurso.map(estudiante => 
                                `<div class="student-item">
                                    <strong>${estudiante.nombre}</strong><br>
                                    📧 ${estudiante.email}
                                </div>`
                            ).join('')}
                        </div>
                    </div>
                `;
            });

            if (cursos.length === 0) {
                contenido.innerHTML = '<div class="card"><p>No hay cursos registrados para mostrar reportes.</p></div>';
            }
        }

        function eliminarEstudiante(id) {
            if (confirm('¿Estás seguro de eliminar este estudiante?')) {
                estudiantes = estudiantes.filter(e => e.id !== id);
                inscripciones = inscripciones.filter(i => i.estudianteId !== id);
                localStorage.setItem('estudiantes', JSON.stringify(estudiantes));
                localStorage.setItem('inscripciones', JSON.stringify(inscripciones));
                mostrarEstudiantes();
                actualizarDashboard();
            }
        }

        function eliminarMaestro(id) {
            if (confirm('¿Estás seguro de eliminar este maestro?')) {
                maestros = maestros.filter(m => m.id !== id);
                // También eliminar cursos del maestro
                cursos = cursos.filter(c => c.maestroId !== id);
                localStorage.setItem('maestros', JSON.stringify(maestros));
                localStorage.setItem('cursos', JSON.stringify(cursos));
                mostrarMaestros();
                actualizarDashboard();
            }
        }

        function eliminarCurso(id) {
            if (confirm('¿Estás seguro de eliminar este curso?')) {
                cursos = cursos.filter(c => c.id !== id);
                inscripciones = inscripciones.filter(i => i.cursoId !== id);
                localStorage.setItem('cursos', JSON.stringify(cursos));
                localStorage.setItem('inscripciones', JSON.stringify(inscripciones));
                mostrarCursos();
                actualizarDashboard();
            }
        }

        // Inicializar la aplicación
        document.addEventListener('DOMContentLoaded', function() {
            actualizarDashboard();
        });
    </script>
</body>
</html>