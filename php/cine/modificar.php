<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$nombreNuevo=$_POST['nombr'];

$query2=("SELECT * FROM cine
	WHERE nombre='$nombreNuevo'");

$consulta2=pg_query($con,$query2);
$cantidad=pg_num_rows($consulta2);

if($cantidad==0){

    $sql=("UPDATE cine SET nombre='$nombreNuevo' WHERE nombre='$user'");
    $query=pg_query($con,$sql);

    $sql2=("UPDATE usuario SET nombre='$nombreNuevo' WHERE nombre='$user'");
    $query2=pg_query($con,$sql2);

    $sql3=("UPDATE cartelera SET cine='$nombreNuevo' WHERE cine='$user'");
    $query3=pg_query($con,$sql3);

    $sql4=("UPDATE descuento SET cine='$nombreNuevo' WHERE cine='$user'");
    $query4=pg_query($con,$sql4);

    $sql5=("UPDATE entrada SET cine='$nombreNuevo' WHERE cine='$user'");
    $query5=pg_query($con,$sql5);

    $_SESSION['nombre_usuario']=$nombreNuevo;

    Header("Location: perfil.php");

} else {

    $mensaje="*El nombre de usuario introducido no está disponible.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:perfil.php?error='.$mensaje);
}

?>
