<?php
require_once("Usa_ReagDAO.php");


    class Reserva extends Usa_ReagDAO{

    private $fk_usuario_cod;
    private $fk_reagentes_cod;
    private $data_emprestimo;
    private $data_recebimento;

    //Métodos set
    public function setUsuario_Cod($fk_usuario_cod){
        $this->fk_usuario_cod=$fk_usuario_cod;
    }

    public function setReagentes_cod($fk_reagentes_cod){
        $this->fk_reagentes_cod=$fk_reagentes_cod;
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

    public function getReagentes_Cod(){
        return $this->fk_reagentes_cod;
    }

    public function getData_Emprestimo(){
        return $this->data_emprestimo;
    }

    public function getData_Recebimento(){
        return $this->data_recebimento;
    }
?>