<?php

$host='localhost';
$bd='test';
$user='postgres';
$pass='admin';

$conexion=pg_connect("host=$host  port=5433 dbname=$bd user=$user password=$pass");


?>