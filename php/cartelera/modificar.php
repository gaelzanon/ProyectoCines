<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");


session_start();
$cine=$_SESSION['nombre_usuario'];
$id=$_POST['idM'];
$fecha=$_POST['fech'];
$hora=$_POST['hor'];
$pelicula=$_POST['pelicul'];
$newFecha = date("d-m-Y", strtotime($fecha));

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

    $query2=("SELECT * FROM cartelera WHERE pelicula='$pelicula' AND cine='$cine' AND fecha='$newFecha' AND hora='$hora'");

$consulta=pg_query($con,$query1);

$consulta2=pg_query($con,$query2);
$cantidad=pg_num_rows($consulta2);

if($cantidad>0){

    $mensaje="*Ya hay una sesión añadida con esta fecha y hora.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:cartelera.php?error='.$mensaje);

} else {

    $sql="UPDATE cartelera SET fecha='$newFecha', hora='$hora' WHERE id='$id'";
    $query=pg_query($con,$sql);    
    Header("Location: cartelera.php");

}

?>
