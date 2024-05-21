<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/../model/Perfil.php");
require_once(__DIR__ . "/CRUD.interface.php");

class PerfilDAO implements CRUD
{

  public static function create($args)
  {
  }

  public static function read($args)
  {
    if ($args[0] == "perfil_id") {
      return self::buscarPerfilPorId($args[1]);
    } else if ($args[0] == "perfil_descricao") {
      return self::buscarPerfilPorDescricao($args[1]);
    } else if ($args[0] == "getAll") {
      return self::buscarTodosOsPerfis($args[1]);
    }
  }

  public static function update($args)
  {
  }

  public static function delete($args)
  {
  }

  //Métodos protegidos

  //Função para buscar um perfil específico pelo seu id
  protected static function buscarPerfilPorId(int $perfil_id)
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        "SELECT * FROM perfil
				WHERE id = ?"
      );
      $sql->bindValue(1, $perfil_id);

      $res = $sql->execute();

      if ($res == 1) {
        if ($sql->rowCount() > 0) {
          return Perfil::completeObject($sql->fetchAll()[0]);
        } else
          return NULL;
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function buscarPerfilPorDescricao(string $perfil_descricao)
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        "SELECT * FROM perfil
				WHERE descricao = ?"
      );
      $sql->bindValue(1, $perfil_descricao);

      $res = $sql->execute();

      if ($res == 1) {
        if ($sql->rowCount() > 0) {
          return Perfil::completeObject($sql->fetchAll()[0]);
        } else
          return NULL;
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function buscarTodosOsPerfis(string $origin)
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        "SELECT * FROM perfil
          where origin = ?
          order by descricao ASC"
      );

      $sql->bindValue(1, $origin);

      $res = $sql->execute();

      if ($res == 1) {
        if ($sql->rowCount() > 0) {
          $arr = array();
          foreach ($sql->fetchAll() as $key => $row) {
            array_push($arr, Perfil::completeObject($row));
          }

          return $arr;
        } else
          return [];
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }
}
