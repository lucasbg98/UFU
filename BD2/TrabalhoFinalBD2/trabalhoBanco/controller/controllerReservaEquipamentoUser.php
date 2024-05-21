<?php
    session_start();

    require_once("../model/EquipamentoDAO.php");

    class ControllerReservaEquipamentoUser{

       private $equipamento;
        
        public function __construct(){
            $this->equipamento=new EquipamentoDAO();
            $this->reservarEquipamentos();

    
        }
    
        public function reservarEquipamentos(){
        
     
          $result= $this->equipamento->reservaEquipamento($_SESSION['cod'], $_POST['npatrimonio']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservaEquipamentoUser();

?>