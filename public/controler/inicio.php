<?php
    ini_set("display_errors", false);
    $nombre = $_POST['nombre'];
	$password  = $_POST['password'];
	
	include('../model/Usuario.php');
	
	$miprod = new Usuario("");

    echo $miprod -> Validar($nombre,$password);
    
?>