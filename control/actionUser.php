<?php
require_once 'processVal.php';
require_once 'actionBase.php';


//inicio de las invocaciones 
if(isset($_SESSION["tokenSM"]))
{
	
	//datos para enviar al formulario en base a la consulta
	$data = user();
	/* Estos valores cambian dependiendo de como esten dentro de la base de datos
	 *
	 * id $data[0];
	 * correo $data[1];
	 * nombre $data[2];
	 * paterno $data[3];
	 * materno $data[4];
	 * telefono $data[5];
	 * direccion $data[6];
	 */
	
	if(isset($_POST["btn"]))
		process($_POST["btn"]);

	if(isset($_POST["contrasena"]))
			changePass();
	
	if(isset($_POST["cita"]))
			appointmentRecord($data[0]);
			
	$direccion = array();
	$direccion[0] = "";
	$direccion[1] = "";
	$direccion[2] = "";
	
	$direccion = explode(",", $data[6]); 
	
}
else
	message("Usted No ha Iniciado sesion", "../control/redirect.php");

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Funcion general de llamadas en base a los botones
function process($action)
{

	if ($action == "actualizar")
	{
		//arreglo para captura de datos
		$cap = array();
		
		//arreglo para validaciones
		$val = array();
		
		$val[0] = validarChar(trim($cap[0] = trim($_POST['txtCorreo']))); //Correo
		$val[1] = validarChar(trim($cap[1] = strtoupper($_POST['txtNombre']))); //Nombre
		$val[2] = validarChar(trim($cap[2] = strtoupper($_POST['txtPaterno']))); //Apellido Paterno
		$val[3] = validarChar(trim($cap[3] = strtoupper($_POST['txtMaterno']))); //Apellido Materno 
		$val[4] = validarChar(trim($cap[4] = strtoupper($_POST['txtTelefono'])));	//Telefono
		$val[5] = validarChar(trim($cap[5] = (trim(strtoupper($_POST['txtCalle'])) . "," . trim(strtoupper($_POST['txtColonia'])) . "," . trim(strtoupper($_POST['txtCiudad']))))); //Direccion
		
		if(validacionGeneral($val) == FALSE)
		{
			if(validarCorreo($cap[0]) == TRUE)
			{
				if(actionUpdateUser($cap) > 0)
					message("Datos actualizados correctamente", "../control/redirect.php");
				else 
					message("Sus datos no se pudieron actualizar", "../control/redirect.php");
			}
			else 
				message("El correo NO es Valido", "../control/redirect.php");
		}
		else 
			message("Datos Corruptos", "../control/redirect.php");
	}
	else 
	{
		if ($action == "registroCita")
			message("", "../acount/appointmentRecord.php");
		else
		{
			if ($action == "consultaCita")
			{
				message("", "../acount/consultAppointment.php");
			}
			else
			{
				if($action == "cambioContrasena")
				{
					message("", "../acount/changePass.php");
				}
				else 
					message('Accion Desconocida Intente de nuevo\\nSi el problema persiste Intentelo mas tarde', '../control/redirect.php');
			}
		}
	}	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para hacer el cambio de contraseña
function changePass()
{
	//arreglo para captura de datos
	$cap = array();
	//arreglo para validaciones
	$val = array();
	//arreglo para informacion 
	@$data = array();
	/*
	 * $data[0] = nombre
	 * $data[1] = apellido paterno
	 * $data[2] = correo
	 */
	@$data = extractNameAndMail();
	
	//message($data[2], "");
	
	$val[0] = validarChar(trim($cap[0] = $_POST['txtContrasena01'])); //Contraseña
	$val[1] = validarChar(trim($cap[1] = $_POST['txtContrasena02'])); //Contraseña
	//encriptacion de contraseña
	$cap[2] = md5(sha1($cap[0]));
	
	if(validacionGeneral($val) == FALSE)
	{
		if(validateTwoFields($cap[0], $cap[1]) == TRUE)
		{
			if(actionUpdatePass($cap[2]) > 0)
			{
				//Titulo del mensaje
				$titulo = "Cambio de contraseña";
				//Mensaje
				$mensaje = createHtml($titulo, ($data[0]." ".$data[1]), "Te enviamos tu nueva contraseña,", 
							"Puedes ingresar al portal con los siguientes datos.", $data[2], $cap[0]);
				
				//cabeceras
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$cabeceras .= "From: Service_Machines \r\n";
				$cabeceras .= 'Reply-To: webmaster@servicemashines.esy.es';
				
				// Enviarlo
				mail($data[2], $titulo, $mensaje, $cabeceras);
				message("Datos actualizados correctamente", "../control/redirect.php");
			}
			else 
				message("Sus datos no se pudieron actualizar", "../control/redirect.php");
		}
		else
			message("Las contraseÃ±as no coinciden", "../acount/changePass.php");
	}
	else
		message("Datos Corruptos", "../control/redirect.php");
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para hacer el registro de citas 
function appointmentRecord($id_cliente)
{
	//arreglo para captura de datos
	$cap = array();
	//arreglo para lmacenar los indices del checked
	$indice = array();
	//arreglos para almacenar lo que arroje la base
	$id_serivice = array();
	$price = array();
	
	$cap[4] = trim($_POST["horario"]);
	$cap[3] = trim($_POST["fecha"]);
	$cap[0] = trim($_POST["txtMarca"]);
	$cap[2] = trim($_POST["txtSubMarca"]);
	$cap[1] = trim($_POST["txtModelo"]);
	$cap[6] = $id_cliente;
	$cap[5] = 0;
	
	$id_serivice = extractColumnForTable('clave_servicio', 'catalogo_servicios', "");
	$price = extractColumnForTable('precio', 'catalogo_servicios', "");
	
	//obtenemos el precio total
	for($i = 0; count($id_serivice) > $i; $i++)
	{
		if(isset($_POST[$id_serivice[$i]]))
		{
			$cap[5] += $price[$i];
			if($i == 0)
				$indice[0] = "0";
			else 
				$indice[$i] = $i;
		}
		else 
			$indice[$i] = "";
	}
	
	//retorna 
	//$base[0] = numero de la cita
	//$base[1] = resulset de la captura de la cita
	
	$insert = 0;
	$idCita = 0;
	
	if(insertCita($cap) > 0)
	{
		$idCita = extractIdCita($cap[4], $cap[3]);
		
		for($i = 0; count($id_serivice) > $i; $i++)
		{
			if($indice[$i] != "")
			{
				//message("id cita=".$idCita." id servicio".$id_serivice[$i] , "");
				$insert = insertDetalleServicio($idCita, $id_serivice[$i]);
			}
		}
		if($insert > 0)
			message("El registro de su cita se completo con exito", "../acount/ConsultAppointment.php");
		else
			message("Error al intentar registrar su cita\\nIntente de nuevo", "../acount/appointmentRecord.php");
	}
	else 
		message("Error al intentar registrar su cita\\nIntente de nuevo", "../acount/appointmentRecord.php");
	
}
?>
















