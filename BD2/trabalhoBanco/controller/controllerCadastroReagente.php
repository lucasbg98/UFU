<?php

    require_once("../model/reagente.php");

    class ControllerCadastroReagente{

        private $reagente;
    
    
        public function __construct(){
            $this->reagente=new Reagente();
            $this->inserirReagentes();
    
        }
    
        public function inserirReagentes(){
    
            $this->reagente->setCod($_POST['cod']);
            $this->reagente->setNome($_POST['nome']);
            $this->reagente->setTipo($_POST['tipo']);
            $this->reagente->setGrupo($_POST['grupo']);
            $this->reagente->setUnidade($_POST['unidade']);
            $this->reagente->setQuant_estoque($_POST['quantE']);
            $this->reagente->setObs($_POST['obs']);
            $this->reagente->setQuant_recipiente($_POST['quantR']);
            $this->reagente->setQuant_usada(0);
            
    
            $result = $this->reagente->insereReagente();
            
    
        }
    
    
    }
    
    new ControllerCadastroReagente();

?>