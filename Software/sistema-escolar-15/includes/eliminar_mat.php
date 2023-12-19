<?php


	$id = $_GET['id'];
	require_once ("db.php");
	$query = mysqli_query($conexion,"DELETE FROM cursos WHERE id = '$id'");
	
	header ('Location: ../views/materias.php?m=1');
