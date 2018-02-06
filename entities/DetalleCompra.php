<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 04/02/2018
 * Time: 22:55
 */

class DetalleCompra {

	private $idDetalle;
	private $idCompra;
	private $idArticulo;
	private $cantidad;
	private $precio;

	/**
	 * @return mixed
	 */
	public function getIdDetalle() {
		return $this->idDetalle;
	}

	/**
	 * @param mixed $idDetalle
	 */
	public function setIdDetalle( $idDetalle ) {
		$this->idDetalle = $idDetalle;
	}

	/**
	 * @return mixed
	 */
	public function getIdCompra() {
		return $this->idCompra;
	}

	/**
	 * @param mixed $idCompra
	 */
	public function setIdCompra( $idCompra ) {
		$this->idCompra = $idCompra;
	}

	/**
	 * @return mixed
	 */
	public function getIdArticulo() {
		return $this->idArticulo;
	}

	/**
	 * @param mixed $idArticulo
	 */
	public function setIdArticulo( $idArticulo ) {
		$this->idArticulo = $idArticulo;
	}

	/**
	 * @return mixed
	 */
	public function getCantidad() {
		return $this->cantidad;
	}

	/**
	 * @param mixed $cantidad
	 */
	public function setCantidad( $cantidad ) {
		$this->cantidad = $cantidad;
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


}