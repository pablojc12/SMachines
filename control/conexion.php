<?php
session_start();

function conexion()
{
	$link = mysqli_connect('mysql.hostinger.mx','u346089683_smach','smachines','u346089683_smach')
	or die(error());
	
	return $link;
}

function error(){
	echo "<script language='javascript'>alert('Error de conexion en la base de datos\\nIntente mas tarde');</script>";
	echo "<script>window.location.replace('../index.html');</script>";
}
?>