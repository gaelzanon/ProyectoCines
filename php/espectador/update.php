<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modificar Perfil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="../../static/css/estilos.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a href="../../php/espectador/buscarEncuesta.php">Votar</a></li>
                </ul>
            </div>
	        <div class="topnav-right">
                <a class="nav-link dropdown-toggle active" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../../php/espectador/perfil.php">Perfil</a>
                    <a class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
	        </div>
        </div>
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-8">
                <h2 style="color:Tomato;">Modificando su perfil</h2>

                <tbody>
                    <form action="../../php/espectador/modificarUsuario.php" method="POST">
                        <br></br>
                        <h4 style="color:Blue;">Nombre de usuario</h4>
                        <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre de Usuario">

                        <input type="submit" class="btn btn-primary" value="Guardar cambios">

                    </form>

                </tbody>

            </div>
        </div>
    </div>
</body>
</html>
