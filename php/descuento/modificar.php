<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");


session_start();
$user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$nombre=$_POST['nombrM'];
$descripcion=$_POST['descripcion'];
$nivel=$_POST['nivel'];

$query1=("SELECT * FROM descuento
	WHERE nombre='$nombre' AND cine='$user'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    if ($nivel == 'bronce') {
            $nivel = 'Bronce, Plata, Oro';
    } elseif ($nivel == 'plata') {
        $nivel = 'Plata, Oro';
    } else {
        $nivel = 'Oro';
    }
    $sql="UPDATE descuento SET descripcion='$descripcion', nivel='$nivel' WHERE nombre='$nombre' AND cine='$user'";
    $query=pg_query($con,$sql);    
    Header("Location: descuento.php");

}

?>
