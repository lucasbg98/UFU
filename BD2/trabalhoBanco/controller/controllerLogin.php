<?php
    session_start();
    require_once("../model/UsuarioDAO.php");

    class ControllerLogin{

       private $usuario;
        
        public function __construct(){

            $this->usuario=new UsuarioDAO();
            $this->verificaUser();

    
        }
    
        public function verificaUser(){
        
            
            $result= $this->usuario->validaUsuario($_POST['email'], $_POST['senha']);

            if($result == "admin"){
                header("Location: http://localhost/trabalhoBanco/view/paginaTecnico.php");
            }
          

            else if(isset($result->cod)){

                
            
                $_SESSION['cod']=$result->cod;
                $_SESSION['nome']=$result->nome;

                header("Location: http://localhost/trabalhoBanco/view/paginaUsuario.php"); 

            }else{

                
                $_SESSION['msg']="Error";

                header("Location: http://localhost/trabalhoBanco/view/Login.php"); 
               

           }
    
    
       }
    }
    new ControllerLogin();

?>