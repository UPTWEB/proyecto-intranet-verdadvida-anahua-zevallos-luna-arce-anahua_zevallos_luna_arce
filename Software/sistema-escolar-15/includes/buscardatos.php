<?php
// Incluye tu archivo de conexión a la base de datos
include 'db.php'; // Cambia por la ruta correcta a tu archivo de configuración de base de datos

header('Content-Type: application/json');

// Recibe el DNI enviado desde el formulario
$dni = isset($_POST['dni']) ? $_POST['dni'] : '';

if (!empty($dni)) {
    // Preparar la consulta para buscar el estudiante
    $stmt = $conexion->prepare("SELECT Nombres, Apellidos FROM estudiantes WHERE DNI = ?");
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Devuelve el nombre y apellido en formato JSON
        echo json_encode(['status' => 'found', 'nombre' => $row['Nombres'], 'apellido' => $row['Apellidos']]);
    } else {
        // Si no se encuentra el estudiante
        echo json_encode(['status' => 'not_found']);
    }

    $stmt->close();
} else {
    // Si el DNI está vacío o no se proporciona
    echo json_encode(['status' => 'error', 'message' => 'DNI no proporcionado.']);
}

// Cierra la conexión a la base de datos si es necesario
$conexion->close();
?>
