<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 05/02/2018
 * Time: 13:46
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Proveedor.php';
class DAOProveedor {

	public function listaProveedores(){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM proveedores";

		$listaProveedores= array();
		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			while ( $fila = $statement->fetch(PDO::FETCH_ASSOC)){
				$proveedor = new Proveedor();

				$proveedor->setIdProveedor($fila['idproveedor']);
				$proveedor->setDireccion($fila['direccion']);
				$proveedor->setRazonSocial($fila['razonsocial']);
				$proveedor->setTelefono($fila['telefono']);

				$listaProveedores[] = $proveedor;
			}

		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $listaProveedores;
	}

	public function proveedorId($idProveedor){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM proveedores WHERE idproveedor = $idProveedor";

		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			$fila = $statement->fetch(PDO::FETCH_ASSOC);
			$proveedor = new Proveedor();

			$proveedor->setIdProveedor($fila['idproveedor']);
			$proveedor->setRazonSocial($fila['razonsocial']);
			$proveedor->setTelefono($fila['telefono']);;
			$proveedor->setDireccion($fila['direccion']);


		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $proveedor;
	}

	public function addProveedor($razonSocial,$direccion,$telefono){

		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();

		$sql= "INSERT INTO proveedores (razonsocial,direccion,telefono) VALUES ('$razonSocial','$direccion','$telefono')";

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
}