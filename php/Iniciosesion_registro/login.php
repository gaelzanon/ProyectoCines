<?php
	
	$con=pg_connect("host=localhost  port=5433 dbname=test user=postgres password=admin");

	session_start();

	$query1=("SELECT * FROM usuario WHERE tipousuario = 'Administrador'");
	$consulta1=pg_query($con,$query1);
	$cantidad1=pg_num_rows($consulta1);

	if($cantidad1==0){
        $sql1="insert into usuario values('ADMINISTRADOR','123','Administrador')";
        pg_query($con,$sql1);
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
	
	<title>Login de usuario</title>
</head>
<body class="fondo">
	<div class="container">
		<div class="text-center caja-login">

			<p class="formulario-login-cabecera-fuente">Cines<span style="color:red;">Castellón</span></p>

			<div class="formulario-login">

				<form action="sesion.php" method="POST">

					<div class="formulario-login-cabecera">

						<p class="formulario-login-cabecera-fuente">Ingreso de usuario</p>


					</div>
					<div class="login-elements">

						<input type="text" name="user" placeholder="Usuario" required/>

					</div>
					<div class="login-elements">

						<input type="password" name="pass" placeholder="Contraseña" required/>

					</div>
					<div class="login-elements">

						<label style="color:#B91717"><?php echo $error?></label>

					</div>
					<div class="login-elements">

						<a href="../../index.html" class="btn btn-dark">Volver</a>
						<input type="submit" name="entrar" class="btn btn-light" style="background-color:#3077BD; color:white;" value="Entrar">

					</div>


				</form>


			</div>


		</div>


	</div>

	

	</html>