<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/CRUD.interface.php");

class CulturaDAO implements CRUD
{
  public static function create($args)
  {
  }

  public static function read($args)
  {
    switch ($args[0]) {
      case "desc_by_id":
        return self::buscarDescricaoPorId($args[1]);
      case "findAll":
        return self::buscarTodasAsCulturas();
      case "getByResultOccurence":
        return self::buscarCulturasMaisUsadasEmResultados($args[1], $args[2], $args[3]);
    }
  }
  public static function update($args)
  {
  }

  public static function delete($args)
  {
  }

  protected static function buscarDescricaoPorId(int $cult_id)
  {
    $conn = Connection::getConn();

    $sql = $conn->prepare(
      'SELECT cultura.* FROM cultura
          WHERE cultura.id = ?'
    );

    $sql->bindValue(1, $cult_id);

    $res = $sql->execute();

    //Verificando se sql deu certo e encontrou pelo menos 1 resultado
    if ($res == 1 && $sql->rowCount() > 0) {
      $classe = $sql->fetch();
      return array("id" => $classe["id"], "descricao" => $classe["descricao"]);
    }
  }

  protected static function buscarTodasAsCulturas()
  {
    $conn = Connection::getConn();

    $sql = $conn->prepare(
      'SELECT cultura.* FROM cultura'
    );

    $res = $sql->execute();

    //Verificando se sql deu certo e encontrou pelo menos 1 resultado
    if ($res == 1 && $sql->rowCount() > 0) {
      $classes = array();
      foreach ($sql->fetchAll() as $key => $value) {
        array_push($classes, array("id" => $value["id"], "descricao" => $value["descricao"]));
      }
      return $classes;
    } else {
      $sql->debugDumpParams();
    }
  }

  protected static function buscarCulturasMaisUsadasEmResultados(
    String $orderBy,
    String $orderDirection,
    ?int $resultadoStatus
  ) {
    $conn = Connection::getConn();

    $resultFilter = isset($resultadoStatus) ? "and resultado.status = " . $resultadoStatus : "";
    $orderResult = $orderBy . " " . $orderDirection;

    $sql = $conn->prepare(sprintf('
      SELECT 
        c.id, c.descricao, 
        (
          select count(*)
          from resultado 
          where resultado.cultura_id = c.id %s) as qtd
      from cultura c
      group by c.id
      ORDER BY %s
    ', $resultFilter, $orderResult));

    $res = $sql->execute();

    //Verificando se sql deu certo e encontrou pelo menos 1 resultado
    if ($res == 1 && $sql->rowCount() > 0) {
      $classes = array();
      foreach ($sql->fetchAll() as $key => $value) {
        array_push($classes, array("id" => $value["id"], "descricao" => $value["descricao"], "count" => $value["qtd"]));
      }

      return $classes;
    } else {
      return [];
    }
  }
}
