<?php


$id = $_GET['id'];
require_once("db.php");
$query = mysqli_query($conexion, "DELETE FROM grados WHERE id = '$id'");

header('Location: ../views/grados.php?m=1');
