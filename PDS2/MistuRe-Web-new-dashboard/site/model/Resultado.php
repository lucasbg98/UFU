<?php

require_once (__DIR__ ."/../dao/MisturaDAO.php");
require_once (__DIR__ ."/../dao/ReferenciaDAO.php");
require_once (__DIR__."/../model/Usuario.php");
require_once (__DIR__."/../dao/UsuarioDAO.php");

class Resultado {
  // Colunas
  private int $id;
  private DateTime $data_cadastro;
  private int $resultado;
  private int $status;
  private int $pesquisador_id;
  private int $cultura_id;
  private int $referencia_id;
  private ?int $avaliador_id;
  private ?DateTime $data_avaliacao;
  private ?String $comentario;

  //Relacionamentos 
  private array $cultura;
  private array $substancias;
  private Referencia $referencia;
  private Usuario $pesquisador;
  private ?Usuario $avaliador;

  public function __construct() {
    $this->substancias = array();
  }

  public static function carregarObjeto( String $option, array $row):Resultado {
    $instance = new static();

    if($option === "colunas_e_relacionamentos") {
      $instance->carregarColunas( $row );
      $instance->carregarRelacionamentos();
    }

    return $instance;
  }

  protected function carregarColunas( array $values ) {
    $this->id = (int) $values["id"];
    $this->data_cadastro = new DateTime($values["data_cadastro"]);
    $this->resultado = (int) $values["resultado"];
    $this->status = (int) $values["status"];
    $this->pesquisador_id = (int) $values["pesquisador_id"];
    $this->cultura_id = (int) $values["cultura_id"];
    $this->referencia_id = (int) $values["referencia_id"];
    $this->avaliador_id = $values["avaliador_id"]
      ? (int) $values["avaliador_id"]
      : null;
    $this->data_avaliacao = isset($values["data_avaliacao"]) 
      ? new DateTime($values["data_avaliacao"])
      : null;
    $this->comentario = isset($values["comentario"])
      ? $values["comentario"] 
      : null;
  }

  protected function carregarRelacionamentos() {
    $this->substancias = MisturaDAO::read(array("getByResultId", $this->id));
    $this->referencia = ReferenciaDAO::read(array("findById", $this->referencia_id));
    $this->cultura = CulturaDAO::read(array("desc_by_id", $this->cultura_id));
    $this->pesquisador = UsuarioDAO::read(array("user_id", $this->pesquisador_id));
    if($this->avaliador_id != null)
      $this->avaliador = UsuarioDAO::read(array("user_id", $this->avaliador_id));
  }

  public static function converterStatusParaString(int $status)  {
		switch($status) {
			case Status::Resultado_Status_Pendente: return "Pendente"; break;
			case Status::Resultado_Status_Aprovada: return "Aprovado"; break;
			case Status::Resultado_Status_Rejeitada: return "Rejeitado"; break;
		}
	}

	public static function converterStringParaStatus ( string $status)  {
		switch(strtolower( $status )) {
			case "aprovado" : return Status::Resultado_Status_Aprovada;
			case "rejeitado" : return Status::Resultado_Status_Rejeitada;
			case "pendente" : return Status::Resultado_Status_Pendente;
		}
  }
  
  public static function converterResultadoParaString( int $resultado ) {
    switch($resultado) {
      case  1: return "Positivo";
      case -1: return "Negativo";
      default: return "Not Found";
    }
  }

  // Getters
  public function getId():int {
    return $this->id;
  }

  public function getDataCadastro():DateTime {
    return $this->data_cadastro;
  }

  public function getResultado():int {
    return $this->resultado;
  }

  public function getStatus():int {
    return $this->status;
  }

  public function getPesquisadorId():int {
    return $this->pesquisador_id;
  }

  public function getCulturaId():int {
    return $this->cultura_id;
  }

  public function getReferenciaId():int {
    return $this->referencia_id;
  }

  public function getAvaliadorId():?int {
    return $this->avaliador_id;
  }

  public function getDataAvaliacao():?DateTime {
    return $this->data_avaliacao;
  }

  public function getComentario():?string {
    return $this->comentario;
  }

  public function getSubstancias():array {
    return $this->substancias;
  }

  public function getReferencia():Referencia {
    return $this->referencia;
  }

  public function getCultura():array {
    return $this->cultura;
  }

  public function getPesquisador():Usuario {
    return $this->pesquisador;
  }

  public function getAvaliador():?Usuario {
    return $this->avaliador;
  }

  // Setters
  public function setId(int $id) {
    $this->id = $id;
  }

  public function setDataCadastro(DateTime $data) {
    $this->data_cadastro = $data;
  }

  public function setResultado(int $resultado) {
    $this->resultado = $resultado;
  }

  public function setStatus(int $status) {
    $this->status = $status;
  }

  public function setPesquisadorId(int $id) {
    $this->pesquisador_id = $id;
  }

  public function setCulturaId(int $id) {
    $this->cultura_id = $id;
  }

  public function setReferenciaId(int $id){
    $this->referencia_id = $id;
  }

  public function setAvaliadorId(?int $id){
    $this->avaliador_id = $id;
  }

  public function setDataAvaliacao(?DateTime $data) {
    $this->data_avaliacao = $data;
  }

  public function setComentario(?String $comentario) {
    $this->comentario = $comentario;
  }

  public function setSubstancias( array $subs ) {
    $this->substancias = $subs;
  }

  public function setReferencia( Referencia $ref ) {
    $this->referencia = $ref;
  }
}
