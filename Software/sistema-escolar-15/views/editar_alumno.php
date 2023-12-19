<div class="modal fade" id="editar<?php echo $estudiante['IdEstudiante'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Alumno</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
            <form id="editForm<?php echo $fila['IdEstudiante']; ?>" method="post" action="../includes/functions.php">
                    <div class="form-group">
                        <label for="Nombres">Nombre:</label>
                        <input type="text" class="form-control" id="Nombres" name="Nombres" value="<?php echo $fila['Nombres']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="Apellidos" name="Apellidos" value="<?php echo $fila['Apellidos']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="DNI">DNI:</label>
                        <input type="text" class="form-control" id="DNI" name="DNI" value="<?php echo $fila['DNI']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="FechaNacimiento">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento" value="<?php echo $fila['FechaNacimiento']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Estado">Estado:</label>
                        <select name="Estado" id="Estado" class="form-control" required>
                            <option value="activo" <?php echo ($estudiante['Estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                            <option value="inactivo" <?php echo ($estudiante['Estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                        </select>
                    </div>
                    <!-- Asumiendo que tienes un campo Estado en tu tabla estudiantes -->
                    <input type="hidden" name="accion" value="editar_alum">
                    <input type="hidden" name="IdEstudiante" value="<?php echo $estudiante['IdEstudiante']; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editAlumno(<?php echo $estudiante['IdEstudiante']; ?>)">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function editAlumno(IdEstudiante) {
    event.preventDefault();  // Detiene el envío del formulario.

    var datosFormulario = $("#editForm" + IdEstudiante).serialize();
    $.ajax({
        url: "../includes/functions.php",
        type: "POST",
        data: datosFormulario,
        dataType: "json",
        success: function(response) {
            if (response && response.status === "success") {
                alert("El registro se ha actualizado correctamente");
                location.reload();
            } else {
                // Asegúrate de que siempre hay una propiedad 'message' en tu respuesta JSON
                alert("Ha ocurrido un error al actualizar el registro: " + (response.message || 'No se proporcionó mensaje de error.'));
            }
        },
        error: function(xhr, status, error) {
            // Aquí puedes ver el cuerpo de la respuesta para depurar
            console.error("Respuesta recibida: ", xhr.responseText);
            alert("Error de comunicación con el servidor: " + error);
        }
    });
}

</script>

