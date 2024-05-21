<?php

require_once(__DIR__ . "/./Perfil.php");
require_once(__DIR__ . "/../dao/PerfilDAO.php");

class AppUser
{
  private String $id;
  private String $uf;
  private String $nome;
  private String $email;
  private String $cidade;
  private int $perfil_id;
  private Perfil $perfil;

  private DateTime $criado_em;

  function __construct()
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
    $this->uf = $row["uf"];
    $this->nome = $row["nome"];
    $this->email = $row["email"];
    $this->cidade = $row["cidade"];
    $this->perfil_id = $row["perfil_id"];
    $this->criado_em = new DateTime($row["criado_em"]);
    $this->perfil = PerfilDAO::read(array("perfil_id", $row["perfil_id"]));
  }

  public function toDataContract()
  {
    return array(
      "id" => $this->getId(),
      "uf" => $this->getUf(),
      "nome" => $this->getNome(),
      "email" => $this->getEmail(),
      "cidade" => $this->getCidade(),
      "perfilId" => $this->getCidade(),
      "perfil" => array(
        "id" => $this->getPerfil()->getId(),
        "descricao" => $this->getPerfil()->getDescricao()
      ),
    );
  }

  //getters
  function getId(): String
  {
    return $this->id;
  }
  function getUf(): String
  {
    return $this->uf;
  }
  function getNome(): String
  {
    return $this->nome;
  }
  function getEmail(): String
  {
    return $this->email;
  }
  function getCidade(): String
  {
    return $this->cidade;
  }
  function getPerfilId(): int
  {
    return $this->perfil_id;
  }
  public function getCriadoEm(): DateTime
  {
    return $this->criado_em;
  }
  function getPerfil(): Perfil
  {
    return $this->perfil;
  }

  //setters
  function setId(String $id)
  {
    $this->id = $id;
  }
  function setUf(String $uf)
  {
    $this->uf = $uf;
  }
  function setNome(String $nome)
  {
    $this->nome = $nome;
  }
  function setEmail(String $email)
  {
    $this->email = $email;
  }
  function setCidade(String $cidade)
  {
    $this->cidade = $cidade;
  }
  function setPerfilId(int $perfil_id)
  {
    $this->perfil_id = $perfil_id;

    if (isset($perfil_id)) {
      $this->perfil = PerfilDAO::read(array("perfil_id", $perfil_id));
    }
  }
  public function setCriadoEm(DateTime $criadoEm)
  {
    $this->criado_em = $criadoEm;
  }
  function setPerfil(Perfil $perfil)
  {
    $this->perfil = $perfil;
  }
}
