<?php

    require_once("../model/laboratorio.php");

    class ControllerCadastroLaboratorio{

        private $laboratorio;
    
    
        public function __construct(){
            $this->laboratorio=new Laboratorio();
            $this->inserirLaboratorios();
    
        }
    
        public function inserirLaboratorios(){
    
            $this->laboratorio->setCod($_POST['cod']);
            $this->laboratorio->setReservado(0);
    
            $result = $this->laboratorio->insereLaboratorio();
            
    
        }
    
    
    }
    
    new ControllerCadastroLaboratorio();

?>