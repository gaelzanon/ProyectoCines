<!-- Muestra el resultado de la encuesta de cada cine -->
<?php

$con=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$user=$_SESSION['nombre_usuario'];

    if($_SESSION['tipo_usuario'] != "Cine") {
		header('Location:../../index.html'); 
	}

$query = "SELECT * FROM encuesta where id='$user'";
$result = pg_query($con,$query);
$cantidad = pg_num_rows($result);
$row = pg_fetch_array($result);

$total = $row[10]; //total de votos de la encuesta

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <link href="../../static/css/estilos.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Encuestas</title>
    
    </head>

<body class="fondo">
	<div class="topnav">
        <div class="topnav navbar-expand-lg">
            <ul class="nav navbar-nav">
		        <li><a href="../../php/cine/menuCine.php"><i class="fa fa-home"></i> Home</a></li>
		        <li><a href="../../php/cartelera/cartelera.php">Cartelera</a></li>
		        <li><a href="../../php/descuento/descuento.php">Ofertas</a></li>
		        <li><a class="active" href="../../php/cine/encuesta.php">Encuestas</a></li>
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
    <?php 
        if($cantidad == 0) { 
            Header("Location: encuesta.php"); 
        } 
    ?>
    <center>
        <font size="8" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
            <br></br>
            <strong> Resultados de la encuesta<br>
            <?php echo $row["nombre"] ?></strong>
        </font> 
        <br>
        <br>
        <?php 
            if($total > 0) {
        ?>
        <table width="500" border="0" cellpadding="2" cellspacing="2" bgcolor="#180202">
            <tr>
                <td width="91">
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row["opcion1"]?></font>
                </td>
                <td width="299">
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo round($row["reslt1"]*100/$row["total"],1)?> %</font>
                    <br>
                    <img height="5" width="<?php echo $row["reslt1"]*100/$row["total"]?>%" src="../../imagenes/barra1.gif" />
                </td>
                <td width="98">
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b><?php echo $row["reslt1"]?></b> votos</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row["opcion2"]?></font>
                </td>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo round($row["reslt2"]*100/$row["total"],1)?> %</font>
                    <br>
                    <img height="5" width="<?php echo $row["reslt2"]*100/$row["total"]?>%" src="../../imagenes/barra2.gif" />
                    </td>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b><?php echo $row["reslt2"]?></b> votos</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row["opcion3"]?></font>
                </td>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo round($row["reslt3"]*100/$row["total"],1)?> %</font>
                    <br>
                    <img height="5" width="<?php echo $row["reslt3"]*100/$row["total"]?>%" src="../../imagenes/barra3.gif" />
                </td>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b><?php echo $row["reslt3"]?></b> votos</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row["opcion4"]?></font>
                </td>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><?php echo round($row["reslt4"]*100/$row["total"],1)?> %</font>
                    <br>
                    <img height="5" width="<?php echo $row["reslt4"]*100/$row["total"]?>%" src="../../imagenes/barra4.gif" />
                </td>
                <td>
                    <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b><?php echo $row["reslt4"]?></b> votos</font>
                </td>
            </tr>
        </table>
        <?php
            }
        ?>
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        Total de votos: <b><?php echo $row["total"]?></b></font>

        <form action="eliminarEncuesta.php" method="POST">
                <br>
            <input type="submit" class="btn btn-danger" value="Finalizar encuesta">    
        </form>
    </center>
</body> 
</html>  