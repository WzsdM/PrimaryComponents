 
<?php
  

  session_start();

  $usuario=$_SESSION['username'];

  if (!isset($usuario)) {
  	header("location: Login.php");
  }


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="http://localhost/PrimaryComponents/Styles/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>
<body class="body-user">
<?php
  echo '
      <div class="title-user">
        <h1>Bienvenido &nbsp; &nbsp;</h1>
        <h2>'.$_SESSION['username'].'</h2>
      </div>';

?>
<div class="cont-salir" align="center"><a href="..\Webs\Conexion\salir.php" class="salir">SALIR</a></div>
<!--<div class="cont-salir" align="center"><a href="..\Webs\Conexion\procesar_eliminar.php" id="<?php/// echo $_SESSION['username'];?>" class="eliminar">ELIMINAR CUENTA</a></div>-->

<script type="text/javascript" src="..\Scripts\confirmacion.js"></script>

</body>
</html>