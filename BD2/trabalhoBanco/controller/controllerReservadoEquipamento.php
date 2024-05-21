<?php

    require_once("../model/EquipamentoDAO.php");

    class ControllerReservadoEquipamento{

       private $equipamento;
        
        public function __construct(){
            $this->equipamento=new EquipamentoDAO();
            $this->listarEquipamentos();

    
        }
    
        public function listarEquipamentos(){
        
     
          $result= $this->equipamento->reservadoEquipamento($_POST['npatrimonio']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservadoEquipamento();

?>