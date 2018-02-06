<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 02/02/2018
 * Time: 15:18
 */
require_once '../entities/Categoria.php';
require_once '../entities/Articulo.php';
require_once '../entities/Proveedor.php';
require_once '../entities/Compra.php';
require_once '../entities/DetalleCompra.php';
require_once '../dao/DAOArticulo.php';
require_once '../dao/DAOCategoria.php';
require_once '../dao/DAOCompra.php';
require_once '../dao/DAOProveedor.php';
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Inventario</title>
</head>
<body>
<div class="container">
    <nav class="text-center">
        <h1>- INVENTARIO ALTRHEEUS -</h1>
    </nav>
    <br>
    <div class="row">
        <div class="col-md-4">
<h4>Añade una categoría</h4>
<form method="POST" action="controller.php?operacion=addCategoria">
    <div>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    </div>
    <div>
        <br>
    <button class="btn btn-success" type="submit">Añadir</button>
    </div>
</form>
        </div>
        <div class="col-md-4">
<h4>Añade un articulo</h4>
<form method="POST" action="controller.php?operacion=addArticulo">
    <div>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    </div>
    <br>
    <div>
    <select name="idCategoria">
        <option>Elige una categoria</option>
		<?php
		$listaCategorias = $_SESSION['listaCategorias'];

		foreach ($listaCategorias as $key=>$categoria){
			?>
            <option value="<?php echo $key+1;?>"><?php echo $categoria->getDescripcion();?></option>
			<?php
		}
		?>

    </select>
    </div>
    <br>
    <div>
    <input type="number" name="precio" placeholder="Precio" required>
    </div><br>
    <div>
    <input type="number" name="stock" placeholder="Stock" required>
    </div><br>
    <div>
        <button class="btn btn-success" type="submit">Añadir</button>
    </div>

</form>
        </div>
        <div class="col-md-4">
<h4>Añade un proveedor</h4>
<form method="POST" action="controller.php?operacion=addProveedor">
    <div>
    <input type="text" name="razonSocial" placeholder="Razon Social" required>
    </div>
    <br>
    <div>
    <input type="text" name="direccion" placeholder="Direccion" required>
    </div>
    <br>
    <div>
    <input type="text" name="telefono" placeholder="Telefono" required>
    </div>
    <br>
    <div>
        <button class="btn btn-success" type="submit">Añadir</button>
    </div>
</form>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-md-4">
<h3>Lista de articulos</h3>

    <div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Precio</th>
    </tr>
	<?php
	$listaArticulos = $_SESSION['listaArticulos'];

	$daoCategorias = new DAOCategoria();
	foreach ($listaArticulos as $articulo){

		$categoria = $daoCategorias->categoriaId($articulo->getIdCategoria());
		?>
        <tr>
            <td><?php echo $articulo->getDescripcion();?></td>
            <td><?php echo $categoria->getDescripcion();?></td>
            <td><?php echo $articulo->getPrecio();?></td>
        </tr>
		<?php
	}
	?>

</table>
    </div>
        </div>

        <div class="col-md-4">
            <h3>Lista de Categorías</h3>

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>

                    </tr>
				    <?php
				    $listaCategorias = $_SESSION['listaCategorias'];
				    foreach ($listaCategorias as $categoria){

					    ?>
                        <tr>
                            <td><?php echo $categoria->getIdCategoria();?></td>
                            <td><?php echo $categoria->getDescripcion();?></td>
                        </tr>
					    <?php
				    }
				    ?>

                </table>
            </div>
        </div>

        <div class="col-md-4">
            <h3>Lista de Proveedores</h3>

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Razon Social</th>
                        <th>Teléfono</th>

                    </tr>
				    <?php
				    $listaProveedores = $_SESSION['listaProveedores'];
				    foreach ($listaProveedores as $proveedor){

					    ?>
                        <tr>
                            <td><?php echo $proveedor->getIdProveedor();?></td>
                            <td><?php echo $proveedor->getRazonSocial();?></td>
                            <td><?php echo $proveedor->getTelefono();?></td>
                        </tr>
					    <?php
				    }
				    ?>

                </table>
            </div>
        </div>

    </div>
<br>
    <h3 class="text-center">Compras</h3>
<br>

    <div class="row text-center">
        <div class="col-md-6">
<h4>Nueva compra</h4>
<form action="controller.php?operacion=addCompra" method="POST">
    <div>
    <select name="idArticulo">
        <option>Selecciona un artículo</option>
		<?php
		foreach ($listaArticulos as $key=>$articulo) {
			?>
            <option value="<?php echo $articulo->getIdArticulos(); ?>"><?php echo $articulo->getDescripcion();?></option>
			<?php
		}
		?>
    </select>
    </div>
    <br>
    <div>
    <select name="idProveedor">
        <option>Selecciona un proveedor</option>
		<?php
		$listaProveedores = $_SESSION['listaProveedores'];

		foreach ($listaProveedores as $key=>$proveedor){

			?>
            <option value="<?php echo $proveedor->getIdProveedor();?>"><?php echo $proveedor->getRazonSocial();?></option>
			<?php
		}
		?>

    </select>
    </div>
    <br>
    <div>
    <input type="number" name="cantidad" placeholder="Cantidad" required >
    </div><br>
    <div>
        <button class="btn btn-success" type="submit">Comprar</button>
    </div>
</form>
        </div>
        <div class="col-md-6">
    <h4>Actualizar una compra existente</h4>
    <form action="controller.php?operacion=updateCompra" method="POST">
        <div>
        <select name="idCompra">
            <option disabled>Selecciona una compra</option>
		    <?php
		    $listaCompras = $_SESSION['listaCompras'];

		    foreach ($listaCompras as $compra){

			    ?>
                <option value="<?php echo $compra->getIdCompra();?>"><?php echo "Compra ".$compra->getIdCompra();?></option>
			    <?php
		    }
		    ?>

        </select>
        </div><br>
        <div>
        <select name="idArticulo">
            <option disabled>Selecciona un artículo</option>
		    <?php
		    foreach ($listaArticulos as $key=>$articulo) {
			    ?>
                <option value="<?php echo $articulo->getIdArticulos(); ?>"><?php echo $articulo->getDescripcion();?></option>
			    <?php
		    }
		    ?>
        </select>
        </div><br>
        <div>
        <input type="number" name="cantidad" placeholder="Cantidad" required >
        </div><br>
        <div>
            <button type="submit" class="btn btn-success">Añadir</button>
        </div>
    </form>
        </div>
    </div>
<br>
<h4>Lista de compras</h4>
    <div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th>IDCompra</th>
        <th>IDProveedor</th>
        <th>Fecha</th>
        <th>Total</th>
    </tr>
	<?php
	$listaCompras = $_SESSION['listaCompras'];

	$daoProveedor = new DAOProveedor();

	foreach ($listaCompras as $compra){
		$proveedor = $daoProveedor->proveedorId($compra->getIdProveedor());
		?>
        <tr>
            <td><?php echo $compra->getIdCompra();?></td>
            <td><?php echo $proveedor->getRazonSocial();?></td>
            <td><?php echo $compra->getFecha();?></td>
            <td><?php echo $compra->getTotal();?></td>
        </tr>
		<?php
	}
	?>

</table>
    </div>

<br>
<h4>Lista de detalle de compra</h4>
    <div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th>IDDetalle</th>
        <th>IDCompra</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>
	<?php
	$listaDetalleCompra = $_SESSION['listaDetalleCompra'];


	$daoArticulo = new DAOArticulo();

	foreach ($listaDetalleCompra as $detalleCompra){

		$articulo = $daoArticulo->articuloId($detalleCompra->getIdArticulo());
		?>
        <tr>
            <td><?php echo $detalleCompra->getIdDetalle();?></td>
            <td><?php echo $detalleCompra->getIdCompra();?></td>
            <td><?php echo $articulo->getDescripcion();?></td>
            <td><?php echo $detalleCompra->getCantidad();?></td>
            <td><?php echo $detalleCompra->getPrecio();?></td>
        </tr>
		<?php
	}
	?>

</table>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
