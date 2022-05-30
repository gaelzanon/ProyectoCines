<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$pelicula=$_POST['peli'];
$comentario=$_POST['comentario'];
$puntuacion=$_POST['puntuacion'];
$cine=$_POST['cin'];

$sql="UPDATE valoracion SET comentario='$comentario', puntuacion='$puntuacion' WHERE pelicula='$pelicula' AND cine='$cine' AND usuario='$user'";
$query= pg_query($con,$sql);
Header("Location: list.php");

?>