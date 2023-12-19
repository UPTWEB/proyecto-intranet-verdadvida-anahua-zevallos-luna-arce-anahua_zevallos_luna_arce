<div class="modal fade" id="editar<?php echo $fila['IdProfesor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Profesor</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm<?php echo $fila['IdProfesor']; ?>" method="post" action="../includes/functions.php">
                    <!-- Nombres -->
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" id="nombres" name="Nombres" class="form-control" value="<?php echo $fila['Nombres']; ?>" required>
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="apellido_paterno" name="ApellidoPaterno" class="form-control" value="<?php echo $fila['ApellidoPaterno']; ?>" required>
                    </div>

                    <!-- Apellido Materno -->
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="ApellidoMaterno" class="form-control" value="<?php echo $fila['ApellidoMaterno']; ?>" required>
                    </div>

                    <!-- Correo -->
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo" name="Correo" class="form-control" value="<?php echo $fila['Correo']; ?>" required>
                    </div>

                    <!-- Especialidad -->
                    <div class="form-group">
                        <label for="especialidad">Especialidad</label>
                        <input type="text" id="especialidad" name="Especialidad" class="form-control" value="<?php echo $fila['Especialidad']; ?>" required>
                    </div>

                    <!-- ID del profesor oculto -->
                    <input type="hidden" name="IdProfesor" value="<?php echo $fila['IdProfesor']; ?>">
                    <input type="hidden" name="accion" value="editar_profe">

                    <!-- Botones del formulario -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Escuchar el evento submit de todos los formularios que comienzan con 'editForm'
    $('form[id^="editForm"]').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío por defecto del formulario

        // Serializar los datos del formulario para el envío
        var formData = $(this).serialize();
        var actionUrl = "../includes/functions.php"; // Definir la URL del script PHP de destino

        $.ajax({
            url: actionUrl, // Usar la URL definida para el script PHP de destino
            type: 'POST', // Método HTTP de envío
            data: formData, // Datos serializados del formulario
            dataType: 'json', // Tipo de datos esperado en la respuesta
            success: function(response) {
                if (response.status === 'success') {
                    // Mensaje de éxito y recarga de la página
                    alert(response.message);
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    // Mensaje de error
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Manejo genérico de errores de AJAX
                alert('Error: ' + error);
            }
        });
    });
});
</script>
