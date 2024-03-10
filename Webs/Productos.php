
<?php
	
	//////////////////////CONEXION A BD////////////////////////////////

	$host="localhost";
	$usuario="root";
	$contraseña="";
	$bd="trabajopogweb";

	$conexion= new mysqli($host, $usuario, $contraseña, $bd);
	if($conexion->connect_errno)
	{
		die("Fallo de Conexión:(".$conexion ->mysqli_connect_errno().")".$conexion ->mysqli_connect_error());	
	}

	///////////////////////////VARIABLES DE CONSULTA/////////////////////////////

	error_reporting(0);

	$where="";
	$nombre=$_POST["xnombre"];
	$categoria=$_POST["xcategoria"];
	$limit=$_POST["xregistros"];

	//////////////////////////////BOTON BUSCAR//////////////////////////////////

	if (isset($_POST["buscar"])) {
		if (empty($_POST['xcategoria'])) {
			$where="where Titulo like '".$nombre."%'";
		}
		else if(empty($_POST['xnombre'])){
			$where="where CatP='".$categoria."'";
		}
		else{
			$where="where Titulo like '".$nombre."%' and CatP='".$categoria."'";
		}
	}

	///////////////////////////CONSULTA A BD//////////////////////////////////

	$categorias="SELECT *FROM p_cat";
	$productos="SELECT * FROM productos $where $limit";
	$resProductos=$conexion->query($productos);
	$resCategorias=$conexion->query($categorias);

	session_start(); 
	$_SESSION['carrito']=0;
if(isset($_SESSION['carrito'])){
$carrito_mio=$_SESSION['carrito'];
}
if(isset($_SESSION['carrito'])){
    for($i=0;$i<=count($carrito_mio)-1;$i ++){
        if(isset($carrito_mio[$i])){
        if($carrito_mio[$i]!=NULL){ 
        if(!isset($carrito_mio['cantidad'])){$carrito_mio['cantidad'] = '0';}else{ $carrito_mio['cantidad'] = $carrito_mio['cantidad'];}
        $total_cantidad = $carrito_mio['cantidad'];
    $total_cantidad ++ ;
    if(!isset($totalcantidad)){$totalcantidad = '0';}else{ $totalcantidad = $totalcantidad;}
    $totalcantidad += $total_cantidad;
    }}}
}
     if(!isset($totalcantidad)){$totalcantidad = '';}else{ $totalcantidad = $totalcantidad;}



?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Productos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="..\Styles\estilos.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!--	CATALOGO-->
<div class="catalogo">
	<br />
	<h1 align="center">Catálogo de Productos</h1>
	<section>

		<div class="formulario-filtros">
		<p><form method="post" >
		<input type="text" placeholder="Nombre..." name="xnombre">
		<select name="xcategoria">
			<option value="">Categoria</option>
			<?php
				while ($registroCategorias = $resCategorias->fetch_array(MYSQLI_BOTH)){
					echo'<option value="'.$registroCategorias['CatP'].'">'.$registroCategorias['categoria'].'</option>';
				}
			?>
		</select>
		<select name="xregistros">
			<option value="">N° de Registros</option>
			<option value="limit 3">3</option>
			<option value="limit 6">6</option>
			<option value="limit 9">9</option>
		</select>
		<button name="buscar" type="submit">Buscar</button>
		</form></p>
		</div>

		<div class="container-products" id="pro">
	<?php

    while ($registroProductos = $resProductos->fetch_array(MYSQLI_BOTH)) { 
      echo '<div class="card" id="'.$registroProductos[0].'" class="'.$registroProductos[6].'">
        <img src="../Resources/Productos/'.$registroProductos[1].'">
        <br/>
        <div class="titulo-productos">
        <h4>'.$registroProductos[2].'</h4>
        </div><div>
        <form id="formulario" name="formulario" method="post" action="cart.php">
                
                <button type="submit" class="btncart">Añadir al carrito</button>
                  <input name="ref" type="hidden" id="ref" value="mu001" />                           
                  <input name="precio" type="hidden" id="precio" value="200" />
                  <input name="titulo" type="hidden" id="titulo" value="Mueble madera moderno" />
                  <input name="cantidad" type="hidden" id="cantidad" value="2" class="pl-2" />

              </form></div>
              </div>';
		}

  ?>

	</div>
	</section>
	<form>
	</form>
</div>

<!--Redes Sociales-->

<div class="social-bar">
  <input type="checkbox" id="btn-social">
  <label for="btn-social" class="fa fa-play"></label>
    <div class="icon-social">
      <a target="_blank" href="https://www.facebook.com/Primary_components-101400045983583" class="fa fa-facebook">
        <span id="title">Facebook</span>
      </a>
      <a target="_blank" href="https://twitter.com/PryComponents" class="fa fa-twitter">
        <span id="title">Twitter</span>
      </a>
    </div>
  </div>
  
<!--Pie de Página-->

<footer class="footer">
<h2><p>Contáctanos</p></h2>
<span>Teléfono: +51 123-456-789</span><br/>
<span>Av. Grau, Prueba Lt. 999 Mz. Z. </span>
<span>Piura, Piura, Perú. </span>
<span	 id="copyright">© 2022 © Primary Components.  Todos los derechos reservados.</span>
</footer>

<!--MODAL CARRITO-->
<div class="modal fade" id="modal_cart" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mi carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
			<div class="modal-body">
				<div>
					<div class="p-2">
						<ul class="list-group mb-3">
							<?php
							if(isset($_SESSION['carrito'])){
							$total=0;
							for($i=0;$i<=count($carrito_mio)-1;$i ++){
                                if(isset($carrito_mio[$i])){
                                if($carrito_mio[$i]!=NULL){
							?>
						
                            <li class="list-group-item justify-content-between px-4">
								<div class="row" >
									<div class="col-10 p-0" style="text-align: left; color: #000000;"><h6 class="my-0">Cantidad: <?php echo $carrito_mio[$i]['cantidad'] ?> : <?php echo $carrito_mio[$i]['titulo']; ?></h6>
									</div>
									<div class="col-2 p-0"  style="text-align: right; color: #000000;" >
									<span class="text-muted"  style="text-align: right; color: #000000;"><?php echo $carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad'];    ?> €</span>
									</div>
								</div>
							</li>
							<?php
							$total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
							}
                            }
							}
							}
							?>
							<li class="list-group-item d-flex justify-content-between">
							<span  style="text-align: left; color: #000000;">Total (EUR)</span>
							<strong  style="text-align: left; color: #000000;"><?php
							if(isset($_SESSION['carrito'])){
							$total=0;
							for($i=0;$i<=count($carrito_mio)-1;$i ++){
                                if(isset($carrito_mio[$i])){
							if($carrito_mio[$i]!=NULL){ 
							$total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
                            }
							}}}
                            if(!isset($total)){$total = '0';}else{ $total = $total;}
							echo $total; ?> €</strong>
							</li>
						</ul>
					</div>
				</div>
			</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a type="button" class="btn btn-primary" href="borrarcarro.php">Vaciar carrito</a>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL CARRITO -->

<script src="https://kit.fontawesome.com/3297378b0c.js" crossorigin="anonymous"></script>
</body>
</html>