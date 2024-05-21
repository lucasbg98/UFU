<?php

    require_once("../model/equipamento.php");

    class ControllerCadastroEquipamento{

        private $equipamento;
    
    
        public function __construct(){
            $this->equipamento=new Equipamento();
            $this->inserirEquipamentos();
    
        }
    
        public function inserirEquipamentos(){
    
            $this->equipamento->setNpatrimonio($_POST['npatrimonio']);
            $this->equipamento->setItem($_POST['item']);
            $this->equipamento->setNome($_POST['nome']);
            $this->equipamento->setDescricao($_POST['descricao']);
            $this->equipamento->setProcesso($_POST['processo']);
            $this->equipamento->setLocal($_POST['local']);
            $this->equipamento->setEmpenho($_POST['empenho']);
            $this->equipamento->setEmpenho_siafi($_POST['siafi']);
            $this->equipamento->setObservacao($_POST['observacao']);
            $this->equipamento->setReservado('0');
    
            $result = $this->equipamento->insereEquipamento();
            
            if($result){
                header("Location: http://localhost/trabalhoBanco/view/cadastroEquipamento.php");
                
                }
        }
    
    
    }
    
    new ControllerCadastroEquipamento();

?>