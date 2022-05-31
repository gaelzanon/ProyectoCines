<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if(($_SESSION['tipo_usuario']) != "Espectador") {
		header('Location:../../index.html');
	}

    $sql="SELECT provincia FROM espectador WHERE nombre='$user'";
    $query=pg_query($con, $sql);
    $rowProv=pg_fetch_array($query);
    $prov=$rowProv['provincia'];

    $sql4="SELECT genero FROM espectador WHERE nombre = '$user'";
    $query4=pg_query($con, $sql4);
    $generos=pg_fetch_array($query4)['genero'];
    $listageneros=explode(", ", $generos);
    $iter = new CachingIterator(new ArrayIterator($listageneros));
    $stringGeneros= "";
    foreach ($iter as $value) {
        $stringGeneros .= "'";
        $stringGeneros .= $value;
        if (!$iter->hasNext()) {
            $stringGeneros .= "'";
        } else {
            $stringGeneros .= "', ";
        }
    }

    $filtro='';
    $tipoFiltro='Sin filtro';

    try {
        if( isset($_POST['filtro']) ) {
            $filtro=$_POST['filtro'];
        };
    } catch (Exception $e) {
        $error = array("error" => $e->getMessage());
        echo json_encode($error);
    };

    try {
        if( isset($_POST['tipoFiltro']) ) {
            $tipoFiltro=$_POST['tipoFiltro'];
        };
    } catch (Exception $e) {
        $error = array("error" => $e->getMessage());
        echo json_encode($error);
    };

    if ($tipoFiltro == 'Por película') {

        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE LOWER(pelicula) LIKE LOWER('%$filtro%') AND ci.provincia = '$prov' AND hora IS NOT NULL AND fecha IS NOT NULL ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    } elseif (($tipoFiltro == 'Por cine')) {

        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE LOWER(cine) LIKE LOWER('%$filtro%') AND ci.provincia = '$prov' AND hora IS NOT NULL AND fecha IS NOT NULL ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    } elseif (($tipoFiltro == 'Por género')) {

        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE LOWER(genero) LIKE LOWER('%$filtro%') AND ci.provincia = '$prov' AND hora IS NOT NULL AND fecha IS NOT NULL ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    } elseif (($tipoFiltro == 'Por provincia')) {

        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE LOWER(ci.provincia) LIKE LOWER('%$filtro%') AND hora IS NOT NULL AND fecha IS NOT NULL ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    } elseif (($tipoFiltro == 'Todas las provincias')) {

        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE hora IS NOT NULL AND fecha IS NOT NULL ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    } elseif (($tipoFiltro == 'Recomendaciones')) {

        $sql4="SELECT titulo FROM pelicula WHERE genero IN ($stringGeneros)";
        $query4=pg_query($con, $sql4);
        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE pelicula IN (SELECT titulo FROM pelicula WHERE genero IN ($stringGeneros)) ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    } else {

        $sql2="SELECT * FROM public.pelicula as p INNER JOIN public.cartelera as c ON c.pelicula = p.titulo INNER JOIN public.cine as ci ON ci.nombre = c.cine WHERE ci.provincia = '$prov' AND hora IS NOT NULL AND fecha IS NOT NULL ORDER BY pelicula";
        $query2=pg_query($con, $sql2);

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> CARTELERA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="../../static/css/estilos.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body class="fondo" style="text-align: center;">
	    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a class="active" href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a href="../../php/espectador/buscarEncuesta.php">Votar Encuesta</a></li>
                    <li><a href="../../php/valoracion/list.php">Mis Valoraciones</a></li>
                </ul>
            </div>
	        <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div style="color:Black" class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../../php/espectador/perfil.php">Perfil</a>
                    <a style="color:Black" class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
	        </div>
        </div>
        <div class="col-md-3" style="float:left; margin:20px; width:300px; text-align: left;">
            <br></br>
            <br></br> 
            <h4>Filtrar películas:</h4>
            <br>
            <form action="cartelera.php" method="POST">
                <input type="text" class="form-control mb-3" name="filtro" placeholder="texto a filtrar">
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" name="tipoFiltro" value="Por cine">                                    
                <br></br>
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" name="tipoFiltro" value="Por película">
                <br></br>
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" name="tipoFiltro" value="Por género">
                <br></br>
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" name="tipoFiltro" value="Por provincia">
                <br></br>
                <br></br>
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" name="tipoFiltro" value="Todas las provincias">
                <br></br>
                <br></br>
                <h6 style="color:#5091EA;">Según tus géneros preferidos</h6>
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" name="tipoFiltro" value="Recomendaciones">
            </form>               
            <br></br>
            <form action="cartelera.php" method="POST">
                <input name="filtro" value="" hidden>
                <input type="hidden" name="tipoFiltro" value="Sin filtro">
                <input type="submit" class="btn btn-danger" value="Quitar filtro">
            </form>
        </div>
        <div class="container mt-5" style="float:center; display: inline-block; white-space: nowrap;">
            <div class="row">                 
                <div class="col-md-8">
                    <table class="table" style="text-align:left;">
                        <br>
                        <?php 
                            if ($tipoFiltro == 'Todas las provincias') {
                                echo '<h2 style="text-align:center;">Cartelera de todos los cines</h2>';
                            } else {
                                echo '<h2 style="text-align:center;">Cartelera de cines en la provincia de ',$prov,'</h2>';
                            }
                        ?>
                        <br></br>
                        <thead>
                            <tr>
                                <th>Cine</th>
                                <th>Provincia</th>
                                <th>Película</th>
                                <th>Estreno</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Género</th>
                                <th></th> 
                                <th colspan="2">Filtro: <?php echo $filtro ?> (<?php echo $tipoFiltro ?>)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row=pg_fetch_array($query2)){
                            ?>
                                <tr>
                                    <th><?php  echo $row['cine']?></th>
                                    <th><?php  echo $row['provincia']?></th>
                                    <th><?php  echo $row['pelicula']?></th>
                                    <th><?php  echo $row['fechaestreno']?></th>
                                    <th><?php  echo $row['fecha']?></th>
                                    <th><?php  echo $row['hora']?></th>
                                    <th><?php  echo $row['genero']?></th>
                                    <th>					
                                        <button type="button" data-pelicula="<?php echo $row['pelicula']?>" data-fechaestreno="<?php echo $row['fechaestreno']?>" data-genero="<?php echo $row['genero']?>" data-descripcion="<?php echo $row['descripcion']?>" class="btn btn-light open-modal" style="background-color:#180202; color:white;">Info</button>
                                        <div id="myModal" class="modal fade">
			                                <div class="modal-dialog modal-confirm">
				                                <div class="modal-content">
					                                <div class="modal-header flex-column">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h2 class="modal-title w-100">Información de la película</h2>	
			                                        </div>
					                                <div class="modal-body" id="modal-body">
					                                </div>
			                                        <div class="modal-footer justify-content-center">
			                                        </div>
		                                        </div>
	                                        </div>
                                        </div>
                                    </th>
                                    <th>
                                        <form action="../entrada/comprarEntrada.php" method="POST">
                                            <input type="hidden" name="cine" value="<?php  echo $row['cine']?>">
                                            <input type="hidden" name="pelicula" value="<?php  echo $row['pelicula']?>">
                                            <input type="hidden" name="fecha" value="<?php  echo $row['fecha']?>">
                                            <input type="hidden" name="hora" value="<?php  echo $row['hora']?>">
                                            <input type="submit" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Comprar Entrada">
                                        </form>
                                    </th>                                                
                                    <th>
                                        <form action="../valoracion/listPelicula.php" method="POST">
                                            <input type="hidden" name="pelicula" value="<?php  echo $row['pelicula']?>">
                                            <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" value="Ver Críticas">
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
        </div>
        <script type="text/javascript">
           $(document).on("click", ".open-modal", function () {
	           var pelicula = $(this).data('pelicula');
               var estreno = $(this).data('fechaestreno');
               var genero = $(this).data('genero');
               var descripcion = $(this).data('descripcion');
               var str = "<h4 style='color:#5091EA;'><b>Título de la película</b></h4><br><h5>" + pelicula
                    + "</h5><h4 style='color:#5091EA;'><b>Estreno</b></h4><br><h5>" + estreno
                    + "</h5><h4 style='color:#5091EA;'><b>Género</b></h4><br><h5>" + genero
                    + "</h5><h4 style='color:#5091EA;'><b>Descripción</b></h4><br><h5>" + descripcion
                    + "</h5>";
               $(".modal-body").html(str);
               $('#myModal').modal('show');
           });
        </script>
    </body>
</html>