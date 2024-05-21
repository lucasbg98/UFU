<?php

require_once (__DIR__ ."/../dao/SubstanciaDAO.php");
require_once (__DIR__ ."/../dao/NomeComercialDAO.php");
require_once (__DIR__ ."/Substancia.php");
require_once (__DIR__ ."/NomeComercial.php");

class Mistura {
	
	// Colunas
	private int $substancia_id;
	private int $resultado_id;
	private float $dosagem_substancia;
	private ?float $dosagem_comercial = null;
	private ?int $nome_comercial_id = null;

	// Relacionamentos
	private Substancia $substancia;
	private ?NomeComercial $nome_comercial = null;

	public function __construct() {}

	public static function carregarObjeto( String $option, array $row ) {
		$instance = new static();

		if($option == "colunas_e_relacionamentos") {
			$instance->carregarColunas( $row );
			$instance->carregarRelacionamentos();
		}

		return $instance;
	}

	protected function carregarColunas( array $row ) {
		$this->substancia_id = $row["substancia_id"];
		$this->resultado_id = $row["resultado_id"];
		$this->dosagem_substancia = $row["dosagem_substancia"];
		$this->dosagem_comercial = $row["dosagem_comercial"];
		$this->nome_comercial_id = $row["nome_comercial_id"];
	}

	protected function carregarRelacionamentos() {
		$this->substancia = SubstanciaDAO::read(array("subs_id", $this->substancia_id, "apenas_colunas"));
		if(isset($this->nome_comercial_id))
			$this->nome_comercial = NomeComercialDAO::read(array("nc_id", $this->nome_comercial_id));
	}

	// getters
	function getSubstanciaId():int {
		return $this->substancia_id;
	}

	function getResultadoId():int {
		return $this->resultado_id;
	}
	
	function getDosagemSubstancia():float {
		return $this->dosagem_substancia;
	}
	
	function getDosagemComercial():?float {
		return $this->dosagem_comercial;
	}
	
	function getNomeComercialId():?int {
		return $this->nome_comercial_id;
	}

	function getSubstancia():Substancia {
		return $this->substancia;
	}

	function getNomeComercial():?NomeComercial {
		return $this->nome_comercial;
	} 

	// setters
	function setSubstanciaId( int $id ) {
		$this->substancia_id = $id;
	}

	function setResultadoId( int $id ) {
		$this->resultado_id = $id;
	}

	function setDosagemSubstancia( float $dosagem ) {
		$this->dosagem_substancia = $dosagem;
	}

	function setDosagemComercial( ?float $dosagem ) {
		$this->dosagem_comercial = $dosagem;
	}

	function setNomeComercialId( ?int $id ) {
		$this->nome_comercial_id = $id;
	}

	function setSubstancia( Substancia $sub ) {
		$this->substancia = $sub;
	}

	function setNomeComercial( NomeComercial $nc ) {
		$this->nome_comercial = $nc;
	}
}