<?php

require_once (__DIR__ ."/../assets/php/Status.php");
require_once (__DIR__ ."/../dao/CulturaDAO.php");
require_once (__DIR__ ."/../dao/UsuarioDAO.php");

class Referencia {

	//Colunas
	private int $id;
	private String $link;
	private String $pais;
	private ?String $titulo;

	//Relacionamentos
	
	public function __construct() {}

	public static function carregarObjeto( String $option, array $row ) {
		$instance = new static();
		
		if ( $option === "apenas_colunas" ) {
				$instance->carregarColunas($row);
		}

		return $instance;
	}
	
	protected function carregarColunas( array $row ) {
		$this->id = (int) $row["id"];
		$this->link = $row["link"];
		$this->pais = $row["pais"];
		$this->titulo = $row["titulo"];
	}

	//getters
	function getId():int {
		return $this->id;
	}

	function getLink():String {
		return $this->link;
	}
	
	function getPais():String {
		return $this->pais;
	}
	
	function getTitulo():?String {
		return $this->titulo;
	}

	// Setters
	function setId( int $id ) {
		$this->id = $id;
	}

	function setTitulo( ?String $titulo ) {
		$this->titulo = $titulo;
	}

	function setLink( String $link ) {
		$this->link = $link;
	}

	function setPais( String $pais ) {
		$this->pais = $pais;
	}
}