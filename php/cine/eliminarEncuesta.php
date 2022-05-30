<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$nombre=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$query1=("SELECT * FROM encuesta    
	WHERE id='$nombre'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $sql="DELETE FROM encuesta  WHERE id='$nombre'";
    $query= pg_query($con,$sql);

    Header("Location: encuesta.php");
}

?>