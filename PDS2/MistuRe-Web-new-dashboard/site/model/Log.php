<?php

class Log
{
  // Colunas
  private int $id;
  private String $request;
  private String $response;
  private String $user_id;
  private DateTime $criado_em; // now()

  public static function carregarObjeto(String $option, array $row): Log
  {
    $instance = new static();

    if ($option === "colunas") {
      $instance->carregarColunas($row);
    }

    return $instance;
  }

  protected function carregarColunas(array $values)
  {
    $this->id = (int) $values["id"];
    $this->user_id = $values["user_id"];
    $this->request = (string) $values["request"];
    $this->response = (string) $values["response"];
    $this->criado_em = new Datetime($values["criado_em"]);
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getRequest(): String
  {
    return $this->request;
  }

  public function setRequest(String $req)
  {
    $this->request = $req;
  }

  public function getResponse(): String
  {
    return $this->response;
  }

  public function setResponse(String $res)
  {
    $this->response = $res;
  }

  public function getUserId(): String
  {
    return $this->user_id;
  }

  public function setUserId(String $user_id)
  {
    $this->user_id = $user_id;
  }

  public function getCriadoEm(): DateTime
  {
    return $this->criado_em;
  }

  public function setCriadoEm(DateTime $criado_em)
  {
    $this->criado_em = $criado_em;
  }
}
