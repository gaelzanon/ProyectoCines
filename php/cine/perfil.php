
<!-- Cartelera por cine  cuando el usuario es un CINE-->

<?php 
    // include("conexion.php");
    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

    $error='';
	try {
        if( isset($_GET['error']) ) {
            $error=$_GET['error'];
        };
    } catch (Exception $e) {
        $error1 = array("error1" => $e->getMessage());
        echo json_encode($error1);
    };

    $sql="SELECT *  FROM cine WHERE nombre='$user'";
    $query=pg_query($con,$sql);

    $row=pg_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PERFIL</title>
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
		            <li><a href="../../php/cartelera/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/descuento/descuento.php">Ofertas</a></li>
		            <li><a href="../../php/cine/encuesta.php">Encuestas</a></li>
                </ul>
            </div>
		    <div class="topnav-right">
                <a style="color:White" class="nav-link dropdown-toggle active" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:Black" class="dropdown-item" href="../../php/cine/perfil.php">Perfil</a>
                    <a style="color:Black" class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
		    </div>
        </div>
        <div class="container mt-5">
            <div class="row"> 
                <div class="col-md-3">
                    <br></br>
                    <br></br>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" id="submit">Eliminar Perfil</button>
                    <div id="myModal" class="modal fade">
			            <div class="modal-dialog modal-confirm">
				            <div class="modal-content">
					            <div class="modal-header flex-column">
                                    <div class="icon-box">
							            <i class="material-icons">&#xE5CD;</i>
				                    </div>
				                    <h4 class="modal-title w-100">Estas seguro que deseas eliminar tu perfil de usuario?</h4>	
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    </div>
					            <div class="modal-body">                                      
					            </div>
			                    <div class="modal-footer justify-content-center">
                                    <form action="borrar.php" method="POST">
				                        <input type="submit" class="btn btn-danger" value="Confirmar">
			                        </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
		                    </div>
	                    </div>
                    </div>
                    <br></br>
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalPass" id="submit" style="background-color:#180202; color:white;">Cambiar Contraseña</button>
                    <div id="myModalPass" class="modal fade">
			            <div class="modal-dialog modal-confirm">
				            <div class="modal-content">
					            <div class="modal-header flex-column">					
				                    <h4 class="modal-title w-100">Introduce la nueva contrasena</h4>	
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    </div>
                                <form action="../../php/cine/pass.php" method="POST">
					                <div class="modal-body">
                                        <h5>Contraseña actual</h5><input type="password" class="form-control mb-3" name="pass" placeholder="Contrasena actual">
                                        <h5>Nueva contraseña</h5><input type="password" class="form-control mb-3" name="nueva" placeholder="Nueva contrasena">
                                        <input type="submit" class="btn btn-primary" value="Confirmar">                                         
					                </div>
			                        <div class="modal-footer justify-content-center">
				                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			                        </div>
                                </form>
		                    </div>
	                    </div>
                    </div>
                    <br></br>
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalMod" id="submit" style="background-color:#180202; color:white;">Modificar Nombre de usuario</button>
                    <div id="myModalMod" class="modal fade">
			            <div class="modal-dialog modal-confirm">
				            <div class="modal-content">
					            <div class="modal-header flex-column">					
				                    <h4 class="modal-title w-100">Introduce los nuevos datos</h4>	
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    </div>
                                <form action="../../php/cine/modificar.php" method="POST">
					                <div class="modal-body">
                                        <h5>Nombre de usuario</h5><input type="text" class="form-control mb-3" name="nombr" placeholder="<?php echo $user ?>" value="<?php echo $user ?>">                                     
					                </div>  
			                        <div class="modal-footer justify-content-center">
                                        <input type="submit" class="btn btn-primary" value="Guardar cambios">   
				                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			                        </div>
                                </form>
		                    </div>
	                    </div>
                    </div> 
                    <br></br>
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalDir" id="submit" style="background-color:#180202; color:white;">Modificar Dirección</button>
                    <div id="myModalDir" class="modal fade">
			            <div class="modal-dialog modal-confirm">
				            <div class="modal-content">
					            <div class="modal-header flex-column">					
				                    <h4 class="modal-title w-100">Introduce los nuevos datos</h4>	
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    </div>
                                <form action="../../php/cine/modificarDireccion.php" method="POST">
					                <div class="modal-body">
                                        <h5>Provincia</h5><select name="provincia" class="form-control" placeholder="<?php echo $row['provincia']?>">
                                            <option value="">Elige Provincia</option>
                                            <option value="Álava/Araba">Álava/Araba</option>
                                            <option value="Albacete">Albacete</option>
                                            <option value="Alicante">Alicante</option>
                                            <option value="Almería">Almería</option>
                                            <option value="Asturias">Asturias</option>
                                            <option value="Ávila">Ávila</option>
                                            <option value="Badajoz">Badajoz</option>
                                            <option value="Baleares">Baleares</option>
                                            <option value="Barcelona">Barcelona</option>
                                            <option value="Burgos">Burgos</option>
                                            <option value="Cáceres">Cáceres</option>
                                            <option value="Cádiz">Cádiz</option>
                                            <option value="Cantabria">Cantabria</option>
                                            <option value="Castellón">Castellón</option>
                                            <option value="Ceuta">Ceuta</option>
                                            <option value="Ciudad Real">Ciudad Real</option>
                                            <option value="Córdoba">Córdoba</option>
                                            <option value="Cuenca">Cuenca</option>
                                            <option value="Gerona/Girona">Gerona/Girona</option>
                                            <option value="Granada">Granada</option>
                                            <option value="Guadalajara">Guadalajara</option>
                                            <option value="Guipúzcoa/Gipuzkoa">Guipúzcoa/Gipuzkoa</option>
                                            <option value="Huelva">Huelva</option>
                                            <option value="Huesca">Huesca</option>
                                            <option value="Jaén">Jaén</option>
                                            <option value="La Coruña/A Coruña">La Coruña/A Coruña</option>
                                            <option value="La Rioja">La Rioja</option>
                                            <option value="Las Palmas">Las Palmas</option>
                                            <option value="León">León</option>
                                            <option value="Lérida/Lleida">Lérida/Lleida</option>
                                            <option value="Lugo">Lugo</option>
                                            <option value="Madrid">Madrid</option>
                                            <option value="Málaga">Málaga</option>
                                            <option value="Melilla">Melilla</option>
                                            <option value="Murcia">Murcia</option>
                                            <option value="Navarra">Navarra</option>
                                            <option value="Orense/Ourense">Orense/Ourense</option>
                                            <option value="Palencia">Palencia</option>
                                            <option value="Pontevedra">Pontevedra</option>
                                            <option value="Salamanca">Salamanca</option>
                                            <option value="Segovia">Segovia</option>
                                            <option value="Sevilla">Sevilla</option>
                                            <option value="Soria">Soria</option>
                                            <option value="Tarragona">Tarragona</option>
                                            <option value="Tenerife">Tenerife</option>
                                            <option value="Teruel">Teruel</option>
                                            <option value="Toledo">Toledo</option>
                                            <option value="Valencia">Valencia</option>
                                            <option value="Valladolid">Valladolid</option>
                                            <option value="Vizcaya/Bizkaia">Vizcaya/Bizkaia</option>
                                            <option value="Zamora">Zamora</option>
                                            <option value="Zaragoza">Zaragoza</option>
                                        </select>
                                        <br>
                                        <h5>Dirección</h5><input type="text" class="form-control mb-3" name="direccion" placeholder="<?php echo $row['direccion']?>" value="<?php echo $row['direccion']?>">
                                        <br>                                      
					                </div>  
			                        <div class="modal-footer justify-content-center">
                                        <input type="submit" class="btn btn-primary" value="Guardar cambios">   
				                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			                        </div>
                                </form>
		                    </div>
	                    </div>
                    </div>
                    </div>
                        <div class="col-md-8">
                            <h2 style="color:Tomato;">Perfil del cine </h2>
                            <tbody>                 
                                <br></br>
                                <h4 style="color:#5091EA;">Nombre del cine</h4>
                                <h5><?php  echo $row['nombre']?></h5>
                                <br></br>
                                <h4 style="color:#5091EA;">Provincia</h4>
                                <h5><?php  echo $row['provincia']?></h5>
                                <br></br>
                                <h4 style="color:#5091EA;">Dirección</h4>
                                <h5><?php  echo $row['direccion']?></h5>
                                <br></br>
                                <label style="font-size: 20px; color:#B91717"><?php echo $error?></label>   
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>