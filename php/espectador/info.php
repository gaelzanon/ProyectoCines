<!-- Informacion de peliculas -->
<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

        session_start();
    $user=$_SESSION['nombre_usuario'];

    $nombre=$_POST['nombre'];
    $sql="SELECT descripcion,genero,titulo FROM pelicula WHERE id='$nombre'";
    $query=pg_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>INFORMACION</title>
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
		            <li><a class="active" href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a href="../../php/espectador/buscarEncuesta.php">Votar</a></li>
                </ul>
            </div>
	        <div class="topnav-right">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../../php/espectador/perfil.php">Perfil</a>
                    <a class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
	        </div>
        </div>
	    </div>
            <div class="container mt-5">
                   
                           
                            
                                <tbody>
                                        <?php
                                            $row=pg_fetch_array($query);
                                        ?>
                                            <center>
                                            <h2>Información de Película </h2>
                                            <br></br>
                                            <h4 style="color:Blue;">Título de la película</h4>
                                            <h5><?php  echo $row['titulo']?></h5>
                                            <h4 style="color:Blue;">Descripcion</h4>
                                            <h5><?php  echo $row['descripcion']?></h5>
                                            <h4 style="color:Blue;">Género</h4>
                                            <h5><?php  echo $row['genero']?></h5>
                                            </center>
                                                
                                </tbody>
                         
                    </div>  
            </div>
    </body>
</html>