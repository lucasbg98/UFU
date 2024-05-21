<?php

    require_once("../init.php");

    class EquipamentoDAO{

        protected $myPDO;
    
        public function __construct(){
                $this->conexao();
        }
    
        private function conexao(){
           $this->myPDO = pg_connect("host='localhost' port='5432' dbname= TrabFinalBD2 user='postgres' password='postgres'")or die("Erro ao conectar! :(");
            }
    
    
        public function setEquipamento($item,$npatrimonio,$nome,$descricao,$processo,$empenho,$empenho_siafi,$local,$observacao,$reservado){
           $result = pg_query( $this->myPDO,"INSERT INTO equipamentos VALUES ('$item','$npatrimonio','$nome','$descricao','$processo','$empenho','$empenho_siafi','$local','$observacao', '$reservado');");            
           //echo $result;
           if($result)
           return "Equipamento cadastrado com sucesso!";
           }

        public function listEquipamento(){
            $result = pg_query($this->myPDO,"SELECT * FROM equipamentos");                

            if(pg_num_rows($result) > 0)
                return $result;
            else    
                return false;

        }

        public function reservaEquipamento($cod, $npatrimonio){
            $result = pg_query($this->myPDO,"UPDATE equipamentos SET reservado = '$cod' WHERE npatrimonio ='$npatrimonio'"); 
            $result2 = pg_query($this->myPDO,"INSERT INTO usa_equip VALUES('$cod', '$npatrimonio', current_date, current_date);");

            if($result && $result2){

                return true;

            }else{

                return false;
            }

        }

        public function reservadoEquipamento($npatrimonio){
            $result = pg_query($this->myPDO,"UPDATE equipamentos SET reservado = '0' WHERE npatrimonio ='$npatrimonio';"); 
            $result2 = pg_query($this->myPDO,"DELETE FROM usa_equip WHERE fk_equipamentos_npatrimonio ='$npatrimonio';");

            if($result && $result2){

                return true;

            }else{

                return false;
            }

        }

        public function deletaEquipamento($npatrimonio){
            $result = pg_query($this->myPDO,"DELETE FROM equipamentos WHERE npatrimonio ='$npatrimonio';"); 

            if($result){

                return true;

            }else{

                return false;
            }

        }
        
    
    
    
    }

?>