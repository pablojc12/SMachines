<?php
require_once 'conexion.php';
require_once 'processVal.php';

if(isset($_SESSION["tokenSM"]))
{
	//message($_SESSION["tokenSM"] , "");
	echo "<script>window.location.replace('../acount/user.php');</script>";
}else {
	echo "<script>window.location.replace('../login.html');</script>";
}
?>