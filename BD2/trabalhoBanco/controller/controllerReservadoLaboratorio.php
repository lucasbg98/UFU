<?php

    require_once("../model/LaboratorioDAO.php");

    class ControllerReservadoLaboratorio{

       private $lab;
        
        public function __construct(){
            $this->lab=new LaboratorioDAO();
            $this->listarLaboratorios();

    
        }
    
        public function listarLaboratorios(){
        
     
          $result= $this->lab->reservadoLaboratorio($_POST['codL']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservadoLaboratorio();

?>