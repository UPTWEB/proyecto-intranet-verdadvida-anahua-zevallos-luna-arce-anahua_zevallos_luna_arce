<div class="modal fade" id="editar<?php echo $matricula['IdMatricula'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Matricula</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="editForm<?php echo $matricula['IdMatricula'] ?>" method="POST">

                    <!-- Campos del formulario -->
                    <div class="form-group">
                        <label for="TipoMatricula">Tipo de Matrícula:</label>
                        <select name="TipoMatricula" id="TipoMatricula" class="form-control" required>
                            <?php
                            if ($matricula['TipoMatricula'] == "Nueva Inscripcion") {
                                echo '<option value="Nueva Inscripcion" selected>Nueva Inscripcion</option>';
                                echo '<option value="Renovacion">Renovacion</option>';
                            } elseif ($matricula['TipoMatricula'] == "Renovacion") {
                                echo '<option value="Nueva Inscripcion">Nueva Inscripcion</option>';
                                echo '<option value="Renovacion" selected>Renovacion</option>';
                            }
                            ?>


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
                                echo '<option value="' . $consulta['IdEstudiante'] . '" ' . ($matricula['FKIdEstudiante'] == $consulta['IdEstudiante'] ? 'selected' : '') . '>' . $consulta['NombresApellidos'] . '</option>';
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
                                echo '<option value="' . $consulta['IdGrado'] . '" ' . ($matricula['FKIdGrado'] == $consulta['IdGrado'] ? 'selected' : '') . '>' . $consulta['NombreGrado'] . '</option>';
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
                                echo '<option value="' . $consulta['IdSeccion'] . '" ' . ($matricula['FKIdSeccion'] == $consulta['IdSeccion'] ? 'selected' : '') . '>' . $consulta['NombreSeccion'] . '</option>';
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
                                echo '<option value="' . $consulta['IdAnioEscolar'] . '" ' . ($matricula['FKIdAnioEscolar'] == $consulta['IdAnioEscolar'] ? 'selected' : '') . '>' . $consulta['AnioEscolar'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="EstadoDocumentos">Estado de Documentos:</label>
                        <select name="EstadoDocumentos" id="EstadoDocumentos" class="form-control" required>
                            <?php
                            if ($matricula['EstadoDocumentos'] == "Pendientes") {
                                echo '<option value="Pendientes" selected>Pendientes</option>';
                                echo '<option value="Completos">Completos</option>';
                            } elseif ($matricula['EstadoDocumentos'] == "Completos") {
                                echo '<option value="Pendientes">Pendientes</option>';
                                echo '<option value="Completos" selected>Completos</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Estado">Estado:</label>
                        <select name="Estado" id="Estado" class="form-control" required>

                            <?php
                            if ($matricula['Estado'] == "Activa") {
                                echo '<option value="Activa" selected>Activa</option>';
                                echo '<option value="Inactiva">Inactiva</option>';
                            } elseif ($matricula['Estado'] == "Inactiva") {
                                echo '<option value="Activa">Activa</option>';
                                echo '<option value="Inactiva" selected>Inactiva</option>';
                            }
                            ?>

                        </select>
                    </div>



            </div>



            <br>

            <input type="hidden" name="accion" value="editar_matricula">
            <input type="hidden" name="IdMatricula" value="<?php echo $matricula['IdMatricula']; ?>">

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="editForm(<?php echo $matricula['IdMatricula']; ?>)">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>

        </div>

        </form>
    </div>
</div>
</div>
<script>
    function editForm(IdMatricula) {
        var datosFormulario = $("#editForm" + IdMatricula).serialize();

        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "success") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.assign('matricula.php');
                    }, 2000);
                } else {
                    alert("Ha ocurrido un error al actualizar el registro");
                }
            },
            error: function() {
                alert("Error de comunicacion con el servidor");
            }
        });
    }
</script>