
<!-- Actualiza la encuesta del cine y la muestra actualizada -->

<?php

$conexion=pg_connect("host='localhost'  port=5433 dbname='test' user='postgres' password='admin'");

session_start();
$cine=$_SESSION['cinema'];
$user=$_SESSION['nombre_usuario'];

	if($_SESSION['tipo_usuario'] != "Espectador") {
		header('Location:../../index.html');
	}

    $mensaje='';

$query = "SELECT * FROM encuesta where id='$cine'";
$result = pg_query($conexion,$query);
$row = pg_fetch_array($result);

$voto 	= $_POST["voto"];
$votos = $row['votos'];
//$usuarios=implode(", ", $votos);
if (strpos($votos, $user) === false) {
    if ($row['total']>0) {
        $SQLquery = "UPDATE encuesta SET reslt$voto = reslt$voto+1, total = total+1, votos = concat('$votos', ', ', '$user') where id='$cine'";
    } else {
        $SQLquery = "UPDATE encuesta SET reslt$voto = reslt$voto+1, total = total+1, votos = '$user' where id='$cine'";
    }
    $query1 = pg_query($conexion,$SQLquery);
} else {
    $mensaje="*Ya has votado en esta encuesta previamente.";
}

$result = pg_query($conexion,$query);
$cantidad=pg_num_rows($result);
$row = pg_fetch_array($result);

/* 
A continuaci�n mostramos los datos con "$row"
donde "0" es el ID, "1" el titulo y del 2 al 5
los nombres de la encuesta
Es importante mostrar el ID de la encuesta
para identificar a que encuesta se esta promediando
 */
?>
<!-- Muestra el resultado de la encuesta de cada cine -->

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        <title>Encuestas</title>
    
    </head>

<body class="fondo">
    <div class="topnav">
	        <div class="topnav navbar-expand-lg">
                <ul class="nav navbar-nav">
		            <li><a href="../../php/espectador/menu.php"><i class="fa fa-home"></i> Home</a></li>
		            <li><a href="../../php/espectador/cartelera.php">Cartelera</a></li>
		            <li><a href="../../php/entrada/list.php">Entradas</a></li>
	                <li><a href="../../php/espectador/buscarEncuesta.php">Votar Encuesta</a></li>
                </ul>
            </div>
	        <div class="topnav-right">
                <a class="nav-link dropdown-toggle active" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user ?></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../../php/espectador/perfil.php">Perfil</a>
                    <a class="dropdown-item" href="../../index.html">Cerrar Sesion</a>
                </div>
	        </div>
        </div>
    <?php
        if(0 < $cantidad){
    ?>

    <center>
        <font size="7" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
            <br>
            <strong> Resultados actuales de la encuesta<br>
            <?php echo $row["nombre"] ?></strong></font> <br><br>
            <label style="color:#B91717; text-align:center; font-size:20px;"><?php echo $mensaje?></label>
            <br></br>
            <table width="900" border="0" cellpadding="2" cellspacing="2" bgcolor="#180202">
            <tr>
            <td width="91"><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $row["opcion1"]?>
        </font></td>
        <td width="299">
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo round($row["reslt1"]*100/$row["total"],1)?> %
        </font><br>
        <img height="5" width="<?php echo $row["reslt1"]*100/$row["total"]?>%" src="../../imagenes/barra1.gif" />
        </td>
        <td width="98"><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <b><?php echo $row["reslt1"]?>
        </b> votos</font></td>
        </tr>
        <tr>
        <td><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $row["opcion2"]?></font>
        </td>
        <td>
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo round($row["reslt2"]*100/$row["total"],1)?> %
        </font><br><img height="5" width="<?php echo $row["reslt2"]*100/$row["total"]?>%" src="../../imagenes/barra2.gif" /></td>
        <td><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b>
        <?php echo $row["reslt2"]?>
        </b> votos</font></td>
        </tr>
        <tr>
        <td><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $row["opcion3"]?></font></td>
        <td>
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo round($row["reslt3"]*100/$row["total"],1)?> %
        </font><br>
        <img height="5" width="<?php echo $row["reslt3"]*100/$row["total"]?>%" src="../../imagenes/barra3.gif" /></td>
        <td>
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b>
        <?php echo $row["reslt3"]?>
        </b> votos</font></td>
        </tr>
        <tr>
        <td><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $row["opcion4"]?></font></td>
        <td>
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo round($row["reslt4"]*100/$row["total"],1)?> %</font><br>
        <img height="5" width="<?php echo $row["reslt4"]*100/$row["total"]?>%" src="../../imagenes/barra4.gif" /></td>
        <td><font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif"><b>
        <?php echo $row["reslt4"]?>
        </b> votos</font></td>
        </tr>
        </table>
        <font size="5" style="color:white;" face="Verdana, Arial, Helvetica, sans-serif">
        Total de votos: <b><?php echo $row["total"]?></b></font>

        <form action="../../php/espectador/buscarEncuesta.php" method="POST">
             <br>
            <input type="submit" class="btn btn-danger" value="Volver al menú">    
        </form>

    </center>
    <?php
        }else{
            echo "<script>if(confirm('En estos momentos no hay ninguna encuesta activa,¿Quieres continuar ?')){
                document.location='../../html/cine/cine.html';
            }</script>";
        };
    ?> 
    
   </body>
    
</html>  