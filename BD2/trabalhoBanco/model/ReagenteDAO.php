<?php

    require_once("../init.php");

    class ReagenteDAO{

        protected $myPDO;
    
        public function __construct(){
                $this->conexao();
        }
    
        private function conexao(){
           $this->myPDO = pg_connect("host='localhost' port='5432' dbname= TrabFinalBD2 user='postgres' password='postgres'")or die("Erro ao conectar! :(");
            }
    
    
        public function setReagente($cod,$nome,$grupo,$quant_estoque,$quant_recipiente,$quant_usada,$total,$unidade,$tipo,$obs){
           $result = pg_query( $this->myPDO,"INSERT INTO reagentes VALUES ('$cod','$nome','$grupo','$quant_estoque','$quant_recipiente','$quant_usada','$total','$unidade', '$tipo', '$obs');");            
           if($result)
           return "Equipamento cadastrado com sucesso!";
    
           }
    
    
    
    }


?>