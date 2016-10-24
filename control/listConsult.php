<?php
require_once 'actionBase.php';
require_once 'processVal.php';
//variable para el borrado visual
$borrado = "";

//llamada de los botones
if(isset($_POST["btnConsult"]))
{
	$actionAndID = explode(",", $_POST["btnConsult"]);
	$action = $actionAndID[0];
	$idServ = $actionAndID[1];
	
	if($action == "Borrar")
	{
		$borrado = preguntra($idServ);
	}
	elseif($action == "QR")
	{
		
	}
	elseif ($action == "PDF")
	{
		
	}
}
elseif (isset($_POST["confirmar"]))
{
	$valor = $_POST["confirmar"];
	
	if($valor != "no")
		deleteAppointment($valor);
		
		
}

//arreglo para traer id_cliente
$user = user(); 
$id_cliente = $user[0];
$html = "";

//arreglo para traer id de citas generadas por el usuario
$nCitas = array();

$nCitas = extractColumnForTable("numero_cita", "citas", "where id_cliente like '$id_cliente' ");

//verificamos si el arreglo que devuelve esta lleno
if(!empty($nCitas))
{
	$html = listarCitas($nCitas);
}
else 
	message("No tiene citas registradas", "../control/redirect.php");

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para listar las citas en dado caso que existan 
function listarCitas($nCitas)
{
	 //variable para crear el html 
	 $html = "";
	 
	 //ciclo para las citas
	 for($iC = 0; count($nCitas) > $iC; $iC++)
	 {
	 	//seleccion de color para cada cita
	 	$com = $iC % 2;
	 	$fondo = '';
	 	
	 	if ($com == 0) {
	 		$fondo = "id='back-text'";
	 	} else {
	 		$fondo = "";
	 	}
	 	
	 	//arreglo para id de servicios
	 	$service = array();
	 	$service = services($nCitas[$iC]);
	 	
	 	//arreglo para traer fecha hora y total a pagar
	 	$cita = array();
	 	/*Array $cita
	 	 * $cita[0] fecha
	 	 * $cita[1] hora
	 	 * $cita[2] total a pagar
	 	 */
	 	$cita = extractDataCita($nCitas[$iC]);
	 	
	 	//variable para almacenar los tipos de los servicios
	 	$tipoS = "";
	 	
	 	//ciclo para los servicios
	 	for($iS = 0; count($service) > $iS; $iS++)
	 	{
	 		$tipoS .= extractTypeService($service[$iS]) . " <br> ";
	 	}
	 	
	 	$html .= '<div class="row" '.$fondo.'>
				<div class="col-lg-1"></div>
				<!-- botones -->
				<div class="col-lg-3" id="right">
	 				<button class="btnPDF" type="submit" name="btnConsult" value="PDF,'.$nCitas[$iC].'"></button>
	 				<button class="btnQR" type="submit" name="btnConsult" value="QR,'.$nCitas[$iC].'"></button>
	 				<button class="btnBorrar" type="submit" name="btnConsult" value="Borrar,'.$nCitas[$iC].'"></button>
	 			</div>
				<!-- servicio -->
				<div class="col-lg-3">'.$tipoS.'</div>
				<!-- fecha y hora -->
				<div class="col-lg-2" id="center">
					<div class="right">
						'.$cita[0].'<br>'.$cita[1].'
					</div>
				</div>
				<!-- total a pagar -->
				<div class="col-lg-2">$ '.$cita[2].'</div>
			</div>
	 				';
	 	//borramos el arreglo para que no queden reciduos de otros servicios
	 	unset($service);
	 	unset($tipoS);
	 	unset($cita);
	 }
	 	
	 return $html;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para traer los servicios de cada cita, llegara un unico numero_cita para su extraxion
function services($nCita)
{
	//arreglo para traer los servicios de cada respectiva cita
	$service = array();
	
	//lanzamos metodo para traer los servicios de cada cita
	$service = extractColumnForTable("clave_servicio", "detalle_servicios", "where numero_cita = '$nCita'");
	
	return $service;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para agregar html
function preguntra($id)
{
	$dataCita = extractDataCita($id);
	
	$html = '<div class="container" id="borrado" >
	<form action="consultAppointment.php" method="post">
	<div class="row" >
		<div class="col-lg-4">
		</div>
		<div class="col-lg-4">
		<br>
			<strong>Est&aacute; seguro que desea borrar la cita:<br><br>&nbsp;</strong>ID: <strong>'.$id.'</strong>
			<br>&nbsp;Fecha: <strong>'.$dataCita[0].'</strong>
			<br>&nbsp;Hora: <strong>'.$dataCita[1].'</strong>
			<br>&nbsp;Total a pagar: <strong>$'.$dataCita[2].'</strong>
		</div>
		<div class="col-lg-4" id="center"><br><img  src="../images/alert.png"></div>
	</div>
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			<button id="btnBorrar" type="submit" name="confirmar" value="'.$id.'">Si</button> 
			<button id="btnCancelar" type="submit" name="confirmar" value="no">NO</button>
		</div>
		<div class="col-lg-4"></div>
	</div>
	<div class="row">
		<div class="col-lg-12"><hr></div>
	</div>
	</form>
</div>
			';
	//$val = deleteFile($id, $tabla, $where);
	
	return $html;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para borrar cita
function deleteAppointment($id)
{
	//borramos los valores de la tabla de detalle_servicios
	$check = deleteFile($id, "detalle_servicios", "numero_cita");
	
	if($check  > 0)
	{
		unset($check);
		$check = deleteFile($id, "citas", "numero_cita");
		
		if($check > 0)
			message("La cita se elimino con satisfaccion", "../acount/consultAppointment.php");
		else
			message("Error al intentar la eliminacion\\nIntentelo mas tarde", "../acount/consultAppointment.php");
	}
	else
		message("Error al intentar la eliminacion\\nIntentelo mas tarde", "../acount/consultAppointment.php");
}
?>













