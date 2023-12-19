<?php include "../includes/header.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Profesores</h6>
                <br>


                <?php if ($_SESSION["type"] == 1) { ?>

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#prof">
                        <span class="glyphicon glyphicon-plus"></span> Agregar <i class="fa fa-plus"></i> </a></button>

                <?php }
                ?>


            </div>
            <?php include "form_prof.php"; ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Correo</th>
                                <th>Especialidad</th>


                                <?php if ($_SESSION["type"] == 1) { ?>
                                    <th>Acciones.</th>
                                <?php }
                                ?>


                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT * FROM profesores ");
                            while ($fila = mysqli_fetch_assoc($result)) :

                            ?>
                                <tr>
                                <td><?php echo $fila['Nombres']; ?></td>
                                    <td><?php echo $fila['ApellidoPaterno']; ?></td>
                                    <td><?php echo $fila['ApellidoMaterno']; ?></td>
                                    <td><?php echo $fila['Correo']; ?></td>
                                    <td><?php echo $fila['Especialidad']; ?></td>


                                    <?php if ($_SESSION["type"] == 1) { ?>

                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['IdProfesor']; ?>">
                                                <i class="fa fa-edit "></i>
                                            </button>
                                            <a href="../includes/eliminar_prof.php?id=<?php echo $fila['id'] ?>" class="btn btn-danger btn-del">
                                                <i class="fa fa-trash "></i></a>
                                        </td>


                                    <?php }
                                    ?>


                                </tr>
                                <?php include "editar_prof.php"; ?>


                            <?php endwhile; ?>
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