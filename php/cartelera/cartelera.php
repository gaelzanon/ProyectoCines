
<!-- Cartelera por cine  cuando el usuario es un CINE-->
<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

    $filtro='';

    try {
        if( isset($_POST['filtro']) ) {
            $filtro=$_POST['filtro'];
        };
    } catch (Exception $e) {
        $error = array("error" => $e->getMessage());
        echo json_encode($error);
    };

    $error='';
	try {
        if( isset($_GET['error']) ) {
            $error=$_GET['error'];
        };
    } catch (Exception $e) {
        $error1 = array("error1" => $e->getMessage());
        echo json_encode($error1);
    };

    $sql="SELECT c.id, c.cine, c.pelicula, p.genero, p.fechaestreno, c.fecha, c.hora FROM public.cartelera as c INNER JOIN public.pelicula as p ON c.pelicula = p.titulo WHERE c.cine='$user' ORDER BY pelicula";
    $query=pg_query($con,$sql);

    $sql2="SELECT * FROM pelicula WHERE LOWER(titulo) LIKE LOWER('%$filtro%') ORDER BY pelicula";
    $query2=pg_query($con,$sql2);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CARTELERA</title>
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
    <body class="fondo">
	    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/cine/menuCine.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a class="active" href="../../php/cartelera/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/descuento/descuento.php">Ofertas</a></li>
		            <li><a href="../../php/cine/encuesta.php">Encuestas</a></li>
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
                    <h2 style="text-align:center;">Cartelera</h2>
                    <br></br>
                    <label style="color:#B91717; font-size:20px;"><?php echo $error?></label>
                    <br></br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Película</th>
                                <th>Género</th>
                                <th>Fecha Estreno</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th></th>
                                <th></th>    
                            </tr>
                        </thead>

                        <tbody>
                                <?php
                                    while($row=pg_fetch_array($query)){
                                ?>
                                    <tr>
                                        <th><?php  echo $row['pelicula']?></th>
                                        <th><?php  echo $row['genero']?></th>
                                        <th><?php  echo $row['fechaestreno']?></th>
                                        <th>
                                            <?php 
                                                if($row['fecha'] == '') {
                                                    echo '<span style="color:#D70E0E;text-align:center;">*Añadir fecha</span>';
                                                } else {
                                                    echo $row["fecha"];
                                                } 
                                            ?>
                                        </th> 
                                        <th>
                                            <?php 
                                                if($row['hora'] == '') {
                                                    echo '<span style="color:#D70E0E;text-align:center;">*Añadir hora</span>';
                                                } else {
                                                    echo $row['hora'];
                                                } 
                                            ?>
                                        </th>
                                        <th>
                                            <button type="button" data-id="<?php echo $row['id']?>" data-pelicula="<?php echo $row['pelicula']?>" data-cine="<?php echo $row['cine']?>" data-fecha="<?php echo date('Y-m-d', strtotime($row['fecha']))?>" data-hora="<?php echo $row['hora']?>" class="btn btn-light open-modal-modificar" style="background-color:#180202; color:white;">Modificar fecha y hora</button>
                                            <div id="myModalModificar" class="modal fade">
			                                    <div class="modal-dialog modal-confirm">
				                                    <div class="modal-content">
					                                    <div class="modal-header flex-column">						
				                                            <h4 class="modal-title w-100">Introduce la fecha y hora</h4>	
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                                            </div>
                                                        <form action="modificar.php" method="POST">
					                                        <div class="modal-body justify-content-left">
                                                                <input type="hidden" name="idM" id="idM">
                                                                <h5><b>Nombre: </b><input type="text" name="pelicul" id="pelicul" readonly></h5>
                                                                <h5><b>Fecha: </b><input type="date" class="form-control" name="fech" id="fech"></h5>
                                                                <h5><b>Hora: </b><input type="time" class="form-control" name="hor" id="hor"></h5>
					                                        </div>
			                                                <div class="modal-footer justify-content-center">
				                                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                                                <input type="submit" class="btn btn-success" value="Modificar">
			                                                </div>
                                                        </form>
		                                            </div>
	                                            </div>
                                            </div>                                                
                                        </th>
                                        <th>					
                                            <button type="button" data-nombre="<?php echo $row['pelicula']?>" data-id="<?php echo $row['id']?>" class="btn btn-danger open-modal">Eliminar</button>
                                            <div id="myModal" class="modal fade">
			                                    <div class="modal-dialog modal-confirm">
				                                    <div class="modal-content">
					                                    <div class="modal-header flex-column">
						                                    <div class="icon-box">
							                                    <i class="material-icons">&#xE5CD;</i>
				                                            </div>						
				                                            <h4 class="modal-title w-100">Confimar la eliminacion</h4>	
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                                            </div>
					                                    <div class="modal-body" id="modal-body">
					                                    </div>
			                                            <div class="modal-footer justify-content-center">
				                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
				                                            <form action="borrar.php" method="POST">
                                                                <input id="idB" name="idB" type="text" hidden>
                                                                <input type="submit" class="btn btn-danger" value="Eliminar">
                                                            </form>
			                                            </div>
		                                            </div>
	                                            </div>
                                            </div>
                                        </th>                                          
                                    </tr>
                                <?php 
                                    }
                                ?>
                        
                        </tbody>
                    </table>
                    <p><br></p>
                    <a class="btn btn-light" style="background-color:#180202; color:white;" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                        Añadir Películas
                    </a>
                    <p><br></p>
                    <div class="collapse" id="collapse">
                            <h2 style="text-align:center;">Películas Disponibles</h2>
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th>Película</th>
                                        <th>Género</th>
                                        <th>Fecha Estreno</th>
                                        <th>Filtrando: <?php echo $filtro ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row2=pg_fetch_array($query2)){
                                        ?>
                                            <tr>
                                                <th><?php  echo $row2['titulo']?></th>
                                                <th><?php  echo $row2['genero']?></th>
                                                <th><?php  echo $row2['fechaestreno']?></th>
                                                <th>
                                                    <form action="insertar.php" method="POST">
                                                        <input name="pelicula" value="<?php echo $row2['titulo']?>" type="text" hidden>
                                                        <input name="genero" value="<?php echo $row2['genero']?>" type="text" hidden>
                                                        <input type="submit" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Añadir">
                                                    </form>
                                                </th>                                          
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                        <tr>
                                            <form action="cartelera.php" method="POST">
                                                <th colspan="2"><input type="text" class="form-control mb-3" name="filtro" placeholder="Buscar Pelicula"></th>
                                                <th>
                                                    <input type="submit" class="btn btn-success" value="Buscar">
                                                </th>
                                            </form>
                                            <th>
                                                <form action="cartelera.php" method="POST">
                                                    <input name="filtro" value="" hidden>
                                                    <input type="submit" class="btn btn-danger" value="Quitar filtro">
                                                </form>
                                            </th>
                                        </tr>
                        
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        <script type="text/javascript">
           $(document).on("click", ".open-modal", function () {
               var id = $(this).data('id');
	           var nombre = $(this).data('nombre');
               var str = "Deseas eliminar " 
                      + nombre 
                      + " de la cartelera?";
               $("#modal-body").html(str);
               $('#myModal').on('show.bs.modal',function(){
                    $("#nombr").val(nombre);
                    $("#idB").val(id);
               });
               $('#myModal').modal('show');
           });
        </script>
        <script type="text/javascript">
           $(document).on("click", ".open-modal-modificar", function () {
               var idM = $(this).data('id');
	           var titulo = $(this).data('pelicula');
               var cine = $(this).data('cine');
               var fecha = $(this).data('fecha');
               var hora = $(this).data('hora');
               $('#myModalModificar').on('show.bs.modal',function(){
                   $("#idM").val(idM);
                   $("#pelicul").val(titulo);
                   $("#cin").val(cine);
                   $("#fech").val(fecha);
                   $("#hor").val(hora);
               });
               $('#myModalModificar').modal('show');
           });
        </script>
    </body>
</html>