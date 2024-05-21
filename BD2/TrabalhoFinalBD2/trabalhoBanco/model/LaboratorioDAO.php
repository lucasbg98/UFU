<?php

    require_once("../init.php");

    class LaboratorioDAO{

        protected $myPDO;
    
        public function __construct(){
                $this->conexao();
        }
    
        private function conexao(){
           $this->myPDO = pg_connect("host='localhost' port='5432' dbname= TrabFinalBD2 user='postgres' password='postgres'")or die("Erro ao conectar! :(");
            }
    
    
        public function setLaboratorio($cod,$reservado){
           $result = pg_query( $this->myPDO,"INSERT INTO laboratorio VALUES ('$cod','$reservado');");            
           //echo $result;
           if($result)
           return "Laboratorio cadastrado com sucesso!";
    
           }

        public function listLaboratorio(){
            $result = pg_query($this->myPDO,"SELECT * FROM laboratorio");                

            if(pg_num_rows($result) > 0)
                return $result;
            else    
                return false;

        }

        public function reservaLaboratorio($cod, $codL){
            $result = pg_query($this->myPDO,"UPDATE laboratorio SET reservado = '$cod' WHERE cod ='$codL'"); 

            if($result){

                return true;

            }else{

                return false;
            }

        }

        public function reservadoLaboratorio($codL){
            $result = pg_query($this->myPDO,"UPDATE laboratorio SET reservado = '0' WHERE cod ='$codL';"); 

            if($result){

                return true;

            }else{

                return false;
            }

        }

        public function deletaLaboratorio($codL){
            $result = pg_query($this->myPDO,"DELETE FROM laboratorio WHERE cod ='$codL'"); 

            if($result){

                return true;

            }else{

                return false;
            }

        }
    
    
    
    }


?>