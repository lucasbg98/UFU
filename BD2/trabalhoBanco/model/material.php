<?php
require_once("MaterialDAO.php");


    class Material extends MaterialDAO{

    private $item;
    private $cod;
    private $nome;
    private $descricao;
    private $quant_recebida;
    private $unidade;
    private $danificado_descartado;
    private $total;
    private $local;
    private $tipo;
    private $empenho;
    private $empenho_siafi;
    private $observacao;

    //Métodos set

    public function setItem($item){
        $this->item=$item;
    }
    public function setNome($nome){
        $this->nome=$nome;
    }

    public function setCod($cod){
        $this->cod=$cod;
    }

    public function setDescricao($descricao){
        $this->descricao=$descricao;
    }

    public function setQuant_Recebida($quant_recebida){
        $this->quant_recebida=$quant_recebida;
    }

    public function setUnidade ($unidade){
        $this->unidade=$unidade;
    }

    public function setDanificado($danificado_descartado){
        $this->danificado_descartado=$danificado_descartado;
    }

    public function setTotal($total){
        $this->total=$total;     
    }

    public function setLocal($local){
        $this->local=$local;
    }

    public function setTipo($tipo){
        $this->tipo=$tipo;
    }

    public function setEmpenho($empenho){
        $this->empenho=$empenho;
    }

    public function setEmpenho_Siafi($empenho_siafi){
        $this->empenho_siafi=$empenho_siafi;
    }

    public function setObservacao($observacao){
        $this->observacao=$observacao;
    }

    //Métodos get

    public function getItem(){
        return $this->item;
    }
    public function getNome(){
        return $this->nome;
    }

    public function getCod(){
        return $this->cod;
    }

    public function getDescricao(){
       return $this->descricao;
    }

    public function getQuant_Recebida(){
        return $this->quant_recebida;
    }

    public function getUnidade(){
        return $this->unidade;
    }

    public function getDanificado(){
        return $this->danificado_descartado;
    }

    public function getTotal(){
        return $this->total;     
    }

    public function getLocal(){
        return $this->local;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getEmpenho(){
        return $this->empenho;
    }

    public function getEmpenho_Siafi(){
       return $this->empenho_siafi;
    }

    public function getObservacao(){
        return $this->observacao;
    }




    //Métodos
    public function insereMaterial(){

        $this->setTotal($this->getQuant_Recebida() - $this->getDanificado());
        
        return $this->setMaterial($this->getCod(), $this->getNome(), $this->getItem(), $this->getDescricao(), $this->getQuant_Recebida(), $this->getUnidade(), $this->getDanificado(), $this->getTotal(), $this->getLocal(), $this->getTipo(), $this->getEmpenho(), $this->getEmpenho_Siafi(), $this->getObservacao());
    }

}

?>