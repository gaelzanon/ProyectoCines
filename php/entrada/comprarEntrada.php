<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

    $cine=$_POST['cine'];
    $pelicula=$_POST['pelicula'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];

    $sql="SELECT nombre, descripcion, nivel FROM descuento WHERE cine='$cine'";
    $query=pg_query($con,$sql);
    $sql2="SELECT nivel FROM espectador WHERE nombre='$user'";
    $query2=pg_query($con, $sql2);

    $row2 = pg_fetch_array($query2);
    $nivel=$row2['nivel'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> COMPRAR ENTRADAS </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
    <body class="fondo">
        <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a class="active" href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a href="../../php/espectador/buscarEncuesta.php">Votar Encuesta</a></li>
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

                    <div class="row"> 
                        
                        <div class="col-md-6">
                            <h4>Confirma los datos para finalizar la compra de entradas</h3>
                            <br></br>
                                <form action="insertar.php" method="POST">

                                    <h4><?php  echo $user?></h4>
                                    <input name="user" value="<?php  echo $user?>" hidden>
                                    <br>
                                    <h4><?php  echo $cine?></h4>
                                    <input name="cine" value="<?php  echo $cine?>" hidden>
                                    <br>
                                    <h4><b style="color:#5091EA;">Pelicula: </b><?php  echo $pelicula?></h4>
                                    <input name="pelicula" value="<?php  echo $pelicula?>" hidden>
                                    <br></br>
                                    <h4><b style="color:#5091EA;">Fecha: </b><?php  echo $fecha?></h4>
                                    <input name='fecha' value="<?php  echo $fecha?>" hidden>
                                    <br></br>
                                    <h4><b style="color:#5091EA;">Hora: </b><?php  echo $hora?></h4>
                                    <input name="hora" value="<?php  echo $hora?>" hidden>
                                    <br></br>
                                    <h4><b style="color:#5091EA;">Elige una oferta: </b>
                                        <select name="nombre">
                                            <?php
                                                while ($row = pg_fetch_array($query)) {
                                                    if (strpos($row['nivel'], $nivel) !== false ) {
                                                        echo "<option name='nombre' value='" . $row['nombre'] ."'>" . $row['nombre'], ': ' , $row['descripcion'] ."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </h4>
                                    <br></br>
                                    <br></br>

                                     <input type="submit" class="btn btn-success" value="Confirmar">   
                                   
                                </form>
                                <br></br>
                                <a href="../espectador/cartelera.php" class="btn btn-danger">Cancelar</a>
                       
                         </div>
                    </div>  
                </div>
    </body>
</html>