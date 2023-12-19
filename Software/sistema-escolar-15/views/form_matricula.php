<!-- Modal para Agregar Matrícula -->
<div class="modal fade" id="matricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="matriculaModalLabel">Agregar Nueva Matrícula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="matriculaForm">
                    <!-- Campos del formulario -->
                    <div class="form-group">
                        <label for="TipoMatricula">Tipo de Matrícula:</label>
                        <select name="TipoMatricula" id="TipoMatricula" class="form-control" required>

                            <option value="Nueva Inscripcion">Nueva Inscripcion</option>';
                            <option value="Renovacion">Renovacion</option>';

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="FechaMatricula">Fecha de Matrícula:</label>
                        <input type="date" class="form-control" id="FechaMatricula" name="FechaMatricula" required>
                    </div>
                    <div class="form-group">
                        <label for="FKIdEstudiante">Estudiante:</label>
                        <select name="FKIdEstudiante" id="FKIdEstudiante" class="form-control" required>
                            <?php
                            include("db.php");
                            $sql = "SELECT IdEstudiante, CONCAT_WS(' ',Nombres, Apellidos) AS 'NombresApellidos' FROM estudiantes";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['IdEstudiante'] . '">' . $consulta['NombresApellidos'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">

                        <label for="FKIdGrado">Grado:</label>
                        <select name="FKIdGrado" id="FKIdGrado" class="form-control" required>
                            <?php
                            include("db.php");
                            $sql = "SELECT IdGrado, NombreGrado FROM  grados";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['IdGrado'] . '">' . $consulta['NombreGrado'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="FKIdSeccion">Sección:</label>
                        <select name="FKIdSeccion" id="FKIdSeccion" class="form-control" required>
                            <?php
                            include("db.php");
                            $sql = "SELECT IdSeccion, NombreSeccion FROM  secciones";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['IdSeccion'] . '">' . $consulta['NombreSeccion'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="FKIdAnioEscolar">Año Escolar:</label>
                        <select name="FKIdAnioEscolar" id="FKIdAnioEscolar" class="form-control" required>
                            <?php
                            include("db.php");
                            $sql = "SELECT IdAnioEscolar, AnioEscolar FROM  anios_escolares";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['IdAnioEscolar'] . '">' . $consulta['AnioEscolar'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="EstadoDocumentos">Estado de Documentos:</label>
                        <select name="EstadoDocumentos" id="EstadoDocumentos" class="form-control" required>

                            <option value="Pendientes">Pendientes</option>';
                            <option value="Completos">Completos</option>';

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Estado">Estado:</label>
                        <select name="Estado" id="Estado" class="form-control" required>

                            <option value="Activa">Activa</option>';
                            <option value="Inactiva">Inactiva</option>';

                        </select>
                    </div>
                    <input type="hidden" name="accion" value="insert_matricula">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#matriculaForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '../includes/functions.php', // Asegúrate de que esta sea la ruta correcta
                type: 'POST',
                data: formData,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert(data.message);
                        window.location.reload(); // o redirige a donde consideres necesario
                    } else {
                        alert(data.message);
                    }
                },
                error: function() {
                    alert('Error en la solicitud.');
                }
            });
        });
    });
</script>