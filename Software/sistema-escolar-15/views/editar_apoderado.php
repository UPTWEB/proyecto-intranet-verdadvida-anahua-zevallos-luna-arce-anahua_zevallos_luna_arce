<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Apoderado</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm<?php echo $fila['id']; ?>" method="POST">
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" value="<?php echo $fila['Nombres']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="<?php echo $fila['ApellidoPaterno']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="<?php echo $fila['ApellidoMaterno']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $fila['DNI']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo_personal" class="form-label">Correo Personal</label>
                        <input type="email" name="correo_personal" id="correo_personal" class="form-control" value="<?php echo $fila['CorreoPersonal']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $fila['Celular']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $fila['Direccion']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="relacion_estudiante" class="form-label">Relación Estudiante</label>
                        <input type="text" name="relacion_estudiante" id="relacion_estudiante" class="form-control" value="<?php echo $fila['RelacionEstudiante']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo $fila['FechaNacimiento']; ?>" required>
                    </div>
                  
                    <!-- Agrega más campos aquí según tu estructura de datos -->
                    <input type="hidden" name="accion" value="editar_apoderado">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('form[id^="editForm"]').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío normal del formulario

        var datosFormulario = $(this).serialize(); // Serializar los datos del formulario

        $.ajax({
            url: "../includes/functions.php", // URL del script PHP de destino
            type: "POST", // Método de envío
            data: datosFormulario, // Datos serializados del formulario
            dataType: "json", // Tipo de datos esperados en la respuesta
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message); // Alerta con el mensaje de éxito
                    location.reload(); // Recargar la página para actualizar la lista
                } else {
                    alert(response.message); // Alerta con el mensaje de error
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error); // Alerta con el mensaje de error
            }
        });
    });
});
</script>
