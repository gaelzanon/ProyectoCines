<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../../index.html');
	}

$nombre=$_POST['nombr'];

$query1=("SELECT * FROM cine
	WHERE nombre='$nombre'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    
    $sql="DELETE FROM cine  WHERE  nombre='$nombre'";
    $query= pg_query($con,$sql);

    $sql1="DELETE FROM cartelera  WHERE  cine='$nombre'";
    $query= pg_query($con,$sql1);
    
    $sql2="DELETE FROM usuario  WHERE  nombre='$nombre'";
    $query= pg_query($con,$sql2);

    Header("Location: ../../php/cine/list.php");
}

?>