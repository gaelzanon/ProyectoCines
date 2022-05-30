<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

    $sql="SELECT * FROM encuesta WHERE id='$user'";
    $query=pg_query($con,$sql);

    $row=pg_fetch_array($query);

    $error='';
	try {
        if( isset($_GET['error']) ) {
            $error=$_GET['error'];
        };
    } catch (Exception $e) {
        $error1 = array("error1" => $e->getMessage());
        echo json_encode($error1);
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ENCUESTAS</title>
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
	<title>Menu principal</title>
</head>
    <body class="fondo">
	<div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/cine/menuCine.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/cartelera/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/descuento/descuento.php">Ofertas</a></li>
		            <li><a class="active" href="../../php/cine/encuesta.php">Encuestas</a></li>
                </ul>
            </div>
		    <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../../php/cine/perfil.php">Perfil</a>
                    <a style="color:Black" class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
		    </div>
        </div>
        <div class="container mt-5">
            <div class="row">

                <div class="col-md-3">

                    <form action="../../php/cine/resultados.php" method="POST">
                        <input type="submit" class="btn btn-danger" value="Cerrar Encuesta">
                    </form>
                    <br></br>

                    <h3>Nueva encuesta</h3>
                    <form action="../../php/cine/insertar.php" method="POST">

                        <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre de la encuesta" required>
                        <input type="text" class="form-control mb-3" name="opcion1" placeholder="Opcion 1" required>
                        <input type="text" class="form-control mb-3" name="opcion2" placeholder="Opcion 2" required>
                        <input type="text" class="form-control mb-3" name="opcion3" placeholder="Opcion 3" required>
                        <input type="text" class="form-control mb-3" name="opcion4" placeholder="Opcion 4" required>
                        <input type="submit" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Añadir encuesta">

                    </form>
                    <br></br>
                    <label style="color:#B91717; font-size:20px;"><?php echo $error?></label>

                </div>

                <div class="col-md-8">
                    <h2 style="text-align:center;">Encuesta Activa</h2>
                        <br></br>
                        <?php if($row!=null){    
                                echo'<table class="table" >';
                                echo'<thead>';
                                echo'<tr>';
                                echo'<th>Opcion</th>';
                                echo'<th>Votos</th>';
                                            
                                echo'</tr>';
                                echo'</thead>';

                                echo'<tbody>';
                                echo'<tr>';
                                echo'<th>',$row["opcion1"],'</th>';
                                echo'<th>',$row["reslt1"],'</th>';
                                echo'</tr>';
                                echo'<tr>';
                                echo'<th>',$row["opcion2"],'</th>';
                                echo'<th>',$row["reslt2"],'</th>';
                                echo'</tr>';
                                echo'<tr>';
                                echo'<th>',$row["opcion3"],'</th>';
                                echo'<th>',$row["reslt3"],'</th>';
                                echo'</tr>';
                                echo'<tr>';
                                echo'<th>',$row["opcion4"],'</th>';
                                echo'<th>',$row["reslt4"],'</th>';
                                echo'</tr>';
                                echo'</tbody>';
                                echo'</table>';
                        } else {
                            echo'<br></br><div style="font-size:20px; color:white; text-align:center;">No hay encuestas activas</div>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>