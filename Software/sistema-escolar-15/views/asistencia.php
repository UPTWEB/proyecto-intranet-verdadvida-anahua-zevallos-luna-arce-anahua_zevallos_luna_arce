<?php include "../includes/header.php"; ?>

<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registro de Asistencias</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre del Estudiante</th>
                                <th>Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT * FROM estudiantes");
                            while ($fila = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$fila['Nombres']." ".$fila['Apellidos']."</td>";
                                echo "<td>";
                                echo "<button class='btn btn-success btn-sm'>Puntual</button> ";
                                echo "<button class='btn btn-warning btn-sm'>Tarde</button> ";
                                echo "<button class='btn btn-danger btn-sm'>Falta</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include "../includes/footer.php"; ?>
</html>
