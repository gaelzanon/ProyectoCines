<?php

// require 'conexion.php';

$conexion=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();

$usuario=$_POST['user'];
$clave=$_POST['pass'];

$query=("SELECT * FROM usuario 
	WHERE nombre='$usuario' AND password='$clave'");

$query2=("SELECT * FROM usuario 
	WHERE nombre='$usuario'");

$consulta2=pg_query($conexion,$query2);
$cantidad2=pg_num_rows($consulta2);

$consulta=pg_query($conexion,$query);
$cantidad=pg_num_rows($consulta);

$row = pg_fetch_array($consulta);

if($cantidad>0){

	$_SESSION['nombre_usuario']=$usuario;
	if($row['tipousuario'] == "Administrador"){  //Si el usuario introducido es el administrador se le redirige a una pagina difrente respecto a los demás usuarios.
		header('Location:../../php/administrador.php');
		$_SESSION['tipo_usuario']='Administrador';
	}elseif($row['tipousuario'] == 'Cine'){  //Si el usuario introducido es un cine se le redirige a una pagina difrente respecto a los demás usuarios.
		header('Location:../../php/cine/menuCine.php');
		$_SESSION['tipo_usuario']='Cine';
	}else{ //Si el usuario introducido es un usuario normal se le redirige a una pagina difrente respecto a los demás usuarios.
		header('Location:../../php/espectador/menu.php'); 
		$_SESSION['tipo_usuario']='Espectador';
	}
	
} elseif($cantidad2>0) { 
	$mensaje="*Contraseña incorrecta.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:login.php?error='.$mensaje); 
} else {
	$mensaje="*No existe este usuario.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:login.php?error='.$mensaje);
}
?>