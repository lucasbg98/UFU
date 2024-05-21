<?php

    require_once("../model/LaboratorioDAO.php");

    class ControllerReservaLaboratorio{

       private $lab;
        
        public function __construct(){
            $this->lab=new LaboratorioDAO();
            $this->listarLaboratorios();

    
        }
    
        public function listarLaboratorios(){
        
     
          $result= $this->lab->reservaLaboratorio($_POST['cod'], $_POST['codL']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservaLaboratorio();

?>