<?php

require_once(__DIR__ .'../../model/Usuario.php');

class UsuarioDC {
  public $id;
  public $nome;

  public function __construct( Usuario $user ) {
    $this->id = $user->getId();
    $this->nome = $user->getNome();
  }
}
