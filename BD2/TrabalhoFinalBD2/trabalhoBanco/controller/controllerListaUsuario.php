<?php

    require_once("../model/UsuarioDAO.php");

    class ControllerListaUsuario{

       private $usuario;
        
        public function __construct(){
            $this->usuario=new UsuarioDAO();
            $this->listarUsuarios();

    
        }
    
        public function listarUsuarios(){
          $result= $this->usuario->listUsuario();
          $data = array();
          while($rows = pg_fetch_array($result)){
              $data[] = $rows;
          }
         echo json_encode($data);
        }
    
    
    }
    
    new ControllerListaUsuario();

?>