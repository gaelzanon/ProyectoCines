<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$Cine=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$Pelicula=$_POST['pelicula'];

$query1=("SELECT * FROM cartelera
	WHERE cine='$Cine' and pelicula='$Pelicula'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);


    $id=uniqid();

    $sql="INSERT INTO cartelera VALUES('$id','$Cine',null,null,'$Pelicula')";
    $query= pg_query($con,$sql);
       
    Header("Location: cartelera.php");


?>


