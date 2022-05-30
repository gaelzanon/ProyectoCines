<!-- Modificacion de contrasena de usuario -->
 
<?php

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$nombre=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$pass=$_POST['pass'];
$nueva=$_POST['nueva'];

$query1=("SELECT * FROM usuario
	WHERE nombre='$nombre' and password='$pass'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){
    $sql="UPDATE usuario SET password='$nueva' WHERE nombre='$nombre'";
    $query=pg_query($con,$sql);    
    
    Header("Location: perfil.php");
} else {
    $mensaje="*Contraseña incorrecta.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:perfil.php?error='.$mensaje); 
}

?>
