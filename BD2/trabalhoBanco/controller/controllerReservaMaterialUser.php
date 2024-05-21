<?php
    session_start();

    require_once("../model/MaterialDAO.php");

    class ControllerReservaMaterialUser{

       private $material;
        
        public function __construct(){
            $this->material=new MaterialDAO();
            $this->listarMateriais();

    
        }
    
        public function listarMateriais(){
        
     
          $result= $this->material->reservaMaterial($_SESSION['cod'], $_POST['codM']);
          echo $result;
        }
    
    
    }
    
    new ControllerReservaMaterialUser();

?>