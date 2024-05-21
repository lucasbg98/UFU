<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/CRUD.interface.php");
require_once(__DIR__ . "../../model/Mistura.php");

class MisturaDAO implements CRUD
{
  public static function create($args)
  {
    return self::inserirNovaMistura($args[0]);
  }

  public static function read($args)
  {
    switch ($args[0]) {
      case "getByResultId":
        return self::getMisturasPeloIdDoResultado($args[1]);
      case "verifyMixtureThatUsesSubstance":
        return self::quantidadeDeMisturasQueUsamSubstancia($args[1]);
    }
  }

  public static function update($args)
  {
  }

  public static function delete($args)
  {
    switch ($args[0]) {
      case "deleteByResultId":
        return self::excluirMisturaPeloIdDoResultado($args[1]);
    }
  }

  protected static function inserirNovaMistura(Mistura $mis)
  {
    try {
      $conn = Connection::getConn();

      $insert = $conn->prepare(
        'INSERT INTO mistura 
				 VALUES ( ?, ?, ?, ?, ?)'
      );

      $insert->bindValue(1, $mis->getSubstanciaId());
      $insert->bindValue(2, $mis->getResultadoId());
      $insert->bindValue(3, $mis->getDosagemSubstancia());
      $insert->bindValue(4, $mis->getDosagemComercial());
      $insert->bindValue(5, $mis->getNomeComercialId());
      $res = $insert->execute();


      if ($res) {
        return `{$mis->getSubstanciaId()};{$mis->getResultadoId()}`;
      } else {
        return False;
      }
    } catch (Exception $e) {
      return Status::Cadastro_Erro_No_Banco_De_Dados;
    }
  }

  protected static function getMisturasPeloIdDoResultado(int $res_id): array
  {
    require_once(__DIR__ . "/../model/Mistura.php");

    $conn = Connection::getConn();
    $sql = $conn->prepare('
      select * from mistura
      where mistura.resultado_id = ?;
    ');

    $sql->bindValue(1, $res_id);
    $sql->execute();

    $resultado = $sql->fetchAll();

    if ($resultado) {
      $res = array();
      foreach ($resultado as $r) {
        $mist =  Mistura::carregarObjeto("colunas_e_relacionamentos", $r);
        array_push($res, $mist);
      }
      return $res;
    } else {
      return [];
    }
  }

  protected static function excluirMisturaPeloIdDoResultado(int $res_id)
  {
    try {
      $conn = Connection::getConn();

      $delete = $conn->prepare(
        'DELETE FROM mistura
			   WHERE resultado_id = ?'
      );

      $delete->bindValue(1, $res_id);

      $delete->execute();

      return $delete->rowCount() == '0' ? FALSE : TRUE;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  protected static function quantidadeDeMisturasQueUsamSubstancia(int $sub_id)
  {
    try {
      $conn = Connection::getConn();

      $select = $conn->prepare(
        'SELECT * FROM mistura
			   WHERE substancia_id = ?'
      );

      $select->bindValue(1, $sub_id);

      $select->execute();
      return $select->rowCount();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
