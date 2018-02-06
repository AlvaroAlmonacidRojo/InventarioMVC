<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 02/02/2018
 * Time: 14:01
 */

class Categoria {

	private $idCategoria;
	private $descripcion;

	/**
	 * @return mixed
	 */
	public function getIdCategoria() {
		return $this->idCategoria;
	}

	/**
	 * @param mixed $idCategoria
	 */
	public function setIdCategoria( $idCategoria ) {
		$this->idCategoria = $idCategoria;
	}

	/**
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	 * @param mixed $descripcion
	 */
	public function setDescripcion( $descripcion ) {
		$this->descripcion = $descripcion;
	}


}
?>