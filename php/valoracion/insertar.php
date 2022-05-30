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

$query1=("SELECT * FROM valoracion WHERE usuario='$user' AND pelicula='$pelicula' AND cine='$cine'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){
    $id=uniqid();
    $sql="INSERT INTO valoracion VALUES('$id','$comentario','$cine','$pelicula','$puntuacion','$user')";
    $query= pg_query($con,$sql);
    Header("Location: list.php");

} else {
    $mensaje="*Ya has hecho un comentario para esta visita.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:../entrada/list.php?error='.$mensaje); 
}
?>