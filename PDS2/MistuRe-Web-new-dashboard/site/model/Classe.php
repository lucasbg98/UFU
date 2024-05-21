<?php

class Classe {

	private $id;
	private $descricao;
	private $cor;

	public function __construct() {}

	public static function withRow( array $row )
	{
		$instance = new static();
		$instance->fill($row);
		return $instance;
	}
    
	protected function fill( array $row ) {

		$this->id = $row["id"];
		$this->descricao = $row["descricao"];
		$this->cor = $row["cor"];
	}

	public function jsonSerialize(  ) {
		$vars = get_object_vars($this);

		return $vars;
	}

	public static function jsonSerializeList( array $classes ) {
		$res = array();

		foreach ($classes as $c) {
			array_push($res, $c->jsonSerialize());
		}
		return $res;	
	}

	//getters
	function getId(  ) {
		return $this->id;
	}

	function getDescricao(  ) {
		return $this->descricao;
	}

	function getCor(  ) {
		return $this->cor;
	}

	//setters
	function setId( $id ) {
		$this->id = $id;
	}

	function setDescricao( $desc ) {
		$this->descricao = $desc;
	}
	
	function setCor( $cor ) {
		$this->cor = $cor;
	}
}