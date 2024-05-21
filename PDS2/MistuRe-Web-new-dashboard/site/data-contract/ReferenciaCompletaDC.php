<?php

require_once (__DIR__ ."/../model/Referencia.php");
require_once (__DIR__ ."/../data-contract/SubstanciaDC.php");

class ReferenciaCompletaDC {
    public $id;
    public $titulo;
    public $link;
    public $pais;
    public $resultado;
    public $comentario;
    public $doi;
    public $data_cadastro;
    public $data_avaliacao;
    public $status;

    public $cultura;
    public $pesquisador;
    public $avaliador;
    public $substancias;

    public function __construct( Referencia $ref )
    {
        $this->id = $ref->getId();
        $this->titulo = $ref->getTitulo();
        $this->link = $ref->getLink();
        $this->pais = $ref->getPais();
        $this->resultado = array(
            "value" => $ref->getResultado(),
            "descricao" =>Referencia::converterResultadoParaString ( $ref->getResultado() )
        );
        $this->comentario = $ref->getComentario();
        $this->doi = $ref->getDoi();
        $this->data_cadastro = strtotime( $ref->getData_cadastro() );
        $this->data_avaliacao = $ref->getData_avaliacao() ? strtotime($ref->getData_avaliacao()) : null;
        $this->status = Referencia::converterStatusParaString( $ref->getStatus() );

        $this->cultura = $ref->getCultura();
        $this->pesquisador = $ref->getPesquisador()->getNome();
        $this->avaliador = $ref->getAvaliador() ? $ref->getAvaliador()->getNome() : null;


        if($ref->getReferenciaSubstancias()) {
          $this->substancias = array();

          foreach ($ref->getReferenciaSubstancias() as $key => $rs) {
              array_push($this->substancias, new SubstanciaDC($rs));
          }
        }
    }

}