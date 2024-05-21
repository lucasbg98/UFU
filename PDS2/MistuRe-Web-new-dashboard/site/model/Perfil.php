<?php

class Perfil
{
  private $id;
  private $descricao;
  private $permissao;
  private $origin; // "web" or "app"

  public function __construct()
  {
  }

  public static function completeObject(array $row)
  {
    $instance = new static();
    $instance->fill($row);
    return $instance;
  }

  protected function fill(array $row)
  {
    $this->id = $row["id"];
    $this->descricao = $row["descricao"];
    $this->permissao = $row["permissao"];
    $this->origin = $row["origin"];
  }

  public function toDataContract()
  {
    return array(
      "id" => self::getId(),
      "descricao" => self::getDescricao(),
    );
  }

  public static function convertListToDataContract($list)
  {
    $res = array();

    foreach ($list as $profile) {
      array_push($res, $profile->toDataContract());
    }

    return $res;
  }

  //getters
  function getId()
  {
    return $this->id;
  }

  function getPermissao()
  {
    return $this->permissao;
  }

  function getDescricao()
  {
    return $this->descricao;
  }

  function getOrigin()
  {
    return $this->origin;
  }

  //setters
  function setId($id)
  {
    $this->id = $id;
  }

  function setPermissao($permissao)
  {
    $this->permissao = $permissao;
  }

  function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  function setOrigin($origin)
  {
    $this->origin = $origin;
  }
}
