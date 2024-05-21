<?php

    require_once("../model/MaterialDAO.php");

    class ControllerListaMaterial{

       private $material;
        
        public function __construct(){
            $this->material=new MaterialDAO();
            $this->listarMateriais();

    
        }
    
        public function listarMateriais(){
          $result= $this->material->listMaterial();
          $data = array();
          while($rows = pg_fetch_array($result)){
              $data[] = $rows;
          }
         echo json_encode($data);
        }
    
    
    }
    
    new ControllerListaMaterial();

?>