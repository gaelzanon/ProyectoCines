<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$cine=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../../index.html');
	}

$nombre=$_POST['nombr'];

$query1=("SELECT * FROM pelicula
	WHERE titulo='$nombre'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $sql="DELETE FROM pelicula WHERE  titulo='$nombre'";
    $query= pg_query($con,$sql);

    Header("Location: pelicula.php");

}else{
       echo "<script>if(confirm('Esta pelicula no existe')){
        document.location='../../php/pelicula/pelicula.php';
    }else{document.location='pelicula.php';}</script>";
}

?>