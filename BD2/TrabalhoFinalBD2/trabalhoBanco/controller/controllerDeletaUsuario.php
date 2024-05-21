<?php

    require_once("../model/UsuarioDAO.php");

    class ControllerDeletaUsuario{

       private $usuario;
        
        public function __construct(){
            $this->usuario=new UsuarioDAO();
            $this->deletaUsuario();

    
        }
    
        public function deletaUsuario(){
        
     
          $result= $this->usuario->deletaUsuario($_POST['codU']);
          echo $result;
        }
    
    
    }
    
    new ControllerDeletaUsuario();

?>