<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 05/02/2018
 * Time: 17:04
 */
require_once '../entities/DetalleCompra.php';
require_once '../conexion/Conexion.php';
class DAODetalleCompra {

	public function registerDetalleCompra($idcompra,$idarticulo,$cantidad,$precio){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();

		$sql= "INSERT INTO detallecompra (idcompra,idarticulo,cantidad,precio) VALUES ($idcompra,$idarticulo,$cantidad,$precio)";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();

		}catch (PDOException $e){

			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return true;
	}

	public function listaDetalleCompra(){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM detallecompra";

		$listaDetalleCompra= array();
		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			while ( $fila = $statement->fetch(PDO::FETCH_ASSOC)){
				$detalleCompra = new DetalleCompra();

				$detalleCompra->setIdCompra($fila['idcompra']);
				$detalleCompra->setIdDetalle($fila['iddetalle']);
				$detalleCompra->setPrecio($fila['precio']);
				$detalleCompra->setIdArticulo($fila['idarticulo']);
				$detalleCompra->setCantidad($fila['cantidad']);

				$listaDetalleCompra[] = $detalleCompra;
			}

		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $listaDetalleCompra;
	}
}