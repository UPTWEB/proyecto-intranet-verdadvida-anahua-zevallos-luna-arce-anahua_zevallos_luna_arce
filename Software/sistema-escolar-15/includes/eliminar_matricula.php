<?php


$id = $_GET['id'];
require_once("db.php");
$query = mysqli_query($conexion, "DELETE FROM matriculas WHERE IdMatricula = '$id'");

header('Location: ../views/matricula.php');//?m=1
