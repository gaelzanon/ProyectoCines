<?php 

    $con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

    session_start();
    $user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Administrador") {
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="../../static/css/estilos.css" rel="stylesheet" type="text/css">
	        	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<title>Registrar Cine</title>
</head>
<body class="fondo">
	    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/administrador.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a class="active" href="../../php/cine/list.php">Cines</a></li>
					<li><a href="../../php/espectador/list.php">Usuarios</a></li>
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

	<div class="container">
		<div class="text-center caja-login">

			<p class="formulario-login-cabecera-fuente">Cines<span style="color:red;">Castell??n</span></p>

			<div class="formulario-login">
                <div class="container">

				<form action="registro.php" method="POST">

					<div class="formulario-login-cabecera">

						<p class="formulario-login-cabecera-fuente">Registrar Cine</p>


					</div>
					<div class="login-elements">

						<input type="text" class="form-control" name="user" placeholder="Usuario" required />

					</div>
					<div class="login-elements">

						<input type="password" class="form-control" name="pass" placeholder="Contrase??a" required />

					</div>
					<div class="login-elements">

						<select required name="provincia" class="form-control">
                            <option value="">Elige Provincia</option>
                            <option value="??lava/Araba">??lava/Araba</option>
                            <option value="Albacete">Albacete</option>
                            <option value="Alicante">Alicante</option>
                            <option value="Almer??a">Almer??a</option>
                            <option value="Asturias">Asturias</option>
                            <option value="??vila">??vila</option>
                            <option value="Badajoz">Badajoz</option>
                            <option value="Baleares">Baleares</option>
                            <option value="Barcelona">Barcelona</option>
                            <option value="Burgos">Burgos</option>
                            <option value="C??ceres">C??ceres</option>
                            <option value="C??diz">C??diz</option>
                            <option value="Cantabria">Cantabria</option>
                            <option value="Castell??n">Castell??n</option>
                            <option value="Ceuta">Ceuta</option>
                            <option value="Ciudad Real">Ciudad Real</option>
                            <option value="C??rdoba">C??rdoba</option>
                            <option value="Cuenca">Cuenca</option>
                            <option value="Gerona/Girona">Gerona/Girona</option>
                            <option value="Granada">Granada</option>
                            <option value="Guadalajara">Guadalajara</option>
                            <option value="Guip??zcoa/Gipuzkoa">Guip??zcoa/Gipuzkoa</option>
                            <option value="Huelva">Huelva</option>
                            <option value="Huesca">Huesca</option>
                            <option value="Ja??n">Ja??n</option>
                            <option value="La Coru??a/A Coru??a">La Coru??a/A Coru??a</option>
                            <option value="La Rioja">La Rioja</option>
                            <option value="Las Palmas">Las Palmas</option>
                            <option value="Le??n">Le??n</option>
                            <option value="L??rida/Lleida">L??rida/Lleida</option>
                            <option value="Lugo">Lugo</option>
                            <option value="Madrid">Madrid</option>
                            <option value="M??laga">M??laga</option>
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

					</div>
					<div class="login-elements">

						<input type="text" class="form-control" name="direccion" placeholder="Direcci??n del Cine" required />

					</div>
                    <div class="login-elements">

						<label style="color:#B91717"><?php echo $error?></label>

					</div>
					<div class="login-elements">

                        <a href="list.php" class="btn btn-dark">Volver</a>
						<input type="submit" name="entrar" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Registrar">

					</div>


				</form>

                </div>
			</div>


		</div>


	</div>

</html>