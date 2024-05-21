<?php

require_once("EquipamentoDAO.php");


class Equipamento extends EquipamentoDAO{
		
	private $item;
	private $npatrimonio;
	private $nome;
	private $descricao;
	private $processo;
	private $empenho;
	private $empenho_siafi;
	private $local;
	private $observacao;
	private $reservado;	

	//Métodos set
	public function setItem($item){
		$this->item=$item;
	}
	
	public function setNpatrimonio($npatrimonio){
		$this->npatrimonio=$npatrimonio;
	}
	
	public function setNome($nome){
		$this->nome=$nome;
	}

	public function setDescricao($descricao){
		$this->descricao=$descricao;
	}
	
	public function setProcesso($processo){
		$this->processo=$processo;
	}

	public function setEmpenho($empenho){
		$this->empenho=$empenho;
	}

	public function setEmpenho_siafi($empenho_siafi){
		$this->empenho_siafi=$empenho_siafi;
	}

	public function setLocal($local){
		$this->local=$local;
	}

	public function setObservacao($observacao){
		$this->observacao=$observacao;
	}

	public function setReservado($reservado){
		$this->reservado=$reservado;
	}




	//Métodos get
	public function getItem(){
		return $this->item;
	}

	public function getNpatrimonio(){
		return $this->npatrimonio;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getProcesso(){
		return $this->processo;
	}

	public function getEmpenho(){
		return $this->empenho;
	}

	public function getEmpenho_siafi(){
		return $this->empenho_siafi;
	}

	public function getLocal(){
		return $this->local;
	}

	public function getObservacao(){
		return $this->observacao;
	}

	public function getReservado(){
		return $this->reservado;
	}
	

	
	//Métodos
	public function insereEquipamento(){
		
	return $this->setEquipamento($this->getItem(), $this->getNpatrimonio(),$this->getNome(),$this->getDescricao(),$this->getProcesso(),$this->getEmpenho(),$this->getEmpenho_siafi(),$this->getLocal(),$this->getObservacao(),$this->getReservado());
	}

	
}



?>

