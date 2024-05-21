<?php
require_once("Usa_EquipDAO.php");


    class Reserva extends Usa_EquipDAO{

    private $fk_usuario_cod;
    private $fk_equipamentos_npatrimonio;
    private $data_emprestimo;
    private $data_recebimento;

    //Métodos set
    public function setUsuario_Cod($fk_usuario_cod){
        $this->fk_usuario_cod=$fk_usuario_cod;
    }

    public function setEquipamentos_npatrimonio($fk_equipamentos_npatrimonio){
        $this->fk_equipamentos_npatrimonio=$fk_equipamentos_npatrimonio;
    }

    public function setData_Emprestimo($data_emprestimo){
        $this->data_emprestimo=$data_emprestimo;
    }

    public function setData_Recebimento($data_recebimento){
        $this->data_recebimento=$data_recebimento;
    }

    //Métodos get
    public function getUsuario_Cod(){
        return $this->fk_usuario_cod;
    }

    public function getEquipamentos_npatrimonio(){
        return $this->fk_equipamentos_npatrimonio;
    }

    public function getData_Emprestimo(){
        return $this->data_emprestimo;
    }

    public function getData_Recebimento(){
        return $this->data_recebimento;
    }
?>