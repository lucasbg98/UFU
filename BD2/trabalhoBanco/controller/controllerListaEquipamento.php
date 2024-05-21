<?php

    require_once("../model/EquipamentoDAO.php");

    class ControllerListaEquipamento{

       private $equipamento;
        
        public function __construct(){
            $this->equipamento=new EquipamentoDAO();
            $this->listarEquipamentos();

    
        }
    
        public function listarEquipamentos(){
          $result= $this->equipamento->listEquipamento();
          $data = array();
          while($rows = pg_fetch_array($result)){
              $data[] = $rows;
          }
         echo json_encode($data);
        }
    
    
    }
    
    new ControllerListaEquipamento();

?>