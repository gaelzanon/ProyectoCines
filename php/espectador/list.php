<!-- Lista de cuentas de usuario ADMINISTRADOR-->
<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if(substr($user,0,13) != "ADMINISTRADOR") {
		header('Location:../../index.html'); 
	}

    $sql="SELECT * FROM usuario AS u INNER JOIN espectador AS e ON u.nombre=e.nombre WHERE u.tipousuario='Espectador' ORDER by u.nombre";
    $query=pg_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cuentas Usuario</title>
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
                    <li><a class="active" href="../php/espectador/list.php">Usuarios</a></li>
                    <li><a href="../../php/pelicula/pelicula.php">Pel??culas</a></li>
                </ul>
            </div>
		    <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
		    </div>
        </div>
        <div class="container mt-5" style="float:center; display: inline-block; white-space: nowrap;">
            <div class="row">                        
                    <h2 style="text-align:center;">Usuarios </h2>
                    <br></br>
                    <br></br>
                    <table class="table" style="text-align:left;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nivel</th>
                                <th>Provincia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row=pg_fetch_array($query)){
                            ?>
                            <tr>
                                <th><?php echo $row['nombre']?></th>
                                <th><?php echo $row['nivel']?></th>
                                <th><?php echo $row['provincia']?></th>
                                <th>					
                                    <button type="button" data-nombre="<?php echo $row['nombre']?>" class="btn btn-danger open-modal">Eliminar</button>
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
				                                    <form action="adminBorrar.php" method="POST">
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