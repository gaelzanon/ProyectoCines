<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$nivel=$_POST['nivel'];

$query1=("SELECT * FROM descuento
	WHERE cine='$user' AND nombre='$nombre'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){

    if($nombre !='' && $descripcion!='') {
        if ($nivel == 'bronce') {
            $nivel = 'Bronce, Plata, Oro';
        } elseif ($nivel == 'plata') {
            $nivel = 'Plata, Oro';
        } else {
            $nivel = 'Oro';
        }
        $sql="INSERT INTO descuento VALUES('$user','$nombre','$descripcion','$nivel')";
        $query= pg_query($con,$sql);
        Header("Location: descuento.php");
    }
} else {
    //Enviar mensaje de error a descuento.php
    Header("Location: descuento.php");

}

?>


