<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/CRUD.interface.php");
require_once(__DIR__ . "../../model/Resultado.php");

class ResultadoDAO implements CRUD
{
  public static function create($args)
  {
    return self::inserirNovoResultado($args[0]);
  }
  public static function read($args)
  {
    switch ($args[0]) {
      case "filter":
        return self::filtrarResultados($args[1]);
      case "status":
        return self::buscarResultadosPeloStatus($args[1], $args[2], $args[3]);
      case "findById":
        return self::buscarResultadoPeloId($args[1]);
    }
  }
  public static function update($args)
  {
    switch ($args[0]) {
      case "avaliarReferencia":
        return self::avaliarReferencia($args[1], $args[2], $args[3]);
      case "atualizarResultado":
        return self::atualizarResultado($args[1]);
      case "atualizarStatus":
        return self::atualizarStatus($args[1], $args[2], $args[3]);
    }
  }
  public static function delete($args)
  {
    return self::deletarResultadoPeloId($args[0]);
  }

  protected static function inserirNovoResultado(Resultado $res)
  {
    try {
      $conn = Connection::getConn();

      $insert = $conn->prepare(
        'INSERT INTO resultado (
					data_cadastro,
					resultado,
					status,
					pesquisador_id,
					cultura_id,
					referencia_id,
					avaliador_id,
					data_avaliacao,
					comentario
				)
				 VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)'
      );

      $insert->bindValue(1, $res->getDataCadastro()->format('Y-m-d H:i:s'));
      $insert->bindValue(2, $res->getResultado());
      $insert->bindValue(3, $res->getStatus());
      $insert->bindValue(4, $res->getPesquisadorId());
      $insert->bindValue(5, $res->getCulturaId());
      $insert->bindValue(6, $res->getReferenciaId());
      $insert->bindValue(7, $res->getAvaliadorId());
      $insert->bindValue(
        8,
        $res->getDataAvaliacao() != null
          ? $res->getDataAvaliacao()->format('Y-m-d H:i:s')
          : null
      );
      $insert->bindValue(9, $res->getComentario());
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

  protected static function filtrarResultados(array $filters)
  {
    require_once(__DIR__ . "/../model/Resultado.php");

    try {
      if (isset($filters["subs"])) {
        $subs_like = "%";
        $comercial = "";

        foreach ($filters["subs"] as $key => $rs) {
          $aux_sub_id = $rs["sub_id"];
          $subs_like = ($subs_like . $aux_sub_id . ";");
          $comercial = $comercial . (isset($rs["nc_id"]) ? $rs["nc_id"] . ";" : "");
        }

        $subs_like = substr($subs_like, 0, -1) . "%";
        $comercial = preg_match('/\\d/', $comercial) > 0 ? "%" . substr($comercial, 0, -1) . "%" : null;
        $comercial_like = isset($comercial) ? "AND (comercial like '" . $comercial . "' OR comercial is null)" : "";

        $having = "having subs like '{$subs_like}' {$comercial_like}";
      } else
        $having = null;

      $where = "where m.resultado_id = m.resultado_id";

      if (isset($filters['status']) && $filters['status'] != '')
        $where = "where rs.status = {$filters['status']}";

      if (isset($filters["pesquisador"]) && $filters["pesquisador"] != '') {
        $where = $where . " AND rs.pesquisador_id = {$filters["pesquisador"]}";
      }

      if (isset($filters["avaliador"]) && $filters["avaliador"] != '') {
        $where = $where . " AND rs.avaliador_id = {$filters["avaliador"]}";
      }

      if (isset($filters["link"]) && $filters["link"] != '') {
        $where = $where . " AND r.link = '{$filters["link"]}'";
      }

      $conn = Connection::getConn();
      $query = "
			select 
				rs.*,
				GROUP_CONCAT(m.substancia_id order by m.substancia_id separator ';') as subs,
				GROUP_CONCAT(m.nome_comercial_id order by m.nome_comercial_id separator ';') as comercial
			from mistura m
					inner join substancia s on m.substancia_id = s.id
					inner join resultado rs on m.resultado_id = rs.id
					inner join referencia r on r.id = rs.referencia_id
			{$where}
      group by m.resultado_id
      {$having}
			";
      //echo $query;
      $sql = $conn->prepare($query);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        $resultado = array();
        foreach ($sql->fetchAll() as $key => $ref) {
          array_push($resultado, Resultado::carregarObjeto("colunas_e_relacionamentos", $ref));
        }
        return $resultado;
      } else return [];
    } catch (Exception $e) {
      echo $query;
    }
  }

  protected static function buscarResultadosPeloStatus(int $status, string $orderBy, int $limit)
  {
    try {
      $conn = Connection::getConn();
      $query =
        " SELECT * FROM resultado
				WHERE status = {$status}
				ORDER BY {$orderBy}
				LIMIT {$limit}";

      $sql = $conn->prepare($query);
      $sql->execute();

      $retorno = array();

      if ($sql->rowCount() > 0) {
        $resultado = $sql->fetchAll();
        if ($resultado) {
          foreach ($resultado as $r) {
            $res = Resultado::carregarObjeto("colunas_e_relacionamentos", $r);
            array_push($retorno, $res);
          }
        }
      }
      return $retorno;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  protected static function buscarResultadoPeloId(int $id)
  {
    $conn = Connection::getConn();

    $sql = $conn->prepare(
      "SELECT * FROM resultado
			 WHERE id = ?"
    );
    $sql->bindValue(1, $id);

    $res = $sql->execute();
    if ($res == 1) {
      if ($sql->rowCount() > 0)
        return Resultado::carregarObjeto("colunas_e_relacionamentos", $sql->fetch());
      else
        return NULL;
    }
  }

  protected static function atualizarResultado(Resultado $res)
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        "UPDATE resultado
				 SET
					resultado = ?,
					pesquisador_id = ?,
					avaliador_id = ?,
					cultura_id = ?,
					referencia_id = ?,
					comentario = ?
				 WHERE
				 	resultado.id = ?"
      );

      $sql->bindValue(1, $res->getResultado());
      $sql->bindValue(2, $res->getPesquisadorId());
      $sql->bindValue(3, $res->getAvaliadorId());
      $sql->bindValue(4, $res->getCulturaId());
      $sql->bindValue(5, $res->getReferenciaId());
      $sql->bindValue(6, $res->getComentario());
      $sql->bindValue(7, $res->getId());
      $res = $sql->execute();

      if ($res && $sql->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  protected static function avaliarReferencia(int $ref_id, int $avaliacao_status, int $avaliador_id)
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        'UPDATE resultado
				SET
					resultado.status = ?,
					resultado.data_avaliacao = now(),
					resultado.avaliador_id = ?
				WHERE
					resultado.id = ?'
      );

      $sql->bindValue(1, $avaliacao_status);
      $sql->bindValue(2, $avaliador_id);
      $sql->bindValue(3, $ref_id);

      $res = $sql->execute();

      if ($res && $sql->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      return "erro";
    }
  }
  protected static function atualizarStatus(int $refId, int $novoStatus, int $avaliadorId)
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        'UPDATE resultado
				SET
					resultado.status = ?,
					resultado.data_avaliacao = null,
					resultado.avaliador_id = ?
				WHERE
					resultado.id = ?'
      );

      $sql->bindValue(1, $novoStatus);
      $sql->bindValue(2, $avaliadorId);
      $sql->bindValue(3, $refId);

      $res = $sql->execute();

      if ($res && $sql->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      return "erro";
    }
  }

  protected static function deletarResultadoPeloId(int $res_id)
  {
    try {
      $conn = Connection::getConn();

      $delete = $conn->prepare(
        'DELETE FROM resultado
			   WHERE id = ?'
      );

      $delete->bindValue(1, $res_id);

      $delete->execute();

      return $delete->rowCount() == '0' ? FALSE : TRUE;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
