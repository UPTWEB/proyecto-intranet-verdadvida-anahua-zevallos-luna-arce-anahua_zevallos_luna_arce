<?php include "../includes/header.php"; ?>

<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte de Asistencias</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Puntuales</th>
                                <th>Tardes</th>
                                <th>Faltas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT Fecha, 
                                      COUNT(CASE WHEN EstadoAsistencia = 'Asistio' THEN 1 END) as Puntuales, 
                                      COUNT(CASE WHEN EstadoAsistencia = 'Tardanza' THEN 1 END) as Tardes, 
                                      COUNT(CASE WHEN EstadoAsistencia IN ('Falta', 'Falta_Justificada') THEN 1 END) as Faltas 
                                   FROM asistencias 
                                   GROUP BY Fecha");

                            while ($fila = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$fila['Fecha']."</td>";
                                echo "<td>".$fila['Puntuales']."</td>";
                                echo "<td>".$fila['Tardes']."</td>";
                                echo "<td>".$fila['Faltas']."</td>";
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
