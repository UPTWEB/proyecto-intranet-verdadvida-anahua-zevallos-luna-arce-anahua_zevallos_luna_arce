<div class="modal fade" id="apoderadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar nuevo apoderado</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="apoderadoForm" method="POST">
                    <!-- Nombres -->
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" required>
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="mb-3">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required>
                    </div>

                    <!-- Apellido Materno -->
                    <div class="mb-3">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" required>
                    </div>

                    <!-- DNI -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" required>
                    </div>

                    <!-- Correo Personal -->
                    <div class="mb-3">
                        <label for="correo_personal" class="form-label">Correo Personal</label>
                        <input type="email" name="correo_personal" id="correo_personal" class="form-control" required>
                    </div>

                    <!-- Celular -->
                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" name="celular" id="celular" class="form-control" required>
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>

                    <!-- Relación con el Estudiante -->
                    <div class="mb-3">
                        <label for="relacion_estudiante" class="form-label">Relación Estudiante</label>
                        <input type="text" name="relacion_estudiante" id="relacion_estudiante" class="form-control" required>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                    </div>


                    
                    <!-- Botones del Formulario -->
                    <input type="hidden" name="accion" value="insert_apoderado">

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
        $('#apoderadoForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '../includes/functions.php', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Éxito: ' + response.message);
                        $('#apoderadoModal').modal('hide'); // Ocultar el modal
                        location.reload(); // Recargar la página o redirigir según sea necesario
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error de comunicación con el servidor: ' + error);
                }
            });
        });
    });
</script>
