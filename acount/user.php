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
	 * contrase�a $data[7];
	 * nombre bienvenida $data[8];
	 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SM | Registro</title>
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
        <li class="active"><a href="../control/redirect.php"><?php echo $data[7];?></a></li>
        <li><a href="../control/salir.php">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- end navbar -->
<div id="section_header">
  <div class="container">
    <h2><span>Bienvenido</span> <?php echo @$data[7];?></h2>
  </div>
</div>
<div class="contact" id="back-text">
  <div class="container">
  	<div class="col-md-12" id="center">
  		<h4 class="back-text">Ya puede disfrutar de nuestro sistema de citas en linea.</h4>
  		<hr>
  	</div>
  	<!-- formulario -->
  	<form  action="../control/actionUser.php" method="post" name="v">
    <div class="col-md-4" id="back-text">
        <div class="form_details">
        	<fieldset>
        	<legend class="center"><?php echo @$data[7];?></legend>
        	<!-- Nombre -->
        	<input name="txtNombre" id="nombre" title="Ingrese un nombre verdadero" pattern="[A-Za-z &aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde]{1,20}" type="text" class="text" 
        		placeholder="Nombre(s)" required autocomplete="on" maxlength="30" autofocus value="<?php echo @$data[2];?>">
        	<p><label for="nombre">Nombre(s):</label></p>
        	<!-- Apellido Paterno -->
        	<input name="txtPaterno" id="paterno" title="Ingrese un apellido paterno verdadero" pattern="[A-Za-z&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde ]{1,20}" type="text" class="text" 
        		placeholder="Apellido Paterno" required autocomplete="on" maxlength="20" value="<?php echo @$data[3];?>">
        		<p><label for="paterno">Apellido Paterno:</label></p>
        	<!-- Apellido Materno -->
        	<input name="txtMaterno" id="materno" title="Ingrese un apellido materno verdadero" pattern="[A-Za-z&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde ]{1,20}" type="text" class="text" 
        		placeholder="Apellido Materno" required autocomplete="on" maxlength="20" value="<?php echo @$data[4];?>">
        	<p><label for="materno">Apellido Materno:</label></p>
        	<!-- Correo -->	
        	<input name="txtCorreo" id="correo" title="Ingrese su correo valido" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" 
        		type="email" class="text" placeholder="Correo electronico" required maxlength="40" autocomplete="off" value="<?php echo $data[1];?>" readonly="readonly">
        	<p><label for="correo">Correo Electronico:</label></p>
       		</fieldset>
        </div>
    </div>
    <div class="col-md-4" >
    	<div class="form_details">
    		<fieldset>
        	<legend class="center">Direccion</legend>
    		<!-- Calle y numero-->
        	<input name="txtCalle" id="calle" title="Ingrese Calle y numero" pattern="[A-Za-z #0-9&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde]{2,30}" type="text" class="text" 
        		placeholder="Calle y numero" required autocomplete="on" maxlength="40" value="<?php echo @$direccion[0];?>">
        	<p><label for="calle">Calle y Numero:</label></p>
        	<!-- Colonia -->
        	<input name="txtColonia" id="colonia" title="Ingrese Colonia" pattern="[A-Za-z #0-9&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde]{2,30}" type="text" class="text" 
        		placeholder="Colonia" required autocomplete="on" maxlength="30" value="<?php echo @$direccion[1];?>">
        	<p><label for="colonia">Colonia:</label></p>
        	<!-- Ciudad -->
        	<input name="txtCiudad" id="ciudad" title="Ingrese Ciudad" pattern="[A-Za-z #0-9&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde]{2,30}" type="text" class="text" 
        		placeholder="Ciudad" required autocomplete="on" maxlength="30" value="<?php echo @$direccion[2];?>">
        	<p><label for="ciudad">Ciudad:</label></p>
        	<!-- Telefono -->
        	<input name="txtTelefono" id="telefono" title="Ingrese Telefono" pattern="[A-Za-z #0-9&aacute&eacute&iacute&oacute&uacute&Aacute&Eacute&Iacute&Oacute&Uacute&Ntilde&ntilde]{2,30}" type="text" class="text" 
        		placeholder="Telefono" required autocomplete="on" maxlength="16" value="<?php echo $data[5];?>">
        	<p><label for="telefono">Telefono:</label></p>
        	<!-- Boton actualizar -->
        	<div class="center"><button type="submit" value="actualizar" name="btn">Actualizar Datos</button></div>
        	</fieldset>
        </div>
    </div>
    <div class="col-md-4" >
    	<div class="form_details">    	 
        	<!-- Botones -->
	       	<div class="center" id="back-text">
	       		<fieldset>
	       			<legend>Acciones</legend>
	       			<br>
        			<button type="submit" value="registroCita" name="btn">Registra tu Cita &raquo;</button>
        			<button type="submit" value="consultaCita" name="btn">Consulta tus Citas &raquo;</button>
        			<button type="submit" value="cambioContrasena" name="btn">Cambio de Contraseña &raquo;</button>
        		</fieldset>
	        </div>
        </div>
    </div>
    <div class="col-md-12">
    	<div class="clearfix"></div>
    	<br><hr>
    </div>
    </form>
    <!-- fin formulario -->
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