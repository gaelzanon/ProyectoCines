
<!-- Cartelera por cine  cuando el usuario es un CINE-->
<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Administrador") {
		header('Location:../../index.html');
	}

    $sql="SELECT * FROM pelicula ORDER BY pelicula";
    $query=pg_query($con,$sql);
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
    <body class="fondo" style="text-align: center;">
	    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/administrador.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/cine/list.php">Cines</a></li>
					<li><a href="../../php/espectador/list.php">Usuarios</a></li>
                    <li><a class="active" href="../../php/pelicula/pelicula.php">Películas</a></li>
                </ul>
            </div>
		    <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
		    </div>
        </div>
        
                    <div class="col-md-3" style="float:left; margin:20px; width:300px; text-align: left;">
                            
                            <br></br>
                            <br></br>
                            <h3>Nueva película</h3>
                            <br></br>
                                <form action="insertar.php" method="POST">

                                     <input type="text" class="form-control mb-3" name="pelicula" placeholder="Película" required>
                                     <input type="date" class="form-control mb-3" name="fechaEstreno" placeholder="Estreno" required>
                                     <textarea type="text" class="form-control mb-3" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
                                      <p>Seleccione el género </p>
                                      <select name="genero" required>
                                            <option value="Comedia">Comedia</option>
                                            <option value="Accion">Accion</option>
                                            <option value="Romance">Romance</option>
                                            <option value="Terror">Terror</option>
                                            <option value="Infantil">Infantil</option>
                                      </select>
                                      <br></br>
                                        
                                     <input type="submit" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Añadir película">
                                    
                                   
                                </form>
                                                
                       
                            </div>
            <div class="container mt-5" style="float:center; display: inline-block; white-space: nowrap;">
                    <div class="row"> 
                        
                            <h2 style="text-align:center;">Películas</h2>
                            <br></br>
                            <br></br>
                            <table class="table" style="text-align: left;">
                                <thead>
                                    <tr>
                                        <th>Película</th>
                                        <th>Género</th>
                                        <th>Fecha estreno</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row=pg_fetch_array($query)){
                                        ?>
                                            <tr>
                                                <th><?php  echo $row['titulo']?></th>
                                                <th><?php  echo $row['genero']?></th>
                                                <th><?php  echo $row['fechaestreno']?></th> 
                                                <th>					
                                                    <button type="button" data-nombre="<?php echo $row['titulo']?>" class="btn btn-danger open-modal">Eliminar</button>
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
				                                                    <form action="borrar.php" method="POST">
                                                                        <input id="nombr" name="nombr" type="text" hidden>
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
                    </div>  
            </div>
        <script type="text/javascript">
           $(document).on("click", ".open-modal", function () {
	           var nombre = $(this).data('nombre');
               var str = "Deseas eliminar: " 
                      + nombre 
                      + "?";
               $("#modal-body").html(str);
               $('#myModal').on('show.bs.modal',function(){
                    $("#nombr").val(nombre);
               });
               $('#myModal').modal('show');
           });
        </script>
    </body>
</html>