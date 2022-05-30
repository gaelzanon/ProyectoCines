<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../index.html');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="../static/css/estilos.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	
	<title>Menu principal</title>
</head>
<body class="fondo">
	<div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a class="active" href="../php/administrador.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../php/cine/list.php">Cines</a></li>
					<li><a href="../php/espectador/list.php">Usuarios</a></li>
					<li><a href="../php/pelicula/pelicula.php">Películas</a></li>
                </ul>
            </div>
		    <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../index.html">Cerrar Sesion</a>
                </div>
		    </div>
    </div>
	
	<div class="text-center">
		</br></br>
		</br></br>
		<h2><span style="color:white">¡Bienvenido a </span><span style="color:red">CinesCastellón</span>!</h2>
		</br></br>
		<img src="../imagenes/logo.png" height="400"/>		
		</br></br>
		
	</div>
	</body>	
</html>