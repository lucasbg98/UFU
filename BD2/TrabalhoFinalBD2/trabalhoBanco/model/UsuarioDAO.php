<?php

    require_once("../init.php");

    class UsuarioDAO{

        protected $myPDO;
    
        public function __construct(){
                $this->conexao();
        }
    
        private function conexao(){
           $this->myPDO = pg_connect("host='localhost' port='5432' dbname= TrabFinalBD2 user='postgres' password='postgres'")or die("Erro ao conectar! :(");
            }
    
    
        public function setUsuario($cod,$senha, $email, $nome, $tipo_usuario){
           $result = pg_query( $this->myPDO,"INSERT INTO usuario VALUES ('$nome','$tipo_usuario', '$email', '$cod', '$senha');");            
           //echo $result;
           if($result)
           return "Usuario cadastrado com sucesso!";
    
           }

           public function listUsuario(){
            $result = pg_query($this->myPDO,"SELECT * FROM usuario");                

            if(pg_num_rows($result) > 0)
                return $result;
            else    
                return false;

        }

        public function validaUsuario($email,$senha){

            if($email == "admin" && $senha == "admin"){
                $data = "admin";
                return $data;
            }
            else{
                $result = pg_query($this->myPDO,"SELECT cod,nome FROM usuario WHERE email='$email' and senha='$senha'");

                $row = 0;
                $data = @pg_fetch_object($result, $row);
                
                if($data){

                    return $data;

                }   else{

                    return false;
                }
            }
        }

            public function deletaUsuario($codU){
                $result = pg_query($this->myPDO,"DELETE FROM usuario WHERE cod ='$codU'"); 
    
                if($result){
    
                    return true;
    
                }else{
    
                    return false;
                }
    
            }
            
            
            
            

        }
    
    
    


?>