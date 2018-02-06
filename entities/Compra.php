<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 04/02/2018
 * Time: 22:55
 */

class Compra {

	private $idCompra;
	private $idProveedor;
	private $fecha;
	private $total;

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
	public function getIdProveedor() {
		return $this->idProveedor;
	}

	/**
	 * @param mixed $idProveedor
	 */
	public function setIdProveedor( $idProveedor ) {
		$this->idProveedor = $idProveedor;
	}

	/**
	 * @return mixed
	 */
	public function getFecha() {
		return $this->fecha;
	}

	/**
	 * @param mixed $fecha
	 */
	public function setFecha( $fecha ) {
		$this->fecha = $fecha;
	}

	/**
	 * @return mixed
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * @param mixed $total
	 */
	public function setTotal( $total ) {
		$this->total = $total;
	}


}