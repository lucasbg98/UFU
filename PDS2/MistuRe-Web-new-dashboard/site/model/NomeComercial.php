<?php

class NomeComercial {

    private $id;
    private $descricao;
    private $substancia_id;

    public function __construct (  ) {  }

    public static function withRow ( array $row ) {
		$instance = new static();
		$instance->fill($row);
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
  
    public static function jsonSerializeList( array $misturas ) {
        $res = array();
  
        foreach ($misturas as $m) {
          array_push($res, $m->jsonSerialize());
        }
        
        return $res;	
    }

    //getters
    public function getId (  ) {
        return $this->id;
    }

    public function getDescricao (  ) {
        return $this->descricao;
    }

    public function getSubstanciaId (  ) {
        return $this->substancia_id;
    }

    //setters
    public function setId ( int $id ) {
        $this->id = $id;
    }

    public function setDescricao ( String $descricao ) {
        $this->descricao = $descricao;
    }

    public function setSubstanciaId ( int $substancia ) {
        $this->substancia_id = $substancia;
    }

}