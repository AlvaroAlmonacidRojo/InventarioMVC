<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 04/02/2018
 * Time: 13:04
 */

class Articulo {

	private $idArticulos;
	private $idCategoria;
	private $descripcion;
	private $precio;
	private $stock;

	/**
	 * @return mixed
	 */
	public function getIdArticulos() {
		return $this->idArticulos;
	}

	/**
	 * @param mixed $idArticulos
	 */
	public function setIdArticulos( $idArticulos ) {
		$this->idArticulos = $idArticulos;
	}

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

	/**
	 * @return mixed
	 */
	public function getPrecio() {
		return $this->precio;
	}

	/**
	 * @param mixed $precio
	 */
	public function setPrecio( $precio ) {
		$this->precio = $precio;
	}

	/**
	 * @return mixed
	 */
	public function getStock() {
		return $this->stock;
	}

	/**
	 * @param mixed $stock
	 */
	public function setStock( $stock ) {
		$this->stock = $stock;
	}


}