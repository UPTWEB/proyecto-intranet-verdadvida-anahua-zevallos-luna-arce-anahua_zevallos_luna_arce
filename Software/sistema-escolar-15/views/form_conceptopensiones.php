<div class="modal fade" id="conceptoPension" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar Concepto de Pensión</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="pensionForm">
                    <div class="mb-3">
                        <label for="dniEstudiante" class="form-label">DNI del Estudiante</label>
                        <input type="text" name="dniEstudiante" id="dniEstudiante" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombreEstudiante" class="form-label">Nombre del Estudiante</label>
                        <input type="text" name="nombreEstudiante" id="nombreEstudiante" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="apellidoEstudiante" class="form-label">Apellido del Estudiante</label>
                        <input type="text" name="apellidoEstudiante" id="apellidoEstudiante" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="mes" class="form-label">Mes</label>
                        <input type="text" name="mes" id="mes" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="number" name="monto" id="monto" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fechaVencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fechaVencimiento" id="fechaVencimiento" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="estadoPago" class="form-label">Estado de Pago</label>
                        <input type="text" name="estadoPago" id="estadoPago" class="form-control" required>
                    </div>

                    <br>
                    <input type="hidden" name="accion" value="insert_conceptopensiones">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dniEstudiante').on('blur', function() {
            var dni = $(this).val();

            if (dni !== '') {
                $.ajax({
                    url: '../includes/buscardatos.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {dni: dni},
                    success: function(response) {
                        if (response.status === 'found') {
                            $('#nombreEstudiante').val(response.nombre);
                            $('#apellidoEstudiante').val(response.apellido);
                        } else {
                            alert('Estudiante no encontrado');
                            $('#nombreEstudiante').val('');
                            $('#apellidoEstudiante').val('');
                        }
                    },
                    error: function() {
                        alert('Error al buscar los datos del estudiante');
                    }
                });
            }
        });

        $('#pensionForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '../includes/functions.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Éxito: Los datos de la pensión se guardaron correctamente');
                        window.location.reload();
                    } else {
                        alert('Error: Ocurrió un error inesperado');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: Ocurrió un error inesperado');
                }
            });
        });
    });
</script>
