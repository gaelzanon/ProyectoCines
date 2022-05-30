<!-- Mofica el nombre del espectdor y sus gustos -->

<?php
$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$nombre=$_POST['nombr'];

$query1=("SELECT * FROM usuario
	WHERE nombre='$nombre'");

$consulta=pg_query($con,$query1);
$cantidad=pg_num_rows($consulta);

if($cantidad==0 && $nombre !=''){
    
    $sql="UPDATE usuario SET nombre='$nombre' WHERE nombre='$user'";
    $query=pg_query($con,$sql);

    $sql2="UPDATE espectador SET nombre='$nombre' WHERE nombre='$user'";
    $query2=pg_query($con,$sql2); 
    
    $_SESSION['nombre_usuario']=$nombre;
   
    Header("Location: perfil.php");

} else {

    $mensaje="*El nombre de usuario introducido no está disponible.";
	$_SESSION['mensaje']=$mensaje;
	header('Location:perfil.php?error='.$mensaje);

}

?>
