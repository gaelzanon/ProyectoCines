<!-- Mofica el nombre del espectdor y sus gustos -->

<?php
$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$provincia=$_POST['provincia'];

$sql2="UPDATE espectador SET provincia='$provincia' WHERE nombre='$user'";
$query2=pg_query($con,$sql2); 
   
Header("Location: perfil.php");

?>
