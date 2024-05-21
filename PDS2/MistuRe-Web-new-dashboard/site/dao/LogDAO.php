<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "../../model/Log.php");

date_default_timezone_set('America/Sao_Paulo');

class LogDAO
{
  public static function create($args)
  {
    return self::inserirNovoLog($args);
  }

  public static function read($args)
  {
    switch ($args[0]) {
      case "getByPeriod":
        return self::filterByPeriod($args[1], $args[2], $args[3]);
    }
  }

  protected static function inserirNovoLog(Log $res)
  {
    try {
      $conn = Connection::getConn();

      $insert = $conn->prepare(
        'INSERT INTO log (
					request,
					response,
					user_id
				)
				 VALUES (?, ?, ?)'
      );

      $insert->bindValue(1, $res->getRequest());
      $insert->bindValue(2, $res->getResponse());
      $insert->bindValue(3, $res->getUserId());

      $res = $insert->execute();

      if ($res) {
        return $conn->lastInsertId();
      } else {
        return False;
      }
    } catch (Exception $e) {
      return Status::Cadastro_Erro_No_Banco_De_Dados;
    }
  }

  protected static function filterByPeriod(String $start, String $end, ?String $result)
  {
    try {
      $conn = Connection::getConn();

      $sql = "SELECT * FROM log
      WHERE criado_em between ? and ?";

      if (isset($result)) {
        $sql = $sql . " AND response = " . "'" . $result . "'";
      }

      $select = $conn->prepare($sql);

      $select->bindValue(1, $start);
      $select->bindValue(2, $end);

      $select->execute();

      if ($select->rowCount() > 0) {
        $resultado = array();

        foreach ($select->fetchAll() as $key => $ref) {
          array_push($resultado, Log::carregarObjeto("colunas", $ref));
        }

        return $resultado;
      }

      return [];
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
