<?php
require_once("LaboratorioDAO.php");


    class Laboratorio extends LaboratorioDAO{


    private $cod;
    private $reservado;


    //Métodos set

    public function setReservado($reservado){
        $this->reservado=$reservado;
    }

    public function setCod($cod){
        $this->cod=$cod;
    }

    //Métodos get

    public function getReservado(){
        return $this->reservado;
    }

    public function getCod(){
        return $this->cod;
    }


    //Métodos
    
    public function insereLaboratorio(){

        return $this->setLaboratorio($this->getCod(), $this->getReservado());
    }

}


?>