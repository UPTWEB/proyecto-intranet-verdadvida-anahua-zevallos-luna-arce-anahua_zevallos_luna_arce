<?php include "../includes/header.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registro de Matrículas</h6>
                <br>

                <?php if ($_SESSION["type"] == 1) { ?>

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#matricula">
                        <span class="glyphicon glyphicon-plus"></span> Agregar <i class="fa fa-plus"></i> </a></button>

                <?php
                    include "form_matricula.php";
                }
                ?>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableMatriculas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Matrícula</th>
                                <th>Tipo Matrícula</th>
                                <th>Fecha Matrícula</th>
                                <th>ID Estudiante</th>
                                <th>ID Grado</th>
                                <th>ID Sección</th>
                                <th>ID Año Escolar</th>
                                <th>Estado Documentos</th>
                                <th>Estado</th>
                                <?php if ($_SESSION["type"] == 1) { ?>
                                    <th>Acciones.</th>
                                <?php }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $resultMatriculas = mysqli_query($conexion, "SELECT m.IdMatricula, m.TipoMatricula,m.FechaMatricula,
                            CONCAT_WS(' ',e.Nombres,e.Apellidos) AS 'Estudiante', 
                            g.NombreGrado,s.NombreSeccion,a.AnioEscolar,
                            m.EstadoDocumentos,m.Estado,
                            m.FKIdEstudiante,m.FKIdGrado,m.FKIdSeccion,m.FKIdAnioEscolar
                            FROM matriculas AS m
                            INNER JOIN estudiantes AS e
                            ON m.FKIdEstudiante = e.IdEstudiante
                            INNER JOIN grados AS g
                            ON m.FKIdGrado = g.IdGrado
                            INNER JOIN secciones AS s
                            ON m.FKIdSeccion = s.IdSeccion
                            INNER JOIN anios_escolares AS a
                            ON m.FKIdAnioEscolar = a.IdAnioEscolar");
                            while ($matricula = mysqli_fetch_assoc($resultMatriculas)) { ?>
                                <tr>
                                    <td><?php echo $matricula['IdMatricula'] ?></td>
                                    <td><?php echo $matricula['TipoMatricula'] ?></td>
                                    <td><?php echo $matricula['FechaMatricula'] ?></td>
                                    <td><?php echo $matricula['Estudiante'] ?></td>
                                    <td><?php echo $matricula['NombreGrado'] ?></td>
                                    <td><?php echo $matricula['NombreSeccion'] ?></td>
                                    <td><?php echo $matricula['AnioEscolar'] ?></td>
                                    <td><?php echo $matricula['EstadoDocumentos'] ?></td>
                                    <td><?php echo $matricula['Estado'] ?></td>
                                    <td>
                                        <button type='button' class='btn btn-warning' data-toggle='modal' data-target="#editar<?php echo $matricula['IdMatricula'] ?>">Editar</button>
                                        <a href="../includes/eliminar_matricula.php?id=<?php echo $matricula['IdMatricula'] ?>" class='btn btn-danger btn-del'>Eliminar</a>
                                    </td>



                                    <!--
                            <td>< ?php echo $matricula['FKIdEstudiante'] ?></td>
                            <td>< ?php echo $matricula['FKIdGrado'] ?></td>
                            <td>< ?php echo $matricula['FKIdSeccion'] ?></td>
                            <td>< ?php echo $matricula['FKIdAnioEscolar'] ?></td>
                            -->



                                </tr>
                                <?php include "editar_matricula.php"; ?>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    </script>

                </div>
            </div>
        </div>
    </div>

    <?php //include "form_matricula.php"; 
    ?>
    <?php // Aquí se incluirán los modales de edición para cada matrícula 
    //foreach ($resultMatriculas as $matricula) {
    //    include "editar_matricula.php";
    //}
    ?>






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