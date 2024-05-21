<?php

require_once (__DIR__."/../model/Referencia.php");

class ReferenciaDC {

  public String $id;
  public String $link;
  public String $pais;
  public ?String $titulo;

  public function __construct ( Referencia $ref ) {
    $this->id = $ref->getId();
    $this->link = $ref->getLink();
    $this->pais = $ref->getPais();
    $this->titulo = $ref->getTitulo();
  }

  public function jsonSerialize(  ) {
    $vars = get_object_vars($this);

    return $vars;
  }

  public static function jsonSerializeList( array $misturasDC ) {
    $res = array();

    foreach ($misturasDC as $m) {
      array_push($res, $m->jsonSerialize());
    }
    return $res;	
  }
}