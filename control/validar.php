<?php
require_once 'processVal.php';
require_once 'actionBase.php';

if(isset($_POST['enviar']))
{
	$action = $_POST['enviar'];
	
	if($action == "login")
		sesion();
	else
	{
		if($action == "record")
			record();
		else
		{
			if($action == "recovery")
				recovery();
			else 
				message("Accion Desconocida Intente de nuevo\\nSi el problema persiste Intentelo mas tarde", '../index.html');
		}
			
	}
}
else 
	message('Accion Desconocida Intente de nuevo\\nSi el problema persiste Intentelo mas tarde', '../index.html');

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
//funcion para registro
function record()
{
	//arreglo para validaciones
	$val = array();
	
	//arreglo para datos de login
	$data = array();
	
	$val[0] = validarChar($data[0] = trim(ucwords($_POST['txtNombre'])));
	$val[1] = validarChar($data[1] = trim(ucwords($_POST['txtPaterno'])));
	$val[2] = validarChar($data[2] = trim($_POST['txtCorreo']));
	//generamos la contraseña aleatoria
	$data[3] = trim(generatePass());
	//encriptacion para la sesion
	$data[4] = md5(sha1($data[2]));
	//encriptacion para la sesion
	$data[5] = md5(sha1($data[3]));
	
	if(validacionGeneral($val) == FALSE)
	{
		if(validarCorreo($data[2]) == TRUE)
		{
			if($data[2] == checkMail($data[2]))
				message("El correo que a ingresado ya esta dado de alta en el sistema", "../record.html");
			else
			{
				if(recordUser($data) > 0)
				{
					//Titulo del mensaje
					$titulo = "Completa tu registro";
					//Mensaje
					$mensaje = createHtml($titulo, ($data[0]." ".$data[1]), "Te enviamos tu nueva contraseña, una vez en el portal,", 
								"no olvides que debes cambiarla por una personalizada.", $data[2], $data[3]);
					//cabeceras
					$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$cabeceras .= "From: Service_Machines \r\n";
					$cabeceras .= 'Reply-To: webmaster@servicemashines.esy.es';
					
					// Enviarlo
					mail($data[2], $titulo, $mensaje, $cabeceras);
					message("En breve le llegara un correo otorgandole su contraseña para que pueda iniciar sesion", "../control/redirect.php");
				}
				else 
					message("No se pudo completar su registro Intentelo de nuevo\\nSi el problema persiste intentelo mas tarde", "../record.html");
			}
		}
		else 
			message("El correo NO es Valido", "../record.html");
	}
	else
		message("Datos corruptos", "../record.html");
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para el inicio de sesion
function sesion()
{
	//arreglo para validaciones
	$val = array();
	
	//arreglo para datos de login
	$data = array();
	
	//arreglo para almacenar lo que traemos de la base de datos
	$base = array();
	
	$val[0] = validarChar($data[0] = trim($_POST['txtCorreo'])); //Correo
	$val[1] = validarChar($data[1] = trim($_POST['txtContrasena'])); //Contraseña
	//encriptacion para la sesion
	$data[2] = md5(sha1($data[0]));
	//encriptacion para la contraseña
	$data[3] = md5(sha1($data[1]));
	//variable para almacenar la validacion de la contraseña
	$password = "";
	
	if(validacionGeneral($val) == FALSE)
	{
		if(validarCorreo($data[0]) == TRUE)
		{
			//validacion para ver si la contraseña ingresada esta encriptada
			if(strlen($data[1]) >= 31)
				$password = $data[1];
			else 
				$password = $data[3];
			
			//funcion para hacer la consulta, esta retorna los mismos valores si son encontrados
			$base = login($data[2], $password);
			
			if($base[0] === $data[2] && $base[1] === $password)
			{
				//inicio de toda la sesion
				//session_start();
				session_name($data[2]);
			
				$_SESSION["tokenSM"] = $data[2];
			
				$mensaje = "Bienvenido " . ucwords(strtolower($base[2])) . " " . ucwords(strtolower($base[3]));
			
				message($mensaje, "../control/redirect.php");
			
			}
			else
				message("Usuario o contrasena invalidos", "../control/redirect.php");
		}
		else
			message("El correo NO es valido", "../control/redirect.php");
	}
	else
		message("Datos corruptos", "../control/redirect.php");
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para mandar el correo de recuperacion de contraseña
function recovery()
{
	$val = validarChar($mail = trim($_POST['txtCorreo'])); //Correo
	
	if($val == FALSE)
	{
		if(validarCorreo($mail) == TRUE)
		{
			$data = extractPass($mail);
			
			if($data[0] != "")
			{
				//Titulo del mensaje
				$titulo = "Recuperacion de Contraseña";
				//mensaje
				$mensaje = createHtml($titulo, ($data[1]. ' ' .$data[2]), "Te enviamos tu nueva contraseña, una vez en el portal,", 
							"no olvides que debes cambiarla por una personalizada.", $data[3], $data[0]);
				//cabeceras
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$cabeceras .= "From: Service_Machines \r\n";
				$cabeceras .= 'Reply-To: webmaster@servicemashines.esy.es';
				
				// Enviarlo
				mail($mail, $titulo, $mensaje, $cabeceras);
				
				message("En breve le llegara el correo", "redirect.php");
			}
			else 
				message("El correo que ingreso no esta dado de alta en el sistema", "../recoveryPass.html");
		}
		else 
			message("El correo NO es valido", "../recoveryPass.html");
	}
	else 
		message("Datos corruptos", "../recoveryPass.html");
}

?>
