<?php

// require 'conexion.php';

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$id=$_POST['id'];

$query1=("SELECT * FROM valoracion
	WHERE id='$id'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $sql="DELETE FROM valoracion  WHERE  id='$id'";
    $query= pg_query($con,$sql);

    echo "<script>if(confirm('La valoración ha sido cancelada')){
        document.location='../../php/entrada/list.php';
    }</script>";

}else{
       echo "<script>if(confirm('Esta valoración ya no existe,�Quieres intentarlo de nuevo?')){
        document.location='delete.php';
    }else{document.location='list.php';}</script>";
}

?>