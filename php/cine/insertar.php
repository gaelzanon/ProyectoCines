<?php

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");


session_start();
$user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../../index.html');
	}

$nombre=$_POST['nombre'];
$opc1=$_POST['opcion1'];
$opc2=$_POST['opcion2'];
$opc3=$_POST['opcion3'];
$opc4=$_POST['opcion4'];

$query1=("SELECT * FROM encuesta
	WHERE id='$user'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){

    if($nombre !=''){

        $sql="INSERT INTO encuesta VALUES('$user','$nombre','$opc1','$opc2','$opc3','$opc4','0','0','0','0','0','')";
        $query= pg_query($con,$sql);

        Header("Location: encuesta.php");
    }

}else{
    $mensaje="*Este cine ya tiene una encuesta activa, finalízala antes de empezar la siguiente encuesta.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:encuesta.php?error='.$mensaje); 
}

?>


