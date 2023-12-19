<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    require_once("db.php");

    // Usar sentencias preparadas para evitar inyecciones SQL
    $consulta = $conexion->prepare("DELETE FROM profesores WHERE IdProfesor = ?");
    $consulta->bind_param('i', $id); // 'i' indica que la variable $id es de tipo entero

    if ($consulta->execute()) {
        // Si el profesor se eliminó con éxito, redirigir con un mensaje de éxito
        header('Location: ../views/profesores.php?m=1');
    } else {
        // Si hubo un error al eliminar, redirigir con un mensaje de error
        header('Location: ../views/profesores.php?m=2');
    }

    $consulta->close(); // Cerrar la sentencia preparada
} else {
    // Si no se proporcionó un id, redirigir con un mensaje de error
    header('Location: ../views/profesores.php?m=3');
}

?>
