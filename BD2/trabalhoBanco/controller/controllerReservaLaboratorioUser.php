<?php
    session_start();

    require_once("../model/LaboratorioDAO.php");

    class ControllerReservaLaboratorioUser{

       private $lab;
        
        public function __construct(){
            $this->lab=new LaboratorioDAO();
            $this->listarLaboratorios();

    
        }
    
        public function listarLaboratorios(){
        
     
          $result= $this->lab->reservaLaboratorio($_SESSION['cod'], $_POST['codL']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservaLaboratorioUser();

?>