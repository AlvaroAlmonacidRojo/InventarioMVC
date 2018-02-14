<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 04/02/2018
 * Time: 13:06
 */
require_once '../conexion/Conexion.php';
require_once '../entities/Articulo.php';
class DAOArticulo {

	public function addArticulo($idCategoria,$descripcion,$precio,$stock){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();


		$sql= "INSERT INTO articulos (idcategoria, descripcion, precio, stock) VALUES ($idCategoria,'$descripcion',$precio,$stock)";


		$statement=$objPDO->prepare($sql);



		try{
			$objPDO->beginTransaction();
			$statement->execute();
			$objPDO->commit();
		}catch (PDOException $e){
			throw ($e);
			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: ../web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return true;
	}

	public function listaArticulos(){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM articulos";

		$listaArticulos= array();
		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

			while ( $fila = $statement->fetch(PDO::FETCH_ASSOC)){
				$articulo = new Articulo();

				$articulo->setIdArticulos($fila['idarticulo']);
				$articulo->setIdCategoria($fila['idcategoria']);
				$articulo->setDescripcion($fila['descripcion']);
				$articulo->setPrecio($fila['precio']);
				$articulo->setStock($fila['stock']);

				$listaArticulos[] = $articulo;
			}

		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $listaArticulos;
	}

	public function articuloId($idArticulo){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();
		$sql = "SELECT * FROM articulos WHERE idarticulo = $idArticulo";

		$statement= $objPDO->prepare($sql);

		try{
			$statement->execute();

				$fila = $statement->fetch(PDO::FETCH_ASSOC);
				$articulo = new Articulo();

				$articulo->setIdArticulos($fila['idarticulo']);
				$articulo->setIdCategoria($fila['idcategoria']);
				$articulo->setDescripcion($fila['descripcion']);
				$articulo->setPrecio($fila['precio']);
				$articulo->setStock($fila['stock']);


		}catch (PDOException $e){
			$_SESSION['erromysql'] = $statement->errorInfo();

			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

		return $articulo;
	}

	public function updateArticulo($idArticulo, $stock){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();


		$sql= "UPDATE articulos SET stock = $stock WHERE idarticulo = $idArticulo";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();
		}catch (PDOException $e){
			trhow($e);
			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}
	}

	public function isCategoria($idCategoria){
		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();


		$sql= "SELECT * FROM articulos WHERE idcategoria = $idCategoria";

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

	public function deleteArticulo($idArticulo){

		$conexion = new Conexion();
		$objPDO = $conexion->getPDO();

		$sql= "DELETE FROM articulos WHERE idarticulo = $idArticulo";

		$statement = $objPDO->prepare($sql);

		try{
			$statement->execute();


			if($statement->rowCount()>0){
				return true;
			}else{
				return false;
			}

		}catch (PDOException $e){
			throw($e);
			$_SESSION['erromysql'] = $statement->errorInfo();
			header('Location: web/error.php');
		}finally{
			$statement=NULL;
			$objPDO=NULL;
		}

	}
}