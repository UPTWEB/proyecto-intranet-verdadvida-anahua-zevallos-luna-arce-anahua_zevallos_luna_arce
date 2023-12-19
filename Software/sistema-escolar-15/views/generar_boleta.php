<?php
require_once("../includes/db.php");

// Verificar si se ha enviado un ID de boleta en la URL
if (isset($_GET['idPension'])) {
    $idPension = mysqli_real_escape_string($conexion, $_GET['idPension']);

    // Consulta para obtener los detalles de la boleta
    $sql = "SELECT 
            e.DNI,
            CONCAT(e.Nombres, ' ', e.Apellidos) AS NombreCompleto,
            p.Mes,
            p.Monto,
            p.FechaVencimiento
        FROM 
            estudiantes e
        JOIN 
            pensiones p ON e.IdEstudiante = p.FKIdEstudiante
        WHERE
            p.IdPension = '" . $idPension . "';";

    $result = mysqli_query($conexion, $sql);

    if ($result && $fila = mysqli_fetch_assoc($result)) {
        // Crear el objeto PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Encabezado de la boleta
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'SISTEMA INTRANET', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Calle Real 1045 El Tambo - Hyo', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Código Postal 10002', 0, 1, 'C');
        $pdf->Cell(0, 10, '(064) 253396', 0, 1, 'C');
        $pdf->Cell(0, 10, 'cloued@cloued.com', 0, 1, 'C');
        $pdf->Cell(0, 10, date('Y-m-d H:i:s'), 0, 1, 'C');
        $pdf->Cell(0, 10, 'Comprobante de pago', 0, 1, 'C');
        $pdf->Ln(10);

        // Información del cliente (puedes personalizar estos datos)
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'CLIENTE', 0, 1);
        $pdf->Cell(0, 10, 'GUST TORPHY IV BINS', 0, 1);
        $pdf->Cell(0, 10, '704 Julian Valley Apt. 754 New Jamal, LA 05387', 0, 1);
        $pdf->Cell(0, 10, '+49(1)4001555594', 0, 1);
        $pdf->Cell(0, 10, 'Herzog.Brandon@hotmail.com', 0, 1);
        $pdf->Ln(10);

        // Detalles de la boleta
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50, 10, 'DNI', 1);
        $pdf->Cell(100, 10, 'Nombre Completo', 1);
        $pdf->Cell(40, 10, 'Mes', 1);
        $pdf->Cell(30, 10, 'Monto', 1);
        $pdf->Cell(40, 10, 'Fecha Vencimiento', 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, $fila['DNI'], 1);
        $pdf->Cell(100, 10, $fila['NombreCompleto'], 1);
        $pdf->Cell(40, 10, $fila['Mes'], 1);
        $pdf->Cell(30, 10, $fila['Monto'], 1);
        $pdf->Cell(40, 10, $fila['FechaVencimiento'], 1);
        $pdf->Ln();

        // Generar la boleta en PDF
        $pdf->Output();
    } else {
        echo "<p>Boleta no encontrada o error en la consulta.</p>";
    }
} else {
    echo "<p>ID de la boleta no especificado.</p>";
}
?>
