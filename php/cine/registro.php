<?php

// require 'conexion.php';

$con=pg_connect("host=localhost  port=5433 dbname=test user=postgres password=admin");

session_start();
	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../../index.html');
	}

$usuario=$_POST['user'];
$clave=$_POST['pass'];
$provincia=$_POST['provincia'];
$direccion=$_POST['direccion'];

$query=("SELECT * FROM usuario 
	WHERE nombre='$usuario'");

$consulta=pg_query($con,$query);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){

        $sql="insert into usuario values('$usuario','$clave','Cine')";
        $sql1="insert into cine values('$usuario','$direccion','$provincia')";
        pg_query($con,$sql);
        pg_query($con,$sql1);
        
        Header("Location: list.php");
} else {
    $mensaje="*Este cine ya está registrado.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:formularioRegistro.php?error='.$mensaje);
}

?>