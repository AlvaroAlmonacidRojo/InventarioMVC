<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 02/02/2018
 * Time: 13:27
 */

class Conexion {

	public function getPDO(){
		$usuario ='root';
		$password = '';

		try{
			$pdo = new PDO('mysql:host=localhost;dbname=inventario',$usuario,$password,array(PDO::ATTR_PERSISTENT=>true));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $pdo;
		}catch (PDOException $e){
			$_SESSION['errorconexion'] = $e->getMessage();
			throw $e;
		}
	}
}
?>