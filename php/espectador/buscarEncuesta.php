<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if(($_SESSION['tipo_usuario']) != "Espectador") {
		header('Location:../../index.html');
	}

    $sql="SELECT id,nombre  FROM encuesta";
    $query=pg_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> ENCUESTAS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="../../static/css/estilos.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body class="fondo" style="text-align:center;">
        <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a class="active" href="../../php/espectador/buscarEncuesta.php">Votar Encuesta</a></li>
                    <li><a href="../../php/valoracion/list.php">Mis Valoraciones</a></li>
                </ul>
            </div>
	        <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../../php/espectador/perfil.php">Perfil</a>
                    <a style="color:Black" class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
	        </div>
        </div>
        <div class="container mt-5" style="float:center; display: inline-block; white-space: nowrap;">
            <div class="row"> 
                <table class="table" style="text-align:left;">
                    <h2 style="text-align:center;">Encuestas</h2>
                    <br></br>
                    <br></br>
                    <thead>
                        <tr>
                            <th>Cine</th>
                            <th>Nombre de la encuesta</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row=pg_fetch_array($query)){
                        ?>
                            <tr>
                                <th><?php  echo $row['id']?></th>
                                <th><?php  echo $row['nombre']?></th>    
                                <th>
                                    <form action="../../php/espectador/encuesta.php" method="POST">
                                        <input type="hidden" class="form-control mb-3" name="Cine" value="<?php  echo $row['id']?>">
                                        <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" value="Consultar encuesta">                                   
                                    </form>
                                </th>
                            </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>  
        </div>
        <script type="text/javascript">
           $(document).on("click", ".open-modal", function () {
	           var cine = $(this).data('cine');
               $('#myModal').on('show.bs.modal',function(){
                    $("#cine").val(cine);
               });
               $('#myModal').modal('show');
           });
        </script>
    </body>
</html>