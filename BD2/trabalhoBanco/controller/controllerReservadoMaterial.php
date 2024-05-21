<?php

    require_once("../model/MaterialDAO.php");

    class ControllerReservadoMaterial{

       private $material;
        
        public function __construct(){
            $this->material=new MaterialDAO();
            $this->listarMateriais();

    
        }
    
        public function listarMateriais(){
        
     
          $result= $this->material->reservadoMaterial($_POST['codM']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservadoMaterial();

?>