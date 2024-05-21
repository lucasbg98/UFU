<?php

    require_once("../model/EquipamentoDAO.php");

    class ControllerDeletaEquipamento{

       private $equipamento;
        
        public function __construct(){
            $this->equipamento=new EquipamentoDAO();
            $this->deletarEquipamentos();

    
        }
    
        public function deletarEquipamentos(){
        
     
          $result= $this->equipamento->deletaEquipamento($_POST['npatrimonio']);
          echo $result;
        }
    
    
    }
    
    new ControllerDeletaEquipamento();

?>