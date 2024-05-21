<?php

    require_once("../model/material.php");

    class ControllerCadastroMaterial{

        private $material;
    
    
        public function __construct(){
            $this->material=new Material();
            $this->inserirMateriais();
    
        }
    
        public function inserirMateriais(){
    
            $this->material->setCod($_POST['cod']);
            $this->material->setNome($_POST['nome']);
            $this->material->setQuant_Recebida($_POST['quantR']);
            $this->material->setTipo($_POST['tipo']);
            $this->material->setDescricao($_POST['descricao']);
            $this->material->setUnidade($_POST['unidade']);
            $this->material->setLocal($_POST['local']);
            $this->material->setEmpenho($_POST['empenho']);
            $this->material->setEmpenho_Siafi($_POST['siafi']);
            $this->material->setItem($_POST['item']);
            $this->material->setObservacao($_POST['obs']);
            $this->material->setDanificado(0);
    
            $result = $this->material->insereMaterial();
            
    
        }
    
    
    }
    
    new ControllerCadastroMaterial();

?>