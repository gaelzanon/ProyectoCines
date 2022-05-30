<?php
	
	$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

	session_start();

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
	<title>Registro de usuario</title>
</head>
<body class="fondo">
	<div class="container">
		<div class="text-center caja-login">
			<p class="formulario-login-cabecera-fuente">Cines<span style="color:red;">Castellón</span></p>
			<div class="formulario-login">
                <div class="container">
				    <form action="registro.php" method="POST">
					    <div class="formulario-login-cabecera">
						    <p class="formulario-login-cabecera-fuente">Registro de usuario</p>
					    </div>
					    <div class="login-elements">
						    <input type="text" name="usuario" class="form-control" placeholder="Usuario" required />
					    </div>
					    <div class="login-elements">
						    <input type="password" name="pass" class="form-control" placeholder="Contraseña" required />
					    </div>
					    <div class="login-elements">
						    <select required name="provincia" class="form-control">
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
					    </div>
					    <div class="login-elements">
							<span style="color:white;">Selecciona tus gustos: </span><br></br>
							<select multiple name="Gustos[]" class="form-control">
								<option value="Comedia">Comedia</option>
								<option value="Accion">Accion</option>
								<option value="Romance">Romance</option>
								<option value="Terror">Terror</option>
								<option value="Infantil">Infantil</option>
							</select><br>
					    </div>
					    <div class="login-elements">
						    <label style="color:#B91717"><?php echo $error?></label>
					    </div>
					    <div class="login-elements">
						    <a href="../../index.html" class="btn btn-dark">Volver</a>
						    <input type="submit" name="entrar" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Registrarse">
					    </div>
				    </form>
                </div>
			</div>
		</div>
	</div>
</body>
</html>