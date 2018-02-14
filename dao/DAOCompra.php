<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 05/02/2018
 * Time: 17:01
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Compra.php';
class DAOCompra {

	public function registerCompra($idProveedor,$precio,$cantidad){

		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();

		$total = $precio*$cantidad;
		$sql= "INSERT INTO compras (idproveedor,fecha,total) VALUES ($idProveedor,NOW(),$total)";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();
			$idLast= $objPDO->lastInsertId();
		}catch (PDOException $e){

			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $idLast;
	}

	public function listaCompras(){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM compras";

		$listaCompras= array();
		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			while ( $fila = $statement->fetch(PDO::FETCH_ASSOC)){
				$compra = new Compra();

				$compra->setIdCompra($fila['idcompra']);
				$compra->setIdProveedor($fila['idproveedor']);
				$compra->setFecha($fila['fecha']);
				$compra->setTotal($fila['total']);

				$listaCompras[] = $compra;
			}

		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $listaCompras;
	}

	public function precioTotal($idCompra){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();


		$sql= "SELECT total FROM compras WHERE idcompra=$idCompra";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();
			$fila= $statement->fetch(PDO::FETCH_ASSOC);
			$precioTotal= $fila['total'];
		}catch (PDOException $e){

			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $precioTotal;
	}

	public function updateCompra($compra){

		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();

		$total = $compra->getTotal();
		$idCompra = $compra->getIdCompra();

		$sql= "UPDATE compras SET fecha = NOW(),total=$total WHERE idcompra = $idCompra";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();
			$fila= $statement->fetch(PDO::FETCH_ASSOC);
			$precioTotal= $fila['total'];
		}catch (PDOException $e){
			trhow($e);
			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

	}

	public function isProveedor($idProveedor){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();


		$sql= "SELECT * FROM compras WHERE idproveedor = $idProveedor";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();
			$fila= $statement->fetch(PDO::FETCH_ASSOC);
			if($fila){
				return true;
			}else{
				return false;
			}

		}catch (PDOException $e){
			trhow($e);
			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}
	}
}