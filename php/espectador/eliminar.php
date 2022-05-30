<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$nombre=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$query1=("SELECT * FROM usuario
	WHERE nombre='$nombre'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $sql="DELETE FROM espectador  WHERE  nombre='$nombre'";
    $query= pg_query($con,$sql);
    
    $sql2="DELETE FROM usuario  WHERE  nombre='$nombre'";
    $query= pg_query($con,$sql2);
 
    $sql3="DELETE FROM entrada WHERE espectador='$nombre'";
    $query= pg_query($con,$sql3);

    echo "<script>if(confirm('El usuario ha sido borrado exitosamente')){
         document.location='../../index.html';
    }</script>";

}else{
       echo "<script>if(confirm('El usuario no existe en el sistema')){
        document.location='../../index.html';
    }</script>";
}

?>