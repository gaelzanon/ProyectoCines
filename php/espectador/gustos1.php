<?php

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$nombre=$_SESSION['nombre_usuario'];
$gustos=$_POST['Gustos'];


$listaGustos=implode(", ", $gustos);

$sql="UPDATE espectador SET genero='$listaGustos' WHERE nombre='$nombre'";
$query=pg_query($con,$sql);    
Header("Location: perfil.php");

?>
