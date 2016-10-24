<?php
	require_once '../control/actionUser.php';
	
	/* Estos valores cambian dependiendo de como esten dentro de la base de datos
	 *
	 * id $data[0];
	 * correo $data[1];
	 * nombre $data[2];
	 * paterno $data[3];
	 * materno $data[4];
	 * telefono $data[5];
	 * direccion completa $data[6];
	 * 		calle $direccion[0];
	 * 		colonia $direccion[1];
	 * 		ciudad $ direccion[2];
	 * nombre bienvenida $data[7];
	 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SM | Cambio de Contraseña</title>
<!-- Favicon -->
<link rel="shortcut icon" href="../images/favicon.png" type="imagen.png" />
<!-- Bootstrap -->
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css'/>
<!-- Font Awesome  -->
<link href="../css/font-awesome.min.css" rel="stylesheet">
<!-- Web Font  -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<!-- Custom CSS -->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script src="../js/jquery.min.js"></script>
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="../index.html"><i class="imgLogo"></i></a></div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../index.html">Inicio</a></li>
        <li><a href="../about.html">Conócenos !</a></li>
        <li><a href="../services.html">Servicios</a></li>
        <li><a href="../contact.html">Contactanos...</a></li>
        <li class="active"><a href="../control/redirect.php"><?php echo @$data[7];?></a></li>
        <li><a href="../control/salir.php">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- end navbar -->
<div id="section_header">
  <div class="container">
    <h2><span>Cambio de </span>Contraseña</h2>
  </div>
</div>
<div class="contact" id="back-text">
  <div class="container">
  	<div class="col-md-12" id="center">
  		<div class="back-text">
  			<!-- Indicacion -->
		    <i class="important">Para que sus datos permanescan seguros la contraseña devera de contar con 8 caracteres, de los cuales 
		    tendra que contener como minimo: <br>una letra mayuscula, una letra minuscula  y un numero. 
	    	De lo contrario la contraseña no se aceptara... Gracias!</i>
	    </div>
	    <p>
  	</div>
  	<form  action="../control/actionUser.php" method="post">
    <div class="col-md-8" id="back-text">
        <div class="form_details">
        	<fieldset>
        	<!-- contrasena nueva -->
        	<input name="txtContrasena01" id="nueva" title="Ingrese su ontraseña nueva" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" class="text" 
        		placeholder="Contraseña nueva" onfocus="this.value='';" autofocus required autocomplete="off" maxlength="20" value="">
        		<p><label for="nueva">Contraseña nueva</label></p>
        	<!-- repetir contrasena nueva  -->
        	<input name="txtContrasena02" id="nuevaR" title="Repita su ontraseña nueva" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" class="text" 
        		placeholder="Repita su contraseña neva" onfocus="this.value='';" required autocomplete="off" maxlength="20" value="">
        	<p><label for="nuevaR">Repita su contraseña nueva</label></p>
       		</fieldset>
        </div>
    </div>
    <div class="col-md-4" >
    	<div class="form_details">    	 
	       	<div class="center" id="back-text">
	       		<fieldset>
	       			<br>
	       			<!-- Botones -->
    	    		<button type="submit" value="actualizarC" name="contrasena">Actualizar Contraseña</button>
    	    		<!-- Politicas de privacidad -->
    				<div class="clearfix" id="center">
        				<a class="link" href="politicasDePrivacidad.pdf"><img src="../images/llave.png"> Consultar politicas de privacidad</a>
       				</div>
        		</fieldset>
	        </div>
        </div>
    </div>
    <div class="col-md-12">
    	
    	<br><hr><br>
    </div>
    </form>
  </div>
  <div class="container">
  	<div class="row" id="text">
  		<div class="col-lg-6">
	    	<br>
    		<a href="../politicasDePrivacidad.pdf" ><img class="img-responsive" src="../images/smPrivacy.png"></a>
    	</div>
    	<div class="col-lg-6">
    		<br>
 	   		<h3>USO QUE HACEMOS DE LA INFORMACION:</h3>
			<p>Para suministrar un excelente servicio y para que los usuarios puedan realizar operaciones en forma ágil y segura, SERVICE MACHINES© requiere cierta información de carácter personal, incluyendo dirección de e-mail. La recolección de información nos permite ofrecer a los usuarios servicios y funcionalidades que se adecuen mejor a sus necesidades y personalizar nuestros servicios para hacer que sus experiencias con SERVICE MACHINES© sean lo más cómodas posible.</p>
    		<br>
    	</div>
    </div>
   </div>
</div>
<!-- Footer -->
<div id="footerwrap">
  <div class="container">
    <div class="row">
      <div class="col-md-8" id="diwa"> <span class="copyright">Copyright<sup>&copy;</sup> 2015 Service Machines. Design by <a href="#diwa" rel="nofollow">D.I.W.A</a></span> </div>
      <div class="col-md-4">
        <ul class="list-inline social-buttons">
          <li><a href="#"><i class="fa fa-twitter"></i></a> </li>
          <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a> </li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript --> 
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>
