<?php

class Parceria {
  private int $id;
  private String $nome;
  private String $logo_url;
  private String $periodo_inicial;
  private ?String $periodo_final;
  private ?String $link;

public function __construct() {}

public static function carregarObjeto(
  String $option,
  array $values
):Parceria {
  $instance = new static();

  if($option === "colunas") {
    $instance->carregarColunas( $values );
  }

  return $instance;
}

protected function carregarColunas( array $row ) {
  $this->id = $row['id'];
  $this->nome = $row['nome'];
  $this->logo_url = $row['logo_url'];
  $this->periodo_inicial = $row["periodo_inicial"];
  $this->periodo_final = $row["periodo_final"];
  $this->link = $row["link"];
}

  public function getId():int {
    return $this->id;
  } 

  public function getNome():String {
    return $this->nome;
  }

  public function getLogoUrl():String {
    return $this->logo_url;
  }

  public function getPeriodoInicial():String {
    return $this->periodo_inicial;
  }
  
  public function getPeriodoFinal():?String {
    return $this->periodo_final;
  }

  public function getLink():?String {
    return $this->link;
  }

  public function setId(int $id) {
    $this->id = $id;
  }

  public function setNome(String $nome) {
    $this->nome = $nome;
  }

  public function setLogoUrl(String $url) {
    $this->logo_url = $url;
  }

  public function setPeriodoInicial(String $data) {
    $this->periodo_inicial = $data;
  }

  public function setPeriodoFinal(?String $data) {
    $this->periodo_final = $data;
  }

  public function setLink(?String $link) {
    $this->link = $link;
  }

}