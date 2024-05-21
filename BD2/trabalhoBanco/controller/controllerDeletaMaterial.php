<?php

    require_once("../model/MaterialDAO.php");

    class ControllerDeletaMaterial{

       private $material;
        
        public function __construct(){
            $this->material=new MaterialDAO();
            $this->deletaMateriais();

    
        }
    
        public function deletaMateriais(){
        
     
          $result= $this->material->deletaMaterial($_POST['codM']);
          echo $result;
        }
    
    
    }
    
    new ControllerDeletaMaterial();

?>