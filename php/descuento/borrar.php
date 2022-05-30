<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$cine=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$nombre=$_POST['nombr'];


$query1=("SELECT * FROM descuento
	WHERE nombre='$nombre' AND cine='$cine'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $sql="DELETE FROM descuento WHERE cine='$cine' AND nombre='$nombre'";
    $query= pg_query($con,$sql);
    Header("Location: descuento.php");
}

?>