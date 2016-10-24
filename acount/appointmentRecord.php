<?php
	require_once '../control/actionUser.php';
	require_once '../control/listServices.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SM | Registro de Citas</title>
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
					<li class="active"><a href="../control/redirect.php"><?php echo @$data[7];?></a></li>
					<li><a href="../control/salir.php">Salir</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- end navbar -->
	<div id="section_header">
		<div class="container">
			<h2>
				<span>Registro </span>de Citas
			</h2>
		</div>
	</div>
	<div class="form_details">
	<div class="container" id="back-text">
	<!-- Inicion Formulario para fechas -->
		<form action="appointmentRecord.php" method="post" name="appointmentRecord">
			<div class="row" id="center">
				<div class="col-lg-12" id="backgroundMore">
					<div id="fechaHora"></div>
					<br>
					<h3>D&iacute;a y hora:</h3>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-3">
					<input type="date" name="fecha" step="1" min="<?php echo $dateMin;?>" value="<?php echo $date;?>">
					<hr>
				</div>
				<div class="col-lg-3" id="center">
					<button type="submit" value="checkDate" name="enviar">consultar hora</button>
				</div>
			</div>
		</form>
		<form action="../control/actionUser.php" method="post" name="citas">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-2">
					<select name="horario" id="horario">
					<?php echo $horas;?>
					</select>
					<hr>
				</div>
				<div class="col-lg-8">
					<input type="hidden" value="<?php echo $fechaFin?>" name="fecha">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="center">
					<p class="important">Antes de seleccionar su servicio tendra que consultar los horarios disponibles</p>
				</div>
			</div>
			<?php echo $row;?>
		</form>
		<!-- Fin Formulario -->
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
</body>
</html>
