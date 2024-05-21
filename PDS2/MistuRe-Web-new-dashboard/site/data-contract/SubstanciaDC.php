<?php

require_once(__DIR__."/../model/Substancia.php");
require_once(__DIR__."/../model/Mistura.php");
require_once(__DIR__."/../data-contract/ClasseDC.php");

class SubstanciaDC {
  public int $sub_id;
  public ?int $nc_id;
  public String $principio_ativo;
  public ?String $nome_comercial;
  public ?float $dosagem_comercial;
  public float $dosagem_substancia;
  public ClasseDC $classe;

  public function __construct(Mistura $rs) {
    $this->sub_id = $rs->getSubstanciaId();
    $this->nc_id = $rs->getNomeComercialId();
    $this->principio_ativo = $rs->getSubstancia()->getPrincipioAtivo();
    $this->nome_comercial = $rs->getNomeComercial() != null
        ? $rs->getNomeComercial()->getDescricao() 
        : null;
    $this->dosagem_comercial = $rs->getNomeComercial() != null
        ? $rs->getDosagemComercial()
        : null;
    $this->dosagem_substancia = $rs->getDosagemSubstancia();
    $this->classe = new ClasseDC($rs->getSubstancia()->getClasse());
  }
}