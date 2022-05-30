<!-- Muestra la encuesta del cine -->

<?php

$conexion=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$cine=$_POST['Cine'];
$_SESSION['cinema']=$cine;
$user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

$query = "SELECT id,nombre,opcion1,opcion2,opcion3,opcion4 FROM encuesta where id = '$cine'";
$result = pg_query($conexion,$query);
$cantidad=pg_num_rows($result);
$row = pg_fetch_array($result);


?>

<html>
<head>
    <head>
        <title> ENCUESTAS </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        	<link href="../../static/css/estilos.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
</head>
<body  class="fondo">
    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a class="active" href="../../php/espectador/buscarEncuesta.php">Votar Encuesta</a></li>
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
    <?php
     if($cantidad != 0){
    ?>    
<form name="form1" method="post" action="actualizarEncuesta.php">
<input type=hidden name="id" value="<?php echo $row[0] ?>">
<br>  
<table width="900" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#180202">
 <tr>
 <td colspan="2" bgcolor="#D70E0E"><div align="center">
<font color="#FFFFFF" size="12" face="Verdana, Arial, Helvetica, sans-serif">
Encuestas </font> </div>
</td>
 </tr>
 <tr>
 <td colspan="2"><div align="center">
<font size="8" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
 <strong> <?php echo $row[1]?> </strong></font>
</div>
</td>
</tr>
<tr>
<td width="20"><input name="voto" type="radio" value="1" checked="checked" /></td><td width="272">
<font size="5" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
<?php echo $row[2]?></font></td>
</tr>
<tr>
<td><input type="radio" name="voto" value="2" /></td>
<td><font size="5" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
<?php echo $row[3]?>
</font></td>
 </tr>
  <tr> 
<td><input type="radio" name="voto" value="3" /></td>
 <td><font size="5" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
<?php echo $row[4]?> </font>
</td>
 </tr>
 <tr>
 <td><input type="radio" name="voto" value="4" /></td>
 <td><font size="5" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
<?php echo $row[5]?> </font>
</td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" name="Submit" value="Enviar" />
</div></td>
</tr>
</table>
</form>
 <?php
     }else{
        echo "<script>if(confirm('En estos momentos no hay ninguna encuesta activa de este cine,¿Quieres continuar ?')){
            document.location='../../html/cine/menu.html';
        }else{document.location='../../html/cine/encuesta.php';}</script>";
     };
 ?>  
</body>
</html>