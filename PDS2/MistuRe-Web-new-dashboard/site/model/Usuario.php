<?php

require_once(__DIR__ . "/../dao/PerfilDAO.php");
require_once(__DIR__ . "/../assets/php/Permissoes.php");
require_once(__DIR__ . "/./Perfil.php");

class Usuario
{

  private int $id;
  private String $email;
  private String $senha;
  private String $nome;
  private Perfil $perfil;

  function __construct()
  {
  }

  public static function loginObject(String $email, String $senha)
  {
    $instance = new static();
    $instance->email = $email;
    $instance->senha = $senha;

    return $instance;
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
    $this->email = $row["email"];
    $this->senha = $row["senha"];
    $this->nome = $row["nome"];
    $this->perfil = PerfilDAO::read(array("perfil_id", $row["perfil_id"]));
  }

  public function verificarPermissao($indice_da_permissao)
  {
    $user_perm = $this->getPerfil()->getPermissao();
    

    return $user_perm[$indice_da_permissao] == 1;
  }

  public static function converterPermissaoParaIndice(string $permissao)
  {
    switch ($permissao) {
      case "avaliar_resultado":
        return Permissoes::Avaliar_Resultado;
      case "editar_resultado":
        return Permissoes::Editar_Resultado;
      case "excluir_resultado":
        return Permissoes::Excluir_Resultado;
      case "excluir_substancia":
        return Permissoes::Excluir_Substancia;
      case "cadastrar_parceria":
        return Permissoes::Cadastrar_Parceria;
      case "excluir_parceria":
        return Permissoes::Excluir_Parceria;
      case "editar_parceria":
        return Permissoes::Editar_Parceria;
      case "dashboard":
        return Permissoes::Dashboard;
    }

    return -1; //permissão não encontrada
  }

  public function jsonSerialize()
  {
    $vars = get_object_vars($this);

    return $vars;
  }

  public static function jsonSerializeList(array $usuario)
  {
    $res = array();

    foreach ($usuario as $u) {
      array_push($res, $u->jsonSerialize());
    }
    return $res;
  }

  //getters
  function getId(): int
  {
    return $this->id;
  }

  function getNome(): String
  {
    return $this->nome;
  }

  function getEmail(): String
  {
    return $this->email;
  }

  function getSenha(): String
  {
    return $this->senha;
  }

  function getPerfil(): Perfil
  {
    return $this->perfil;
  }

  //setters
  function setId(int $id)
  {
    $this->id = $id;
  }

  function setNome(String $nome)
  {
    $this->nome = $nome;
  }

  function setEmail(String $email)
  {
    $this->email = $email;
  }

  function setSenha(String $senha)
  {
    $this->senha = $senha;
  }

  function setPerfil(Perfil $perfil)
  {
    $this->perfil = $perfil;
  }
}
