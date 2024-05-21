<?php

    require_once("../model/usuario.php");

    class ControllerCadastroUsuario{

        private $usuario;
    
    
        public function __construct(){
            $this->usuario=new Usuario();
            $this->inserirUsuarios();
    
        }
    
        public function inserirUsuarios(){
    
            $this->usuario->setCod($_POST['cod']);
            $this->usuario->setNome($_POST['nome']);
            $this->usuario->setSenha($_POST['senha']);
            $this->usuario->setEmail($_POST['email']);
            $this->usuario->setTipo_Usuario($_POST['tipo']);
    
            $result = $this->usuario->insereUsuario();

            if($result){
                header("Location: http://localhost/trabalhoBanco/view/cadastroUsuario.php");
                
                }

            
    
        }
    
    
    }
    
    new ControllerCadastroUsuario();

?>