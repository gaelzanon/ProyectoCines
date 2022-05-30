<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$Cine=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../../index.html');
	}

$Pelicula=$_POST['pelicula'];
$Descripcion=$_POST['descripcion'];
$Genero=$_POST['genero'];
$estreno=$_POST['fechaEstreno'];

$query1=("SELECT * FROM pelicula
	WHERE titulo='$Pelicula'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){

    if($Pelicula !='' && $Descripcion !='' && $Genero !=''){

        $id=uniqid();
        $fecha = date("d-m-Y", strtotime($estreno));
        $sql1="INSERT INTO pelicula VALUES('$id','$Descripcion','$fecha','$Genero','$Pelicula')";
        $query1= pg_query($con,$sql1);
       
        Header("Location: pelicula.php");

    }else{
        //Enviar mensaje de datos incorrectos a cartelera.php 
        Header("Location: pelicula.php");

    }
    

}else{
    //Enviar mensaje indicando que pelicula ya existe a cartelera.php
    Header("Location: pelicula.php");
}

?>


