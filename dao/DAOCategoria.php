<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 02/02/2018
 * Time: 14:02
 */

require_once '../conexion/Conexion.php';
require_once '../dao/DAOCategoria.php';

class DAOCategoria {

	public function addCategoria($descripcion){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();

		$sql= "INSERT INTO categorias (descripcion) VALUES ('$descripcion')";

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


	/**
	 * @return array
	 */
	public function listaCategorias(){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM categorias";

		$listaCategorias= array();
		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			while ( $fila = $statement->fetch(PDO::FETCH_ASSOC)){
				$categoria = new Categoria();

				$categoria->setIdCategoria($fila['idcategoria']);
				$categoria->setDescripcion($fila['descripcion']);

				$listaCategorias[] = $categoria;
			}

		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $listaCategorias;
	}

	public function categoriaId($idCategoria){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM categorias WHERE idcategoria = $idCategoria";

		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			$fila = $statement->fetch(PDO::FETCH_ASSOC);
			$categoria = new Categoria();

			$categoria->setIdCategoria($fila['idcategoria']);
			$categoria->setDescripcion($fila['descripcion']);


		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $categoria;
	}


}
?>