<?php

require_once("ReagenteDAO.php");

class Reagente extends ReagenteDAO{
		

	private $cod;
	private $nome;
	private $grupo;
	private $quant_estoque;
	private $quant_recipiente;
	private $quant_usada;
	private $total;
	private $unidade;
	private $tipo;
	private $obs;	



	//Métodos set
	public function setCod($cod){
		$this->cod=$cod;
	}
	
	public function setNome($nome){
		$this->nome=$nome;
	}
	
	public function setGrupo($grupo){
		$this->grupo=$grupo;
	}

	public function setQuant_estoque($quant_estoque){
		$this->quant_estoque=$quant_estoque;
	}
	
	public function setQuant_recipiente($quant_recipiente){
		$this->quant_recipiente=$quant_recipiente;
	}

	public function setQuant_usada($quant_usada){
		$this->quant_usada=$quant_usada;
	}

	public function setTotal($total){
		$this->total=$total;
	}

	public function setUnidade($unidade){
		$this->unidade=$unidade;
	}

	public function setTipo($tipo){
		$this->tipo=$tipo;
	}

	public function setObs($obs){
		$this->obs=$obs;
	}




	//Métodos get
	public function getCod(){
		return $this->cod;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getGrupo(){
		return $this->grupo;
	}

	public function getQuant_estoque(){
		return $this->quant_estoque;
	}

	public function getQuant_recipiente(){
		return $this->quant_recipiente;
	}

	public function getQuant_usada(){
		return $this->quant_usada;
	}

	public function getTotal(){
		return $this->total;
	}

	public function getUnidade(){
		return $this->unidade;
	}

    public function getTipo(){
		return $this->tipo;
	}

    public function getObs(){
		return $this->obs;
	}
    
	

	//Métodos
	public function insereReagente(){

		$this->setTotal($this->getQuant_estoque() * $this->getQuant_recipiente());

		return $this->setReagente($this->getCod(), $this->getNome(),$this->getGrupo(),$this->getQuant_estoque(),$this->getQuant_recipiente(),$this->getQuant_usada(),$this->getTotal(),$this->getUnidade(),$this->getTipo(),$this->getObs());
	}
	
}



?>


