<?php
	require_once '../control/actionUser.php';
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
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Font Awesome  -->
<link href="../css/font-awesome.min.css" rel="stylesheet">
<!-- Web Font  -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900'
	rel='stylesheet' type='text/css'>
<!-- Custom CSS -->
<link href="../css/style.css" rel="stylesheet" type="text/css"
	media="all" />
<script src="../js/jquery.min.js"></script>

</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.html"><i class="imgLogo"></i></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../index.html">Inicio</a></li>
					<li><a href="../about.html">Conócenos !</a></li>
					<li><a href="../services.html">Servicios</a></li>
					<li><a href="../contact.html">Contactanos...</a></li>
					<li><a href="../control/redirect.php"><?php echo @$data[7];?></a></li>
					<li><a href="../control/salir.php">Salir</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- end navbar -->
	<div id="section_header">
		<div class="container">
			<h2>
				<span>Genrador de </span>codigo QR
			</h2>
		</div>
	</div>
	<div data-role="content">
		<div class="row" id="back-text">
			<div class="col-lg-8" id="center">
				<form>
				<br>
					<textarea name="$codigoHTML" id="$codigoHTML"></textarea>
					<br>
					<p>El codigo saldra del lado derecho al darle clic en el boton de 'GENERAR'</p>
					<br> <input type="button" class="btn" value="Generar" onclick="update_qrcode()"> 
					<a href="consultAppointment.php"> 
						<input type="button" class="btn" value="Regresar">
					</a>
				</form>
				<br>
			</div>
			<div class="col-lg-4">
				<div id="qr"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<br>
				<br>
				<br>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<div id="footerwrap">
		<div class="container">
			<div class="row">
				<div class="col-md-8" id="diwa">
					<span class="copyright">Copyright<sup>&copy;</sup> 2015 Service
						Machines. Design by <a href="#diwa" rel="nofollow">D.I.W.A</a></span>
				</div>
				<div class="col-md-4">
					<ul class="list-inline social-buttons">
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!-- Generador de Codigo QR JavaScript -->
	<script type="text/javascript" src="../js/qr.js"></script>
</body>
</html>