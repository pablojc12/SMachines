<?php
require_once 'processVal.php';
session_start();
$_SESSION["tokenSM"] = null;
$_SESSION = array();

if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"],
	$params["secure"], $params["httponly"]
	);
}

session_destroy();

message('Gracias por utilizar nuestro servicio\\nVuelva Pronto', "../index.html");
?>