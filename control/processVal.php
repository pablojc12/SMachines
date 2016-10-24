<?php
//validaccion de los componentes del correo
function validarCorreo($correo)
{
	$bolean = FALSE;
	$arreglo = explode("@", $correo);
	$cont = count($arreglo);
	@$val = validarDominio($arreglo[1]);

	if($cont == 2 && $val == true)
		$bolean = TRUE;

	return $bolean;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//validacion de los dominios con servidor del correo
function validarDominio($arreglo)
{
	$val = FALSE;
	$sevidor = servidor();
	$dominio = dominio();

	for ($i = 0; $i < count($sevidor); $i++)
	{
		$posicionServ = strpos($arreglo, $sevidor[$i]);

		if($posicionServ !== FALSE)
		{
			for($o = 0; $o < count($dominio); $o++)
			{
				//$arr = explode(".", $arreglo);
				
				$posicionDom = strpos($arreglo, $dominio[$o]);
				
				if($posicionDom !== FALSE)
				{
					$val = true;
				}
			}
		}
	}

	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Servidores del correo soportados
function servidor()
{
	$serv = array();
	$serv [0] = "gmail.";
	$serv [1] = "outlook.";
	$serv [2] = "hotmail.";
	$serv [3] = "yahoo.";
	$serv [4] = "terra.";
	$serv [5] = "facebook.";
	$serv [6] = "amazon.";
	$serv [7] = "bing.";
	$serv [8] = "mail.";
	$serv [9] = "wiki.";
	$serv [10] = "thunderbird.";
	$serv [11] = "live.";
	$serv [12] = "prodigy.";

	return $serv;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Dominios dol correo soportados
function dominio()
{
	$dominio = array();
	$dominio [0] = "com";
	$dominio [1] = "mx";
	$dominio [2] = "info";
	$dominio [3] = "net";
	$dominio [4] = "edu";
	$dominio [5] = "gob";
	$dominio [6] = "org";
	$dominio [7] = "es";
	$dominio [8] = "eu";
	$dominio [9] = "xxx";
	$dominio [10] = "com.mx";

	return $dominio;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//validacion de la contraseña en cuestion al tamaño
function validacionContra($contrasena)
{
	$conteo = strlen($contrasena);
	$val = FALSE;

	if($conteo >= 8)
		$val = TRUE;

	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//validacion de dos campos en cuestion de datos
function validateTwoFields($cap1, $cap2)
{
	$val = FALSE;
	
	if($cap1 === $cap2)
		$val = TRUE;
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//caracteres no adminitos en los campos
function charNotAdmit()
{
	$dato = array();
	$dato [0] = "!";
	$dato [1] = "|";
	$dato [2] = "°";
	$dato [3] = "¬";
	$dato [4] = "<";
	$dato [5] = "$";
	$dato [6] = "%";
	$dato [7] = "&";
	$dato [8] = "/";
	$dato [9] = "(";
	$dato [10] = ")";
	$dato [11] = "=";
	$dato [12] = "?";
	$dato [13] = "*";
	$dato [14] = "¡";
	$dato [15] = "¿";
	$dato [16] = "{";
	$dato [17] = "}";
	$dato [18] = "[";
	$dato [19] = "]";
	$dato [20] = ":";
	$dato [21] = ";";
	$dato [22] = "+";
	$dato [23] = "~";
	$dato [24] = ">";
	
	return $dato;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//validacion de una cadena 
function validarChar($elDato)
{
	$val = FALSE;
	$dato = charNotAdmit();
	
	for($i = 0; $i < count($dato); $i++)
	{
		$posicion = strpos($elDato, $dato[$i]);
		
		if($posicion !== FALSE)
			$val = TRUE;
	}
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Numeros no admitidos
function numberNotAdmited()
{
	$dato = array();
	$dato[0] = "1";
	$dato[1] = "2";
	$dato[2] = "3";
	$dato[3] = "4";
	$dato[4] = "5";
	$dato[5] = "6";
	$dato[6] = "7";
	$dato[7] = "8";
	$dato[8] = "9";
	$dato[9] = "0";
	
	
	return $dato;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Validacion de los numeros dentro de una cadena
function validarNumber($elDato)
{
	$val = FALSE;
	$dato = numberNotAdmited();
	
	for($i = 0; $i < count($dato); $i++)
	{
		$posicion = strpos(strval($elDato), strval($dato[$i]));
		
		if($posicion !== FALSE)
			$val = TRUE;
	}
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Letras no adminitidas 
function letterNotAdmit()
{
	$dato = array();
	$dato[0] = "A";
	$dato[1] = "B";
	$dato[2] = "C";
	$dato[3] = "D";
	$dato[4] = "E";
	$dato[5] = "F";
	$dato[6] = "G";
	$dato[7] = "H";
	$dato[8] = "I";
	$dato[9] = "J";
	$dato[10] = "K";
	$dato[11] = "L";
	$dato[12] = "M";
	$dato[13] = "N";
	$dato[14] = "Ñ";
	$dato[15] = "O";
	$dato[16] = "P";
	$dato[17] = "Q";
	$dato[18] = "R";
	$dato[19] = "S";
	$dato[20] = "T";
	$dato[21] = "U";
	$dato[22] = "V";
	$dato[23] = "W";
	$dato[24] = "X";
	$dato[25] = "Y";
	$dato[26] = "Z";
	$dato[27] = "a";
	$dato[28] = "b";
	$dato[29] = "c";
	$dato[30] = "d";
	$dato[31] = "e";
	$dato[32] = "f";
	$dato[33] = "g";
	$dato[34] = "h";
	$dato[35] = "i";
	$dato[36] = "j";
	$dato[37] = "k";
	$dato[38] = "l";
	$dato[39] = "m";
	$dato[40] = "n";
	$dato[41] = "ñ";
	$dato[42] = "o";
	$dato[43] = "p";
	$dato[44] = "q";
	$dato[45] = "r";
	$dato[46] = "s";
	$dato[47] = "t";
	$dato[48] = "u";
	$dato[49] = "v";
	$dato[50] = "w";
	$dato[51] = "x";
	$dato[52] = "y";
	$dato[53] = "z";
	
	return $dato;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//validacion de letras dentro de una cadena 
function validarLetter($elDato)
{
	$val = FALSE;
	$dato = letterNotAdmit();
	
	for($i = 0; $i < count($dato); $i++)
	{
		$posicion = strpos(strval($elDato), strval($dato[$i]));
	
		if($posicion !== FALSE)
			$val = TRUE;
	}
	
	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Mensaje general con redireccionamiento
function message($cadena, $pagina){
	
	if($cadena == "" && $pagina != ""){
		echo "<script>window.location.replace('$pagina');</script>";
	}else{
		if($cadena != "" && $pagina === "")
			echo "<script language='javascript'>alert('$cadena');</script>";
		else {
			if($cadena != "" && $pagina != "")
			{
				echo "<script language='javascript'>alert('$cadena');</script>";
				echo "<script>window.location.replace('$pagina');</script>";
			}else
				echo "<script language='javascript'>alert('Parametros del mensaje vacios');</script>";
		}
	}
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Validacion general de booleanos
function validacionGeneral($dato)
{
	$val = TRUE;

	for($i = 0; $i < count($dato); $i ++)
	{
		
		if($dato[$i] == FALSE)
			$val = FALSE;
	}

	return $val;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para generar contraseñas aleatorias de 8 caracteres
function generatePass()
{
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for($i=0;$i<8;$i++)
		$cad .= substr($str,rand(0,62),1);

	return $cad;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para traer el horario de trabajo de citas
function horario()
{
	$hora = array();

	$hora[0] = "08:00 AM";
	$hora[1] = "09:00 AM";
	$hora[2] = "10:00 AM";
	$hora[3] = "11:00 AM";
	$hora[4] = "12:00 PM";
	$hora[5] = "01:00 PM";
	$hora[6] = "02:00 PM";
	$hora[7] = "03:00 PM";
	$hora[8] = "04:00 PM";
	$hora[9] = "05:00 PM";

	return $hora;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para estructurar el mensaje en tabla en html (ete html solo es para contraseña y usuario)
function createHtml($titulo, $nombre, $linea1, $linea2, $correo, $contrasena)
{
	// inicializamos la variable del mensaje
	$mensaje = '';
	
	$mensaje .= '<html><head><title>'. $titulo .'</title></head><body>';
	$mensaje .= '<table background="www.servicemachines.esy.es/images/backgroundMore.png">';
	$mensaje .= '<tr >
    				<td colspan="2">
    					<div align="center">
    						<img src="www.servicemachines.esy.es/images/logo0001.png"> <strong>Service Machines<sup>&copy;</sup></strong>
	    					<hr width="85%">
	    				</div>
    				</td>
    			</tr>';
	$mensaje .= '<tr>
    				<td colspan="2">
    					<div align="right">
    						<br>
    						Estimad@: <strong>'.$nombre.'...</strong>
    					</div>
    				</td>
    			</tr>';
	$mensaje .='<tr>	
    				<td colspan="2">
    					<div align="center">
    						<br>'.$linea1.' 
	    					<br>'.$linea2.'
    						<hr width="95%">
    						<br>
    					</div>
    				</td>
    			</tr>';
	$mensaje .= '<tr>
    				<td width="50%">
    					<div align="center">
    						Usuario:
    					</div>
						<hr width="85%">
    				</td>
    				<td >
    					<div align="center">
    						Contraseña:
    						<hr width="85%">
    					</div>
    				</td>
    			</tr>';
	$mensaje .= '<tr>
    				<td>
    					<div align="center">
    						<strong>'.$correo.'</strong>
    					</div>
    				</td>
    				<td>
    				<div align="center">
    						<strong>'.$contrasena.'</strong>
    					</div>
    				</td>
    			</tr>';
	$mensaje .= '<tr>
    				<td colspan="2">
    					<div align="center">
    						<br>
    						<br>
    						<hr width="98%">
    						Service Machines<sup>&copy;</sup> 
    						<br>S.A. DE C.V. TODOS LOS DERECHOS RESERVADOS
							<br><a href="www.servicemachines.esy.es">www.servicemachines.esy.es</a>
    					</div>
    				</td>
    			</tr>';
	$mensaje .= '</table></body></html>';
	
	return $mensaje;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//validacion de dias pasados o futuros, devuelve en formato YYYY-MM-DD  
function validateDay($diaM, $mesM, $anioM, $pastOrFuture, $dias)
{
	$pastOrFuture = strtolower($pastOrFuture);
	if(strlen($diaM) == 1)
		$diaM = "0".$diaM;
	
	$fechaNueva = $diaM. "/" .$mesM. "/" .$anioM;
	
	$count = 0;
	do
	{
		$fecha = $diaM. "/" .$mesM. "/" .$anioM;

		if(checkdate($mesM, $diaM, $anioM) == FALSE)
		{
			if($pastOrFuture == "future")
			{
				$diaM ++;
				
				if($diaM > 31)
				{
					$diaM = (-$diaM)+3;
					$mesM ++;
				}

				$dia = ($diaM + $dias);
				
				if($dia <= 9)
					$dia = "0".$dia;
				
				if(($mesM / 10) < 1)
					$mesM = "0".$mesM;
				
				$fecha = $dia. "/" .$mesM. "/" .$anioM;
			}
			else 
			{
				$diaM --;
				
				if($diaM < 1)
				{
					$diaM = 32;
					$mesM --;
				}
				
				$dia = $diaM - $dias;
				
				if($dia <= 9)
					$dia = "0".$dia;
				
				if(strlen($mesM) == 1)
					$mesM = "0".$mesM;
				
				$fecha =  $dia. "/" .$mesM. "/" .$anioM;
			}
		}
		$count ++;
	} while(checkdate($mesM, $diaM, $anioM) == FALSE);

	if($count == 0)
		$fechaNueva = $diaM. "/" .$mesM. "/" .$anioM;
	else 
	{
		$val = explode("/", $fecha);
		//$val[0] = dia;
		//$val[1] = mes;
		//$val[2] = año;
		unset($fechaNueva);
		
		$fechaNueva = $val[2] . "-" . $val[1] . "-" . $val[0];
	}
	

	return $fechaNueva;
}
?>