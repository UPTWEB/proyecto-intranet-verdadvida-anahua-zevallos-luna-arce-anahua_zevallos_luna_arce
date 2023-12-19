<?php include "../includes/header.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body id="page-top">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Conceptos de pago</h6>
                <br>

                <?php if ($_SESSION["type"] == 1) { ?>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#conceptoPension">
                    <span class="glyphicon glyphicon-plus"></span> Agregar <i class="fa fa-plus"></i> </a></button>

                <?php } ?>
            </div>

            <?php include "form_conceptopensiones.php"; ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombres Apellidos</th>
                                <th>Mes</th>
                                <th>Monto</th>
                                <th>Fecha Vencimiento</th>
                                <th>Estado Pago</th>
                                <?php if ($_SESSION["type"] == 1) { ?>
                                    <th>Acciones</th>
                                <?php } ?>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $sql = "SELECT 
                                        e.DNI,
                                        CONCAT(e.Nombres, ' ', e.Apellidos) AS 'NombreCompleto',
                                        p.Mes,
                                        p.Monto,
                                        p.FechaVencimiento,
                                        p.EstadoPago
                                    FROM 
                                        estudiantes e
                                    JOIN 
                                        pensiones p ON e.IdEstudiante = p.FKIdEstudiante
                                    ORDER BY 
                                        p.FechaVencimiento;";
                            
                            $result = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($fila = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $fila['DNI'] . "</td>";
                                    echo "<td>" . $fila['NombreCompleto'] . "</td>";
                                    echo "<td>" . $fila['Mes'] . "</td>";
                                    echo "<td>" . $fila['Monto'] . "</td>";
                                    echo "<td>" . $fila['FechaVencimiento'] . "</td>";
                                    echo "<td>" . $fila['EstadoPago'] . "</td>";
                                    echo "<td><a href='generar_boleta.php?idPension=" . $fila['IdPension'] . "' class='btn btn-info'>Boleta</a></td>";
                                    echo "<td><button class='btn btn-primary'>Pago</button></td>"; // Botón Pago
                                    echo "</tr>";
                                    
                                }
                            } else {
                                echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
                            }
                            
                            ?>
                            <td>
    
</td>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include "../includes/footer.php"; ?>

</html>
