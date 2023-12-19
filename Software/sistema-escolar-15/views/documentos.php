<?php
// documentos.php

// Incluye el archivo de cabecera si existe.
if (file_exists("../includes/header.php")) {
    include "../includes/header.php";
}

// Asegurarse de que el directorio de subidas existe.
$uploadDir = __DIR__ . "/uploads";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Mostrar formulario de subida
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Selecciona el documento para subir:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Subir Documento" name="submit">
</form>

<h2>Documentos Subidos</h2>
<div>
    <?php
    // Asegúrate de que el directorio de subidas existe antes de llamar a scandir.
    if (file_exists($uploadDir)) {
        $files = scandir($uploadDir);
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                echo '<a href="' . htmlspecialchars($uploadDir . '/' . $file) . '" target="_blank">' . htmlspecialchars($file) . '</a><br>';
            }
        }
    } else {
        echo "El directorio de subidas no existe.";
    }
    ?>
</div>




</body>
</html>
