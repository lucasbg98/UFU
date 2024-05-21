<?php

    require_once("../model/MaterialDAO.php");

    class ControllerReservaMaterial{

       private $material;
        
        public function __construct(){
            $this->material=new MaterialDAO();
            $this->listarMateriais();

    
        }
    
        public function listarMateriais(){
        
     
          $result= $this->material->reservaMaterial($_POST['cod'], $_POST['codM']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservaMaterial();

?>