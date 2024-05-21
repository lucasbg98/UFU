<?php
require_once("UsuarioDAO.php");


    class Usuario extends UsuarioDAO{

    private $nome;
    private $cod;
    private $tipo_usuario;
    private $email;
    private $senha;

    //Métodos set
    public function setNome($nome){
        $this->nome=$nome;
    }

    public function setCod($cod){
        $this->cod=$cod;
    }

    public function setTipo_Usuario($tipo_usuario){
        $this->tipo_usuario=$tipo_usuario;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function setSenha($senha){
        $this->senha=$senha;
    }


    //Métodos get
    public function getNome(){
        return $this->nome;
    }

    public function getCod(){
        return $this->cod;
    }

    public function getTipo_Usuario(){
        return $this->tipo_usuario;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }


    //Métodos

    public function insereUsuario(){

        return $this->setUsuario($this->getCod(), $this->getSenha(), $this->getEmail(), $this->getNome(), $this->getTipo_Usuario());
    }

    



}



?>