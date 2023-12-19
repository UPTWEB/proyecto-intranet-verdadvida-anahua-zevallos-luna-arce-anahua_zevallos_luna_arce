<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Verifica si el archivo ya existe
if (file_exists($target_file)) {
  echo "Lo siento, el archivo ya existe.";
  $uploadOk = 0;
}

// Verifica el tamaño del archivo
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Lo siento, tu archivo es demasiado grande.";
  $uploadOk = 0;
}

// Permitir ciertos formatos de archivo
if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
  echo "Solo se permiten archivos PDF, DOC y DOCX.";
  $uploadOk = 0;
}

// Verifica si $uploadOk está establecido en 0 por un error
if ($uploadOk == 0) {
  echo "Lo siento, tu archivo no fue subido.";
// Si todo está bien, intenta subir el archivo
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "El archivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " ha sido subido.";
  } else {
    echo "Hubo un error subiendo tu archivo.";
  }
}
?>
