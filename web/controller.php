<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 02/02/2018
 * Time: 15:16
 */
require_once '../dao/DAOCategoria.php';
require_once '../dao/DAOArticulo.php';
require_once '../dao/DAOProveedor.php';
require_once '../dao/DAOCompra.php';
require_once '../dao/DAODetalleCompra.php';
require_once '../entities/Compra.php';
require_once '../entities/DetalleCompra.php';
require_once '../entities/Proveedor.php';
require_once '../entities/Articulo.php';
require_once '../entities/Categoria.php';
session_start();



$operacion = $_REQUEST['operacion'];
$daoCategoria = new DAOCategoria();
$daoArticulo = new DAOArticulo();
$daoProveedor = new DAOProveedor();
$daoCompra = new DAOCompra();
$daoDetalleCompra = new DAODetalleCompra();

switch ($operacion){
	case "inicio":



		$listaCategorias = $daoCategoria->listaCategorias();
		$listaArticulos = $daoArticulo->listaArticulos();
		$listaProveedores = $daoProveedor->listaProveedores();
		$listaCompras = $daoCompra->listaCompras();
		$listaDetalleCompra = $daoDetalleCompra->listaDetalleCompra();

		try{
			$_SESSION['listaCategorias'] = $listaCategorias;
			$_SESSION['listaArticulos'] = $listaArticulos;
			$_SESSION['listaProveedores'] = $listaProveedores;
			$_SESSION['listaCompras'] = $listaCompras;
			$_SESSION['listaDetalleCompra'] = $listaDetalleCompra;


			header('Location: home.php');
		}catch (PDOException $e){
			header('Location: error.php');

		}




		break;
	case "addCategoria":

		$descripcion = $_REQUEST['descripcion'];
		try{
			$daoCategoria->addCategoria($descripcion);

			$_SESSION['listaCategorias'] = $daoCategoria->listaCategorias();
			header('Location: home.php');
		}catch (PDOException $e){
			header('Location error.php');
		}

		break;

	case "addArticulo":

		$descripcion = $_REQUEST['descripcion'];
		$idCategoria = $_REQUEST['idCategoria'];
		$precio = $_REQUEST['precio'];
		$stock = $_REQUEST['stock'];

		try{


			if($daoArticulo->addArticulo($idCategoria,$descripcion,$precio,$stock)){
				$_SESSION['listaArticulos'] = $daoArticulo->listaArticulos();
				header('Location: home.php');
			}else{
				header('Location: error.php');
			}


		}catch (PDOException $e){
			throw ($e);
			header('Location: error.php');
		}

		break;

	case "addCompra":
		$idArticulo = $_REQUEST['idArticulo'];
		$idProveedor = $_REQUEST['idProveedor'];
		$cantidad = $_REQUEST['cantidad'];

		try{
			$articulo = $daoArticulo->articuloId($idArticulo);

			$idCompra = $daoCompra->registerCompra($idProveedor,$articulo->getPrecio(),$cantidad);

			$stock = $articulo->getStock()+$cantidad;
			$daoArticulo->updateArticulo($idArticulo,$stock);

			if($daoDetalleCompra->registerDetalleCompra($idCompra,$articulo->getIdArticulos(),$cantidad,$articulo->getPrecio())){
				$_SESSION['listaCompras'] = $daoCompra->listaCompras();
				$_SESSION['listaDetalleCompra'] = $daoDetalleCompra->listaDetalleCompra();
				$_SESSION['listaArticulos'] = $daoArticulo->listaArticulos();
				header('Location: home.php');
			}else{
				header('Location: error.php');
			}

		}catch (PDOException $e){
			throw ($e);
		}




		break;

	case "addProveedor":

		$razonSocial = $_REQUEST['razonSocial'];
		$direccion = $_REQUEST['direccion'];
		$telefono = $_REQUEST['telefono'];

		try{
			if($daoProveedor->addProveedor($razonSocial,$direccion,$telefono)){
			header('Location: home.php');
			$_SESSION['listaProveedores'] = $daoProveedor->listaProveedores();
			}
		}catch (PDOException $e){
			throw($e);
		}
		break;

	case "updateCompra":
		$idArticulo = $_REQUEST['idArticulo'];
		$idCompra = $_REQUEST['idCompra'];
		$cantidad = $_REQUEST['cantidad'];

		try{
			$articulo = $daoArticulo->articuloId($idArticulo);
			$precioTotalActual = $daoCompra->precioTotal($idCompra);

			$precioTotal = ($cantidad*$articulo->getPrecio())+$precioTotalActual;
			$compra = new Compra();
			$compra->setIdCompra($idCompra);
			$compra->setIdProveedor($idProveedor);
			$compra->setTotal($precioTotal);


			$stock = $articulo->getStock()+$cantidad;
			$daoCompra->updateCompra($compra);
			$daoArticulo->updateArticulo($idArticulo,$stock);
			if($daoDetalleCompra->registerDetalleCompra($idCompra,$idArticulo,$cantidad,$articulo->getPrecio())){
				$_SESSION['listaCompras'] = $daoCompra->listaCompras();
				$_SESSION['listaDetalleCompra'] = $daoDetalleCompra->listaDetalleCompra();
				$_SESSION['listaArticulos'] = $daoArticulo->listaArticulos();
				header('Location: home.php');
			}else{
				header('Location: error.php');
			}

		}catch (PDOException $e){
			throw ($e);
		}




		break;
}
?>