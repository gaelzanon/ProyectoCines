<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$nombre=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

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

    echo "<script>if(confirm('El cine ha sido borrado exitosamente')){
         document.location='../../index.html';
    }</script>";

}else{
       echo "<script>if(confirm('El cine no existe en el sistema')){
        document.location='../../index.html';
    }</script>";
}

?>