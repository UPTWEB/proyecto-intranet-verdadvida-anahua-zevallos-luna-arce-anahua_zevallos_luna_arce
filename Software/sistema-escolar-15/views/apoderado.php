<?php include "../includes/header.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body id="page-top">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Apoderados</h6>
                <br>

                <?php if ($_SESSION["type"] == 1) { ?>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#apoderadoModal">
    <span class="glyphicon glyphicon-plus"></span> Agregar <i class="fa fa-plus"></i> </a></button>

<?php }
?>
            </div>

            <?php include "form_apoderado.php"; ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>DNI</th>
                                <th>Correo Personal</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                               <th>Relación Estudiante</th>
                               <th>FechaNacimiento</th>


                                <?php if ($_SESSION["type"] == 1) { ?>
                                    <th>Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT * FROM apoderados ");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?php echo $fila['Nombres']; ?></td>
                                    <td><?php echo $fila['ApellidoPaterno']; ?></td>
                                    <td><?php echo $fila['ApellidoMaterno']; ?></td>
                                    <td><?php echo $fila['DNI']; ?></td>
                                    <td><?php echo $fila['CorreoPersonal']; ?></td>
                                    <td><?php echo $fila['Celular']; ?></td>
                                    <td><?php echo $fila['Direccion']; ?></td>                              
                                    <td><?php echo $fila['RelacionEstudiante']; ?></td>
                                    <td><?php echo $fila['FechaNacimiento']; ?></td>


                                    <?php if ($_SESSION["type"] == 1) { ?>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                                <i class="fa fa-edit"></i> Editar
                                            </button>
                                            <a href="../includes/eliminar_apo.php?id=<?php echo $fila['IdApoderado']; ?>" class="btn btn-danger btn-del">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php include "editar_apoderado.php"; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include "../includes/footer.php"; ?>

</html>
