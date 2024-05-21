<?php

require_once(__DIR__."/../model/Parceria.php");

class ParceriaDC {
  public int $id;
  public String $nome;
  public String $image64;
  public String $periodo_inicial;
  public ?String $periodo_final;
  public ?String $link;

  public function __construct(Parceria $p) {
    $this->id = $p->getId();
    $this->nome = $p->getNome();
    $this->link = $p->getLink();

    $periodo_inicial = date("d/m/Y", strtotime($p->getPeriodoInicial()));
    $periodo_final = $p->getPeriodoFinal() !== null
      ? date("d/m/Y", strtotime($p->getPeriodoFinal()))
      : null;

    $this->periodo_inicial = $periodo_inicial;
    $this->periodo_final = $periodo_final;
    
    $path = __DIR__."/../temp/img/{$p->getLogoUrl()}";
    $data = file_get_contents($path);
    $base64 = base64_encode($data);
    $this->image64 = $base64;
  }
}