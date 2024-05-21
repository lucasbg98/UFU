<?php

    require_once("../model/LaboratorioDAO.php");

    class ControllerListaLaboratorio{

       private $lab;
        
        public function __construct(){
            $this->lab=new LaboratorioDAO();
            $this->listarLaboratorios();

    
        }
    
        public function listarLaboratorios(){
          $result= $this->lab->listLaboratorio();
          $data = array();
          while($rows = pg_fetch_array($result)){
              $data[] = $rows;
          }
         echo json_encode($data);
        }
    
    
    }
    
    new ControllerListaLaboratorio();

?>