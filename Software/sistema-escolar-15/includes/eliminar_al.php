<?php
require_once("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $conexion->prepare("UPDATE estudiantes SET Estado = 'inactivo' WHERE IdEstudiante = ?");
    $query->bind_param('i', $id);

    if ($query->execute()) {
        header('Location: ../views/alumnos.php?m=1');
    } else {
        header('Location: ../views/alumnos.php?m=2');
    }

    $query->close();
} else {
    header('Location: ../views/alumnos.php?m=3');
}
?>
