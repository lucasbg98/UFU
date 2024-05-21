<?php

    require_once("../model/EquipamentoDAO.php");

    class ControllerReservaEquipamento{

       private $equipamento;
        
        public function __construct(){
            $this->equipamento=new EquipamentoDAO();
            $this->listarEquipamentos();

    
        }
    
        public function listarEquipamentos(){
        
     
          $result= $this->equipamento->reservaEquipamento($_POST['cod'], $_POST['npatrimonio']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservaEquipamento();

?>