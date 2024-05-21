<?php

    require_once("../model/laboratorioDAO.php");

    class ControllerDeletaLaboratorio{

        private $laboratorio;
    
    
        public function __construct(){
            $this->laboratorio=new LaboratorioDAO();
            $this->deletarLaboratorios();
    
        }
    
        public function deletarLaboratorios(){

            $result = $this->laboratorio->deletaLaboratorio($_POST['codL']);
            echo $result;
            
            }
    
        }
    
    
    
    new ControllerDeletaLaboratorio();

?>