<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$cine=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$id=$_POST['idB'];

$query1=("SELECT * FROM cartelera
	WHERE id='$id'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

    $sql="DELETE FROM cartelera WHERE id='$id'";
    $query= pg_query($con,$sql);

    Header("Location: cartelera.php");


?>