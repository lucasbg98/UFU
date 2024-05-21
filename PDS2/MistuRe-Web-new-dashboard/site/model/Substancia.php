<?php

require_once (__DIR__."/Classe.php");
require_once (__DIR__."/../dao/ApelidoDAO.php");
require_once (__DIR__."/../dao/NomeComercialDAO.php");
require_once (__DIR__."/../dao/ClasseDAO.php");

class Substancia {

	
	//colunas da substancia
	private $id;
	private $principio_ativo; //unique
	private $classe_id;

	//relacionamentos
	private $apelidos;
	private $nomes_comerciais;
	private $classe;

	public function __construct() {
		//inicializando relacionamentos
		$this->apelidos = array();
		$this->nomes_comerciais = array();;
		$this->classe = new Classe();
	}

	public static function carregarObjeto ( String $option, array $row ) {
		$instance = new static();

		if ( $option === "colunas_e_relacionamentos" ) {
			$instance->carregarColunas($row);
			$instance->carregarRelacionamentos($row);
		}
		else if ( $option === "apenas_colunas" ) {
			$instance->carregarColunas($row);
		}
		return $instance;
	}

	protected function carregarColunas( array $row ) {
		$this->id = $row["id"];
		$this->principio_ativo = $row["principio_ativo"];
		$this->classe_id = $row["classe_id"];
	}

	protected function carregarRelacionamentos( array $row ) {
		$this->apelidos = ApelidoDAO::read(array("subs_id",$row["id"]));
		$this->nomes_comerciais = NomeComercialDAO::read(array("subs_id", $row["id"]));
		$this->classe = ClasseDAO::read(array("cla_id", $row["classe_id"]));
	}

	public function jsonSerialize(  ) {
		$vars = get_object_vars($this);  
		if(isset($this->classe))
			$vars["classe"] = Classe::jsonSerializeList(array($vars["classe"]));
			
        return $vars;
    }

    public static function jsonSerializeList( array $substancias ) {
    	$res = array();

    	foreach ($substancias as $s) {
    		array_push($res, $s->jsonSerialize());
    	}
    	return $res;	
    }

	//getters
	
	function getId (  ) {
		return $this->id;
	}

	function getPrincipioAtivo (  ) {
		return $this->principio_ativo;
	}

	function getClasse_id (  ) {
		return $this->classe_id;
	}

	function getClasse (  ) {
		return ClasseDAO::read(array("cla_id", $this->classe_id));
	}

	function getApelidos (  ) {
		return $this->apelidos;
	}

	function getNomesComerciais (  ) {
		return $this->nomes_comerciais;
	}

	//setters

	function setId ( $id ) {
		$this->id = $id;
	}

	function setPrincipioAtivo ( $principioAtivo ) {
		$this->principio_ativo = $principioAtivo;
	}

	function setClasse_id ( $classe_id ) {
		$this->classe_id = $classe_id;
	}

	function setClasse ( $classe ) {
		$this->classe = $classe;
	}

	function setApelidos( $apelidos ) {
		$this->apelidos = $apelidos;
	}

	function setNomesComerciais ( $nomes_comerciais ) {
		$this->nomes_comerciais = $nomes_comerciais;
	}
}