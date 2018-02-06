<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 04/02/2018
 * Time: 22:55
 */

class Proveedor {

	private $idProveedor;
	private $razonSocial;
	private $direccion;
	private $telefono;

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
	public function getRazonSocial() {
		return $this->razonSocial;
	}

	/**
	 * @param mixed $razonSocial
	 */
	public function setRazonSocial( $razonSocial ) {
		$this->razonSocial = $razonSocial;
	}

	/**
	 * @return mixed
	 */
	public function getDireccion() {
		return $this->direccion;
	}

	/**
	 * @param mixed $direccion
	 */
	public function setDireccion( $direccion ) {
		$this->direccion = $direccion;
	}

	/**
	 * @return mixed
	 */
	public function getTelefono() {
		return $this->telefono;
	}

	/**
	 * @param mixed $telefono
	 */
	public function setTelefono( $telefono ) {
		$this->telefono = $telefono;
	}

	

}