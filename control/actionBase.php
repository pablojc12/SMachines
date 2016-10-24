<?php
require_once 'conexion.php';
require_once 'processVal.php';
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// funcion para actualizar lo datos del usuario
function actionUpdateUser($cap)
{
	$link = conexion();
	
	//$cap[0] = Correo
	//$cap[1] = Nombre
	//$cap[2] = Apellido Paterno
	//$cap[3] = Apellido Materno
	//$cap[4] = Telefono
	//$cap[5] = Direccion
	
	$queryActualiza = "update clientes set nombre=UPPER('$cap[1]'),ap_paterno=UPPER('$cap[2]'),
		ap_materno=UPPER('$cap[3]'), telefono='$cap[4]', direccion=UPPER('$cap[5]') 
		where correo='$cap[0]'";
	$resultActualiza = mysqli_query($link, $queryActualiza);
	
	$resultSet = mysqli_affected_rows($link);
	
	mysqli_close($link);
	
	return $resultSet; 
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para actulizar la contraseña
function actionUpdatePass($cap)
{
	//$cap = contrasena01
	$link = conexion();
	
	$sesion = $_SESSION["tokenSM"];

	$queryActualiza = "update clientes set contrasena='$cap'
		where sesion like '$sesion'";
	$resultActualiza = mysqli_query($link, $queryActualiza);
	
	$resultSet = mysqli_affected_rows($link);
	
	mysqli_close($link);
	
	return $resultSet;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion que trae los datos de la base para mostrarlos en base al correo(Pantalla de usuario)
function user()
{
	$link = conexion();
	$arreglo = array();
	
	$sesion = $_SESSION["tokenSM"];
	
	$query = "select id_cliente, correo, nombre, ap_paterno, ap_materno, telefono, direccion from clientes where sesion like '$sesion'";
	$result = mysqli_query($link, $query);
	
	$arreglo = mysqli_fetch_array($result);
	/* Estos valores cambian dependiendo de como esten dentro de la base de datos
	 * 
	 * id $arreglo[0]; 
	 * correo $arreglo[1]; 
	 * nombre $arreglo[2]; 
	 * paterno $arreglo[3]; 
	 * materno $arreglo[4]; 
	 * telefono $arreglo[5]; 
	 * direccion $arreglo[6];  
	*/
	//message($arreglo[7], "");
	
	$nombre = explode(" ", $arreglo[2]);
	$arreglo[7] = @$nombre[0] . ' ' . $arreglo[3]; //Bienvenida
	
	mysqli_close($link);
	
	return $arreglo;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para login del sistema
function login($sesion, $password)
{
	$link = conexion();
	
	//areglo de retorno para los valores dados de la base
	$val = array();
	
	$query = "select sesion, contrasena, nombre, ap_paterno from clientes where sesion like '$sesion' and contrasena like '$password'";
	
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);
	
	$val[0] = trim($base[0]); //sesion
	$val[1] = trim($base[1]); //contraseña
	$val[2] = trim($base[2]); //nombre
	$val[3] = trim($base[3]); //apellido paterno
	
	mysqli_close($link);
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//@funcion para extraer el correo de la base 
function checkMail($mail)
{
	$link = conexion();
	
	$query = "select correo from clientes where correo like '$mail'";
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);
	
	$val = trim($base[0]);
	
	mysqli_close($link);
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para registrar al usuario
function recordUser($data)
{
	/*$data = array()
	 * 
	 * $data[0] = Nombre
	 * $data[1] = Apelido paterno
	 * $data[2] = Correo
	 * $data[3] = Contraseña generada
	 * $data[4] = Sesion
	 * $data[5] = Encriptacion de la contraseña
	 */
	$link = conexion();
	
	for($i = 0; count($data)>$i ; $i++)
		$data[$i] = utf8_decode($data[$i]);
	
	$query = "insert into clientes(nombre,ap_paterno,correo,contrasena,sesion)
			values('$data[0]','$data[1]','$data[2]','$data[5]','$data[4]')";
	$result = mysqli_query($link, $query);
	
	$resultSet = mysqli_affected_rows($link);
	
	mysqli_close($link);
	
	return $resultSet;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para extraer la contraseña
function extractPass($mail)
{
	$link = conexion();
	
	$query = "select contrasena, nombre, ap_paterno, correo from clientes where correo like '$mail'";
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);
	
	$val = array();
	
	$val[0] = trim($base[0]);//contrasea
	$val[1] = trim($base[1]);//nombre
	$val[2] = trim($base[2]);//apellido paterno
	$val[3] = trim($base[3]);//correo (Usuario)
	
	mysqli_close($link);
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para extraer el nombre del usuario y correo en base a la sesion abierta
function extractNameAndMail()
{
	$link = conexion();
	
	$sesion = $_SESSION["tokenSM"];
	
	$query = "select nombre, ap_paterno, correo from clientes where sesion like '$sesion'";
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);
	
	$val = array();
	
	$val[0] = trim($base[0]);//nombre
	$val[1] = trim($base[1]);//apellido paterno
	$val[2] = trim($base[2]);//correo
	
	mysqli_close($link);
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para extraer todos los datos de su columna dependiendo de la tabla ingresada
function extractColumnForTable($column, $table, $where)
{
	$link = conexion();

	$query = "select $column from $table $where";
	$result = mysqli_query($link, $query);

	$rows = mysqli_num_rows ($result);

	$val = array();

	if ($rows > 0)
	{
		$count = 0;

		while ( $row = mysqli_fetch_array ($result))
		{
			$val[$count] = $row[$column];
			$count ++;
		}
	}

	mysqli_close($link);

	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para hacer el registro de las citas
function insertCita($cap)
{
	$link = conexion();
	
	$query = "insert into citas(marca,modelo,submarca,fecha,hora,total_pagar,id_cliente)
	values('$cap[0]','$cap[1]','$cap[2]','$cap[3]','$cap[4]','$cap[5]','$cap[6]')";
	$result = mysqli_query($link, $query);
	
	$resultSet = mysqli_affected_rows($link);
	
	mysqli_close($link);
	
	return $resultSet;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para hacer el registro de las citas en la tabla de detalle de servicio
function insertDetalleServicio($numCita, $claveServicio)
{
	$link = conexion();
	
	$query = "insert into detalle_servicios(numero_cita,clave_servicio)
	values('$numCita','$claveServicio')";
	$result = mysqli_query($link, $query);
	
	$resultSet = mysqli_affected_rows($link);
	
	mysqli_close($link);
	
	return $resultSet;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para consultar el id de la cita
function extractIdCita($hora, $fecha)
{
	$link = conexion();
	
	$query = "select numero_cita from citas where fecha like '$fecha' and hora like '$hora' ";
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);
	
	$val = $base[0];
	
	mysqli_close($link);
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para consultar el tipo ser servicio
function extractTypeService($idServicio)
{
	$link = conexion();

	$query = "select tipo from catalogo_servicios where clave_servicio like '$idServicio'";
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);

	$val = $base[0];

	mysqli_close($link);

	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para consultar fecha hora y total de las citas
function extractDataCita($idCita)
{
	$link = conexion();

	$query = "select fecha, hora, total_pagar from citas where numero_cita = '$idCita'";
	$result = mysqli_query($link, $query);
	$base = mysqli_fetch_array($result);

	$val[0] = $base[0];//fecha
	$val[1] = $base[1];//hora
	$val[2] = $base[2];//total a pagar
	
	mysqli_close($link);
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para borrar filas
function deleteFile($id, $tabla, $where)
{
	$link = conexion();
	
	$query = "delete from $tabla where $where = '$id'";
	$result = mysqli_query($link, $query);
	
	$resultSet = mysqli_affected_rows($link);
	
	mysqli_close($link);
	
	return $resultSet;
}

?>














