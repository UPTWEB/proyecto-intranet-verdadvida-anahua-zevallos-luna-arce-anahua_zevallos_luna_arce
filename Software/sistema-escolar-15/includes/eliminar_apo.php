<?php
require_once("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtén el ID del apoderado a eliminar de forma segura

    // Preparar la consulta para evitar inyecciones SQL
    $query = $conexion->prepare("DELETE FROM apoderados WHERE IdApoderado = ?");
    $query->bind_param('i', $id); // 'i' indica que el ID es un entero

    // Ejecutar la consulta
    if ($query->execute()) {
        // La eliminación se realizó con éxito
        header('Location: ../views/apoderado.php?m=1'); // Redirige a la página de apoderados con un mensaje de éxito
    } else {
        // Hubo un error al eliminar el apoderado
        header('Location: ../views/apoderado.php?m=2'); // Redirige a la página de apoderados con un mensaje de error
    }

    // Cerrar la consulta preparada
    $query->close();
} else {
    // Si no se proporcionó un ID, redirige con un mensaje de error
    header('Location: ../views/apoderado.php?m=3');
}
?>

