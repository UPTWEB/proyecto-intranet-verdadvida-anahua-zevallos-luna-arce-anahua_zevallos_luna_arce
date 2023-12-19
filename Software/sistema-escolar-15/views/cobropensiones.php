<?php
require_once("../includes/db.php");

// Obtener el ID de la pensión desde la URL
$idPension = $_GET['idPension'] ?? '';

// Aquí iría tu lógica para integrar con la API de PayPal, Yape o Plin y procesar el pago

// Suponiendo que el pago fue exitoso, actualizar el estado en la base de datos
$sql = "UPDATE pensiones SET EstadoPago = 'Pagado' WHERE IdPension = $idPension";
$result = mysqli_query($conexion, $sql);

// Redirigir a alguna página, por ejemplo, una página de confirmación
header("Location: confirmacionPago.php");
?>
