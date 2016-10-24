<?php
require_once '../control/actionBase.php';
require_once '../control/processVal.php';

$row = "";

$dia = date("d")+2;
$mes = date("m");
$ano = date("Y");
$horas = "";
$fechaFin = "";

$dateCaden = validateDay($dia, $mes, $ano, "future", 2);
$date = date($dateCaden);
$dateMin = date($dateCaden);

if(isset($_POST["enviar"]))
{
	$fecha = $_POST["fecha"];
	
	//devuelve un arreglo;
	$div = createOption($fecha, "");
	
	if($div[1] != "Horarios Ocupados")
		$row = $div[0];
	else 
		$div[1] = "<option value='Horarios Ocupados' disabled readonly>Horarios Ocupados</option>";
	
	$horas = $div[1];
	
	//regresa la fecha del dia; "<option value='Horarios Ocupados' disabled readonly>Horarios Ocupados</option>"
	$date = $fecha;
	$fechaFin = $fecha;
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para crear los option dependiendo del horario
function createOption($fecha, $list)
{
	//variable para hora disponible
	$disponible = "";
	//arreglo para hora usada
	$horaUsada = array();
	//horarios del sistema
	$horario = horario();

	$horaUsada = extractColumnForTable("hora", "citas", "where fecha like '".$fecha."'");

	$option = "";
	$cout = 0;

	for($i = 0; count ( $horario ) > $i; $i ++)
	{
		for($b = 0; count ( $horaUsada ) > $b; $b ++)
		{
			if ($horario [$i] == $horaUsada [$b])
				$horario [$i] = "";
		}
	}

	for($a = 0; count ( $horario ) > $a; $a ++)
		if ($horario [$a] != "")
		{
			$cout ++;
			$disponible .= "<option value='$horario[$a]'>$horario[$a]</option>
			";
		}

	if ($cout == 0)
		$disponible = "Horarios Ocupados";
	
	$list = listar();
	
	$array = array();
	
	$array[0] = $list;
	$array[1] = $disponible;
	
	return $array;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para listar los servicios
function listar()
{
	//arreglos para almacenar lo que arroje la base
	$id_serivice = array();
	$type = array();
	$price = array();
	//variable para almacenar el contenido html
	$html = "<div class='row' id='backgroundMore'>
				<div class='col-lg-12' id='center'>
					<br><h3>Servicio a elegir:</h3><hr>
				</div>
			</div>";
	
	$id_serivice = extractColumnForTable('clave_servicio', 'catalogo_servicios', "");
	$type = extractColumnForTable('tipo', 'catalogo_servicios', "");
	$price = extractColumnForTable('precio', 'catalogo_servicios', "");
	
	
	for($i = 0; count($id_serivice) > $i; $i++)
	{
		$com = $i % 2;
		$fondo = '';
	
		if ($com == 0) {
			$fondo = "id='back-text'";
		} else {
			$fondo = "";
		}
	
		$html .='<div  class="row" '.$fondo.'><div id="center">
				<div class="col-lg-3"></div>
				<div class="col-lg-1">'.$id_serivice[$i].'</div>
				<div class="col-lg-4">'.$type[$i].'</div>
				<div class="col-lg-1">$'.$price[$i].'</div>
				<div class="col-lg-1"><input type="checkbox" name="'.$id_serivice[$i].'" value="'.$id_serivice[$i].'"></div>
				</div>
			</div>
			';
	
	}
	//informacion del vehiculo
	$html .= "<div class='row' id='center'>
				<div class='col-lg-12' id='backgroundMore'>
					<hr>
					<h3>Informacion del Veh&iacute;culo:</h3> 
					<hr>
				</div>
			</div>
			";
	$html .= '<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-2">
					<!-- Marca -->
        			<input name="txtMarca" id="marca" title="Ingrese una marca verdadera" pattern="[A-Za-z0-9&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde ]{1,20}" type="text" class="text" 
        				placeholder="Marca" required autocomplete="on" maxlength="20" >
        				<p><label for="marca">Marca:</label></p>
				</div>
				<div class="col-lg-2">
					<!-- SubMarca -->
        			<input name="txtSubMarca" id="subMarca" title="Ingrese una submarca verdadera" pattern="[A-Za-z0-9&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde ]{1,20}" type="text" class="text" 
        				placeholder="Submarca" required autocomplete="on" maxlength="20" >
        				<p><label for="subMarca">Submarca:</label></p>
				</div>
				<div class="col-lg-2">
					<!-- modelo -->
        			<input name="txtModelo" id="modelo" title="Ingrese un modelo de 4 digitos" pattern="[0-9]{4}" type="text" class="text" 
        				placeholder="Modelo" required autocomplete="on" maxlength="4" >
        				<p><label for="modelo">Modelo:</label></p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="center">
					<br>
					<button type="submit" value="cita" name="cita">Registra tu cita</button>
				</div>
			</div>';
	
	return $html;
}

?>