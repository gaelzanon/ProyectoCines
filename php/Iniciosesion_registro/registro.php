<?php

require 'conexion.php';

$con=pg_connect("host=localhost  port=5433 dbname=test user=postgres password=admin");

session_start();

$usuario=$_POST['usuario'];
$clave=$_POST['pass'];
$gustos=$_POST['Gustos'];
$provincia=$_POST['provincia'];

$listaGustos=implode(", ", $gustos);

$query=("SELECT * FROM usuario 
	WHERE nombre='$usuario'");

$consulta=pg_query($conexion,$query);
$cantidad=pg_num_rows($consulta);

if($cantidad==0){

	$_SESSION['nombre_usuario']=$usuario;

    $sql="insert into usuario values('$usuario','$clave','Espectador')";
    $sql1="insert into espectador values('$usuario','$listaGustos','Bronce', '$provincia', 0)";
    pg_query($con,$sql);
    pg_query($con,$sql1);
    header('Location:login.php');
   
}
else{
    $mensaje="*Este nombre de usuario no está disponible.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:formularioRegistro.php?error='.$mensaje);
	
}

?>