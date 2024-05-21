<?php

require_once (__DIR__."/../model/Resultado.php");
require_once (__DIR__."/SubstanciaDC.php");
require_once (__DIR__."/ReferenciaDC.php");
require_once (__DIR__."/../assets/php/Status.php");


class ResultadoDC {
  public int $id;
  public String $status;
  public String $resultado;
  public String $cultura;
  public ?String $comentario;
  public array $substancias;
  public ReferenciaDC $referencia;

  public function __construct( Resultado $res ) {
    $this->id = $res->getId();
    // $this->resultado = $res->getStatus() !== Status::Resultado_Status_Aprovada
    //   ? Resultado::converterStatusParaString($res->getStatus())
    //   : Resultado::converterResultadoParaString($res->getResultado());
    $this->status = Resultado::converterStatusParaString($res->getStatus());
    $this->resultado = Resultado::converterResultadoParaString($res->getResultado());
    $this->cultura = $res->getCultura()["descricao"];
    $this->comentario = $res->getComentario();
    $this->substancias = array();

    foreach ($res->getSubstancias() as $key => $sub) {
      array_push($this->substancias, new SubstanciaDC($sub));
    }

    $this->referencia = new ReferenciaDC( $res->getReferencia() );
  }

}