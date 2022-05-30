<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$ubic=$_POST['direccion'];
$provincia=$_POST['provincia'];

$query1=("SELECT * FROM cine
	WHERE nombre='$user'");

$consulta=pg_query($con,$query1);

$row=pg_fetch_array($consulta);
$prov=$row['provincia'];

if ($provincia != '') {
    $prov = $provincia;
}
$sql=("UPDATE cine SET direccion='$ubic', provincia='$prov' WHERE nombre='$user'");
$query=pg_query($con,$sql);

Header("Location: perfil.php");

?>
