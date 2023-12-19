<?php
// confirmarpago.php
include 'db.php'; // Asume que db.php conecta a tu base de datos

$idPension = $_GET['id']; // Asegúrate de validar y limpiar este parámetro

// Aquí actualizarías el estado de la pensión a "Pagado"
$sql = "UPDATE pensiones SET EstadoPago = 'Pagado' WHERE IdPension = ?";
if($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $idPension);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Redirigir de nuevo a la lista de pensiones
header('Location: pagopensiones.php'); // Asegúrate de que esta sea la ruta correcta
exit;
?>
