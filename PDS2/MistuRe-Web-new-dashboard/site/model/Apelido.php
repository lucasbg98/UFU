<?php

class Apelido {
	
	private $id;
	private $descricao;
	private $substancia_id;

	public function __construct() {}

	public static function withRow( array $row )
	{
		$instance = new static();
		$instance->fill($row);
		return $instance;
	}

	public static function descricao( $des )
	{
		$instance = new static();
		$instance->setDescricao($des);
		return $instance;
	}

	protected function fill( array $row ) {

		$this->id = $row["id"];
		$this->descricao = $row["descricao"];
		$this->substancia_id = $row["substancia_id"];
	}

	public function jsonSerialize(  ) {
        $vars = get_object_vars($this);

        return $vars;
    }

    public static function jsonSerializeList( array $apelidos ) {
    	$res = array();

    	foreach ($apelidos as $p) {
    		array_push($res, $p->jsonSerialize());
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

	function getSubstanciaId(  ) {
		return $this->substancia_id;
	}

	//setters
	function setId( $id ) {
		$this->id = $id;
	}

	function setDescricao( $desc ) {
		$this->descricao = $desc;
	}
	
	function setSubstanciaId( $subs ) {
		$this->substancia_id = $subs;
	}

}