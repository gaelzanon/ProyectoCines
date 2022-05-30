<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

    $sql="SELECT * FROM entrada WHERE espectador='$user'";
    $query=pg_query($con,$sql);

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
        <title> ENTRADAS </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
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
    <body class="fondo">
                <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a class="active" href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a href="../../php/espectador/buscarEncuesta.php">Votar Encuesta</a></li>
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
            <div class="container mt-5">
                    <div class="row">                                        

                        <h2 style="text-align:center;">Mis Entradas</h2>
                        <br></br>
                        <label style="color:#B91717; font-size:20px; text-align:center"><?php echo $error?></label>
                        <br></br>
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th>Cine</th>
                                        <th>Película</th>
                                        <th>Fecha</th>
                                        <th>Oferta</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row=pg_fetch_array($query)){
                                        ?>
                                            <tr>
                                                <th><?php  echo $row['cine']?></th>
                                                <th><?php  echo $row['pelicula']?></th> 
                                                <th><?php  echo $row['fecha']?></th>
                                                <th><?php  echo $row['descuento']?></th> 
                                                <th>
                                                    <button type="button" data-pelicula="<?php echo $row['pelicula']?>" data-cine="<?php echo $row['cine']?>" data-fecha="<?php echo $row['fecha']?>" data-id="<?php echo $row['id']?>" class="btn btn-danger open-modal">Eliminar</button>
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
				                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				                                                    <form action="delete.php" method="POST">
                                                                        <input id="idD" name="idD" type="text" hidden>
                                                                        <input type="submit" class="btn btn-danger" value="Eliminar">
                                                                    </form>
			                                                    </div>
		                                                    </div>
	                                                    </div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <button type="button" data-pelicula="<?php echo $row['pelicula']?>" data-cine="<?php echo $row['cine']?>" class="btn btn-light open-modal-valorar" style="background-color:#180202; color:white;">Valorar</button>
                                                    <div id="myModalValorar" class="modal fade">
			                                            <div class="modal-dialog modal-confirm">
				                                            <div class="modal-content">
					                                            <div class="modal-header flex-column">						
				                                                    <h4 class="modal-title w-100">Valora la película</h4>	
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                                                    </div>
                                                                <form action="../valoracion/insertar.php" method="POST">
					                                                <div class="modal-body justify-content-left">
                                                                        <h5><b>Usuario: </b><?php  echo $user?></h5>
                                                                        <input name="user" value="<?php  echo $user?>" hidden>
                                                                        <br>
                                                                        <h5><b>Cine: </b><input type="text" name="cin" id="cin" readonly></h5>
                                                                        <br>
                                                                        <h5><b>Pelicula: </b><input type="text" name="peli" id="peli" readonly></h5>
                                                                        <br>
                                                                        <h5><b>Puntuación: </b></h5>
                                                                        <select name="puntuacion">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                        <br></br>
                                                                        <h5><b>Comentario: </b><textarea type="text" class="form-control"name="comentario" rows="3"></textarea></h5>
					                                                </div>
			                                                        <div class="modal-footer justify-content-center">
				                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                        <input type="submit" class="btn btn-success" value="Confirmar">
			                                                        </div>
                                                                </form>
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
                    </div>  
            </div>
       <script type="text/javascript">
           $(document).on("click", ".open-modal", function () {
	           var pelicula = $(this).data('pelicula');
               var cine = $(this).data('cine');
               var fecha = $(this).data('fecha');
               var id = $(this).data('id');
               var str = "Deseas cancelar la entrada para la pelicula: " 
                      + pelicula
                      + " en "
                      + cine
                      + " para la fecha "
                      + fecha
                      + "?";
               $("#modal-body").html(str);
               $('#myModal').on('show.bs.modal',function(){
                    $("#idD").val(id);
               });
               $('#myModal').modal('show');
           });
       </script>
        <script type="text/javascript">
            $(document).on("click", ".open-modal-valorar", function () {
	            var peli = $(this).data('pelicula');
                var cine = $(this).data('cine');
                $('#myModalValorar').on('show.bs.modal',function(){
                    $("#peli").val(peli);
                    $("#cin").val(cine);
                });
                $('#myModalValorar').modal('show');
            });
        </script>
    </body>
</html>