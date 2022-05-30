<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$cine=$_POST['cine'];
$pelicula=$_POST['pelicula'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$descuento=$_POST['nombre'];
$id=uniqid();

$query1=("SELECT * FROM entrada
	WHERE id='$id'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){
    $sql="INSERT INTO entrada VALUES('$id','$cine','$descuento','$user','$fecha','$pelicula')";
    $query= pg_query($con,$sql);

    $sql2=("SELECT puntuacion FROM espectador WHERE nombre='$user'");
    $query2= pg_query($con,$sql2);
    $res = pg_fetch_array($query2);
    $puntos=$res['puntuacion'];
    $puntosextras=1;
    $puntuacion = $puntos + $puntosextras;
    $sql3="UPDATE espectador SET puntuacion='$puntuacion' WHERE nombre='$user'";
    $query3= pg_query($con,$sql3);
    
    if( $puntuacion > 30 ){
        $nivel = "Oro"; 
        $sql4="UPDATE espectador SET nivel='$nivel' WHERE nombre='$user'";
        $query4= pg_query($con,$sql4);
    } elseif( $puntuacion > 10 ){
        $nivel = "Plata"; 
        $sql4="UPDATE espectador SET nivel='$nivel' WHERE nombre='$user'";
        $query4= pg_query($con,$sql4);
    }
    
    Header("Location: list.php");

}?>