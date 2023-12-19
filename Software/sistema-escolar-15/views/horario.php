<?php include "../includes/header.php"; ?>


<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Horario Seccion: A</h6>
                <br>


                <?php if ($_SESSION["type"] == 1) { ?>

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#alumno">
                        <span class="glyphicon glyphicon-plus"></span> Agregar <i class="fa fa-plus"></i> </a></button>

                <?php }
                ?>


            </div>
            <?php include "form_alumno.php"; ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miercoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>

                                <?php //if ($_SESSION["type"] == 1) { 
                                ?>
                                <!--<th>Acciones.</th>-->
                                <?php //}
                                ?>


                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            /*
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT * FROM alumnos ");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            */
                            ?>

                            <tr>
                                <td>Matemáticas<br>Prof. García<br>08:00 - 09:00</td>
                                <td>Historia<br>Prof. Sánchez<br>08:00 - 09:00</td>
                                <td>Inglés<br>Prof. Smith<br>08:00 - 09:00</td>
                                <td>Arte<br>Prof. López<br>08:00 - 09:00</td>
                                <td>Biología<br>Prof. Ruiz<br>08:00 - 09:00</td>
                            </tr>
                            <tr>
                                <td>Física<br>Prof. Alonso<br>09:10 - 10:10</td>
                                <td>Química<br>Prof. Molina<br>09:10 - 10:10</td>
                                <td>Educación Física<br>Prof. Torres<br>09:10 - 10:10</td>
                                <td>Geografía<br>Prof. Romero<br>09:10 - 10:10</td>
                                <td>Informática<br>Prof. Gómez<br>09:10 - 10:10</td>
                            </tr>
                            <tr>
                                <td colspan="7" align="center">Recreo - 9:30</td>
                            </tr>
                            <tr>
                                <td>Física<br>Prof. Alonso<br>09:15 - 10:15</td>
                                <td>Química<br>Prof. Molina<br>09:15 - 10:15</td>
                                <td>Educación Física<br>Prof. Torres<br>09:15 - 10:15</td>
                                <td>Geografía<br>Prof. Romero<br>09:15 - 10:15</td>
                                <td>Informática<br>Prof. Gómez<br>09:15 - 10:15</td>
                            </tr>
                            <tr>
                                <td>Literatura<br>Prof. Vázquez<br>10:30 - 11:30</td>
                                <td>Música<br>Prof. Fernández<br>10:30 - 11:30</td>
                                <td>Matemáticas Avanzadas<br>Prof. García<br>10:30 - 11:30</td>
                                <td>Historia del Arte<br>Prof. López<br>10:30 - 11:30</td>
                                <td>Filosofía<br>Prof. Sánchez<br>10:30 - 11:30</td>
                            </tr>
                            <tr>
                                <td colspan="7" align="center">Salida - 11:30</td>
                            </tr>

                            <?php //include "editar_alumno.php"; 
                            ?>


                            <?php //endwhile;
                            ?>
                        </tbody>
                    </table>

                    </script>


                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->






    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->




</body>


<?php include "../includes/footer.php"; ?>

</html>