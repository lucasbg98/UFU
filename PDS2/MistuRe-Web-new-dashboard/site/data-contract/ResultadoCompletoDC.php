<?php

require_once (__DIR__."/../model/Resultado.php");
require_once (__DIR__."/./UsuarioDC.php");
require_once (__DIR__."/./ReferenciaDC.php");
require_once (__DIR__."/./ResultadoDC.php");

class ResultadoCompletoDC {
  public ResultadoDC $resultado;
  public int $data_cadastro;  //Timestamp
  public String $status;
  public UsuarioDC $pesquisador;
  public array $cultura;
  public ?UsuarioDC $avaliador;
  public ?int $data_avaliacao;

  public function __construct( Resultado $res ) {
    $this->resultado = new ResultadoDC($res);
    $this->data_cadastro = strtotime( $res->getDataCadastro()->format('Y-m-d H:i:s'));
    $this->status = Resultado::converterStatusParaString(
      $res->getStatus()
    );
    $this->pesquisador = new UsuarioDC($res->getPesquisador());
    $this->cultura = $res->getCultura();
    $this->avaliador = $res->getAvaliadorId() 
      ? new UsuarioDC($res->getAvaliador()) 
      : null;
    $this->data_avaliacao = $res->getDataAvaliacao() 
      ? strtotime($res->getDataAvaliacao()->format('Y-m-d H:i:s'))
      : null;
  }
}