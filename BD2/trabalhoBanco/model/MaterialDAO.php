<?php

    require_once("../init.php");

    class MaterialDAO{

        protected $myPDO;
    
        public function __construct(){
                $this->conexao();
        }
    
        private function conexao(){
           $this->myPDO = pg_connect("host='localhost' port='5432' dbname= TrabFinalBD2 user='postgres' password='postgres'")or die("Erro ao conectar! :(");
            }
    
    
        public function setMaterial($cod,$nome,$item,$descricao,$quant_recebida, $unidade, $danificado, $total, $local, $tipo, $empenho, $empenho_siafi, $observacao){
           $result = pg_query( $this->myPDO,"INSERT INTO material VALUES ('$item','$cod','$nome','$descricao','$quant_recebida','$unidade','$danificado','$total','$local', '$tipo','$empenho','$empenho_siafi','$observacao');");            
           //echo $result;
           if($result)
           return "Material cadastrado com sucesso!";
    
           }
    
        public function listMaterial(){
            $result = pg_query($this->myPDO,"SELECT * FROM material");                

            if(pg_num_rows($result) > 0)
                return $result;
            else    
                return false;

        }

        public function reservaMaterial($cod, $codM){
            $result = pg_query($this->myPDO,"UPDATE material SET reservado = '$cod' WHERE cod ='$codM'"); 
            $result2 = pg_query($this->myPDO,"INSERT INTO usa_mat VALUES('$codM', '$cod', current_date, current_date);");

            if($result && $result2){

                return true;

            }else{

                return false;
            }

        }

        public function reservadoMaterial($codM){
            $result = pg_query($this->myPDO,"UPDATE material SET reservado = '0' WHERE cod ='$codM'"); 
            $result2 = pg_query($this->myPDO,"DELETE FROM usa_mat WHERE fk_material_cod ='$codM';");

            if($result && $result2){

                return true;

            }else{

                return false;
            }

        }

        public function deletaMaterial($codM){
            $result = pg_query($this->myPDO,"DELETE FROM material WHERE cod ='$codM'"); 

            if($result){

                return true;

            }else{

                return false;
            }

        }

    
    }



?>