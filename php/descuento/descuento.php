<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

    $sql="SELECT *  FROM descuento WHERE cine='$user'";
    $query=pg_query($con,$sql);

    $filtro='';

    try {
        if( isset($_POST['filtro']) ) {
            $filtro=$_POST['filtro'];
        };
    } catch (Exception $e) {
        $error = array("error" => $e->getMessage());
        echo json_encode($error);
    };

    $sql2="SELECT * FROM descuento WHERE nombre LIKE '%$filtro%' AND cine='$user' ORDER BY nombre";
    $query2=pg_query($con, $sql2);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> PAGINA DESCUENTO</title>
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
    <body class="fondo" style="text-align:center;">
        <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/cine/menuCine.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/cartelera/cartelera.php">Cartelera</a></li>
		            <li><a class="active" href="../../php/descuento/descuento.php">Ofertas</a></li>
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
        <div class="col-md-3" style="float:left; margin:20px; width:300px; text-align: left;">
            <br></br>
            <h4>Filtrar: </h4>
            <form action="descuento.php" method="POST">

                <input type="text" class="form-control mb-3" name="filtro" placeholder="Nombre Descuento">
                <input type="submit" class="btn btn-light" style="background-color:#180202; color:white;" value="Buscar">               

            </form>
            <br>
            <form action="descuento.php" method="POST">
                <input name="filtro" value="" hidden>
                <input type="submit" class="btn btn-danger" value="Quitar filtro">
            </form>
        </div>
        <div class="container mt-5" style="float:center; display: inline-block; white-space: nowrap;">
            <div class="row">                       
                    <h2 style="text-align:center;">Descuentos del cine: <?php echo $user ?></h2>
                    <table class="table" style="text-align:left;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Niveles de Usuario Aptos</th>
                                <th></th>
                                <th>Filtro: <?php echo $filtro ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row=pg_fetch_array($query2)){
                            ?>
                                <tr>
                                    <th><?php  echo $row['nombre']?></th>
                                    <th><?php  echo $row['descripcion']?></th>
                                    <th><?php  echo $row['nivel']?></th>
                                    <th>
                                        <button type="button" data-nombre="<?php echo $row['nombre']?>" data-cine="<?php echo $row['cine']?>" data-descripcion="<?php echo $row['descripcion']?>" class="btn btn-light open-modal-modificar" style="background-color:#180202; color:white;">Modificar</button>
                                        <div id="myModalModificar" class="modal fade">
			                                <div class="modal-dialog modal-confirm">
				                                <div class="modal-content">
					                                <div class="modal-header flex-column">						
				                                        <h4 class="modal-title w-100">Introduce la nueva descripcion</h4>	
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                                        </div>
                                                    <form action="modificar.php" method="POST">
					                                    <div class="modal-body justify-content-left">
                                                            <h5><b>Nombre: </b><input type="text" name="nombrM" id="nombrM" readonly></h5>
                                                            <h5><b>Cine: </b><input type="text" id="cin" readonly></h5>
                                                            <h5><b>Descripcion: </b><input type="text" class="form-control" id="desc" name="descripcion" value="<?php echo $row['descripcion'] ?>"></h5>
                                                            <h5><b>Minimo nivel de usuario:</b></h5>
                                                            <select class="form-select" name="nivel" aria-label="Default select example">
                                                              <option value="bronce">Bronce</option>
                                                              <option value="plata">Plata</option>
                                                              <option value="oro">Oro</option>
                                                            </select>
					                                    </div>
			                                            <div class="modal-footer justify-content-center">
				                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <input type="submit" class="btn btn-success" value="Modificar">
			                                            </div>
                                                    </form>
		                                        </div>
	                                        </div>
                                        </div>                                                
                                    </th>
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
                            <tr style="background-color:#180202;"><th colspan="3" style="font-size: 20px;">Nuevo Descuento</th><th></th><th></th></tr>
                            <tr>
                                <form action="insertar.php" method="POST">
                                    <th>
                                        <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre" required>
                                    </th>
                                    <th>
                                    <textarea class="form-control mb-3" name="descripcion" placeholder="Descripcion" required></textarea>
                                    </th>
                                    <th>
                                        <select class="form-select" name="nivel" aria-label="Default select example">
                                            <option value="bronce">Bronce</option>
                                            <option value="plata">Plata</option>
                                            <option value="oro">Oro</option>
                                        </select>
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                        <input type="submit" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Añadir descuento">
                                    </th>
                                </form>
                            </tr>
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
        <script type="text/javascript">
           $(document).on("click", ".open-modal-modificar", function () {
	           var nombreM = $(this).data('nombre');
               var cine = $(this).data('cine');
               var descripcion = $(this).data('descripcion');
               $('#myModalModificar').on('show.bs.modal',function(){
                    $("#nombrM").val(nombreM);
                    $("#cin").val(cine);
                    $("#desc").val(descripcion);
               });
               $('#myModalModificar').modal('show');
           });
        </script>
    </body>
</html>