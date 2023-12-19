<?php
include "db.php"; // Asegúrate de que este path sea correcto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idEstudiante = $_POST['idEstudiante'];
    $estadoAsistencia = $_POST['estadoAsistencia']; // Puede ser 'Puntual', 'Tarde' o 'Falta'
    $fecha = date('Y-m-d'); // Fecha actual

    // Verificar si ya existe un registro de asistencia para este estudiante en esta fecha
    $consultaExistente = "SELECT * FROM asistencias WHERE FKIdEstudiante = '$idEstudiante' AND Fecha = '$fecha'";
    $resultadoExistente = mysqli_query($conexion, $consultaExistente);

    if (mysqli_num_rows($resultadoExistente) > 0) {
        // Actualizar el registro existente
        $consultaUpdate = "UPDATE asistencias SET EstadoAsistencia = '$estadoAsistencia' WHERE FKIdEstudiante = '$idEstudiante' AND Fecha = '$fecha'";
        $resultadoUpdate = mysqli_query($conexion, $consultaUpdate);
    } else {
        // Insertar un nuevo registro
        $consultaInsert = "INSERT INTO asistencias (Fecha, EstadoAsistencia, FKIdEstudiante) VALUES ('$fecha', '$estadoAsistencia', '$idEstudiante')";
        $resultadoInsert = mysqli_query($conexion, $consultaInsert);
    }

    if (isset($resultadoUpdate) && $resultadoUpdate || isset($resultadoInsert) && $resultadoInsert) {
        echo "Registro de asistencia actualizado correctamente.";
    } else {
        echo "Error al registrar la asistencia.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
