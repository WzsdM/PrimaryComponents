<?php

//conectar al servidor
$host="localhost";
$usuario="root";
$clave="";
$bd="trabajopogweb";

$conexion=mysqli_connect($host,$usuario,$clave,$bd);
if($conexion->connect_errno)
	{
		die("Fallo de Conexión:(".$conexion ->mysqli_connect_errno().")".$conexion ->mysqli_connect_error());	
	}

//recupera las variables
$nombre=$_POST['Nombre'];
$apell=$_POST['Apellidos'];
$tipoDoc=$_POST['document_type'];
$docId=$_POST['DocumentoID'];
$telef=$_POST['Teléfono'];
$correo=$_POST['correo'];
$sms=$_POST['Mensaje'];

//sql
$sql="INSERT INTO datos VALUES('$nombre', '$apell', '$tipoDoc', '$docId', '$telef', '$correo', '$sms')";
$ejecutar=mysqli_query($conexion, $sql);
if (!$ejecutar) {
	echo '<script language="javascript">alert("Ocurrió un error inesperado");</script>';
	echo('<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=Inicio.html">');
}else{
	echo (
	'<html>
	<body>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
	Swal.fire({
	popup: "swal2-show",
  	backdrop: "swal2-backdrop-show",
  	icon: "swal2-icon-show",
	text: "Su formulario fue enviado correctamente. Gracias por su mensaje.",
	icon: "success",
	confirmButtonText: "Aceptar",
	footer: "<H3>Le contestaremos a su correo en la brevedad.</H3>",
	width: "27%",
	height:"20%",
	background: "#DCE4E5",
	backdrop: true,
	timerProgressBar: true,
	timer: 2000,
	toast: true,
	position: "bottom-end",
	confirmButtonColor: "#128CF1",
			});
	</script>
	<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=Inicio.html">
	</body>
	</html>');
	
}
?>