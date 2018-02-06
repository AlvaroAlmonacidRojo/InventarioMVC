<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 03/02/2018
 * Time: 18:08
 */
require_once 'conexion/Conexion.php';

$conexion = new Conexion();
$objPDO = $conexion->getPDO();

$sql= "INSERT INTO Categorias (Descripcion) VALUES ('Categoria 2')";

$statement = $objPDO->prepare($sql);

try{
	$statement->execute();
	echo "<script>alert('Bien')</script>";
}catch (PDOException $e){
	//$_SESSION['erromysql'] = $statement->errorInfo();
	echo "<script>alert('Mal')</script>";
}finally{
	$statement=NULL;
	$objPDO=NULL;
}
