<?php
require_once("ReservaDAO.php");


    class Reserva extends ReservaDAO{

    private $fk_usuario_cod;
    private $fk_laboratorio_cod;
    private $data_emprestimo;
    private $data_recebimento;

    //Métodos set
    public function setUsuario_Cod($fk_usuario_cod){
        $this->fk_usuario_cod=$fk_usuario_cod;
    }

    public function setLaboratorio_cod($fk_laboratorio_cod){
        $this->fk_laboratorio_cod=$fk_laboratorio_cod;
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

    public function getLaboratorio_Cod(){
        return $this->fk_laboratorio_cod;
    }

    public function getData_Emprestimo(){
        return $this->data_emprestimo;
    }

    public function getData_Recebimento(){
        return $this->data_recebimento;
    }


?>