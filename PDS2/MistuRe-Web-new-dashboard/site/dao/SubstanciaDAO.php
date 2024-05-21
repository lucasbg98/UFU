<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/CRUD.interface.php");
require_once(__DIR__ . "/../model/Substancia.php");

class SubstanciaDAO implements CRUD
{

  public static function create($args)
  {
    return self::inserirNovaSubstancia($args[0]);
  }

  public static function read($args)
  {
    switch ($args[0]) {
      case "fetchAll":
        return self::buscarTodasSubstancias();
      case "subs_id":
        return self::buscarSubstanciaEspecifica($args[1], $args[2]);
      case "mist_id":
        return self::buscarIdsDeMisturasQueUsamASubstancia($args[1]);
      case "mist_subs_id":
        return self::buscarSubstanciasDeMisturaEspecifica($args[1]);
      case "getSubsByMixtureOccurence":
        return self::buscarSubstanciaMaisUsadasEmMisturas($args[1], $args[2], $args[3]);
    }
  }

  public static function update($args)
  {
    return self::atualizarSubstancia($args[0]);
  }

  public static function delete($args)
  {
    return self::excluirSubstancia($args[0]);
  }

  //Métodos protegidos

  //Função para inserir uma nova Substância no banco de dados
  protected static function inserirNovaSubstancia(Substancia $nova_sub)
  {
    try {
      $conn = Connection::getConn();

      $insert = $sql = $conn->prepare(
        'INSERT INTO substancia (principio_ativo, classe_id)
				 VALUES ( ? , ? )'
      );

      $insert->bindValue(1, $nova_sub->getPrincipioAtivo());
      $insert->bindValue(2, $nova_sub->getClasse_id());


      if ($insert->execute()) {
        return Connection::getConn()->lastInsertId();
      } else {
        return FALSE;
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  //Função para buscar todas as Substâncias inseridas no banco de dados
  protected static function buscarTodasSubstancias()
  {
    try {
      $conn = Connection::getConn();

      $sql = $sql = $conn->prepare(
        'SELECT * FROM substancia
				 ORDER BY substancia.principio_ativo'
      );

      $sql->execute();

      if ($sql->rowCount() > 0) {
        $resultado = $sql->fetchAll();
        if ($resultado) {
          $res = array();
          foreach ($resultado as $r) {
            $nova_subs = Substancia::carregarObjeto("colunas_e_relacionamentos", $r);
            array_push($res, $nova_subs);
          }
          return $res;
        } else {
          return "Erro";
        }
      } else
        echo "null";
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  //Função para buscar uma substância específica e seus relacionamentos pelo seu id
  protected static function buscarSubstanciaEspecifica(int $subs_id, string $tipo_de_objeto): Substancia
  {
    try {
      $conn = Connection::getConn();

      $sql = $sql = $conn->prepare(
        "SELECT * FROM substancia
				 WHERE id = ?
				 LIMIT 1"
      );
      $sql->bindValue(1, $subs_id);

      $sql->execute();

      if ($sql->rowCount() > 0) {
        $resultado = $sql->fetch(); //Pegando apenas 1 linha
        return Substancia::carregarObjeto($tipo_de_objeto, $resultado);
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  //Função que busca, a partir do id da substancia, todas as misturas (apenas o id das misturas) que utilizam tal substancia
  protected static function buscarIdsDeMisturasQueUsamASubstancia(int $subs_id)
  {
    try {

      $conn = Connection::getConn();

      $sql = $sql = $conn->prepare(
        'SELECT ms.mistura_id
				 FROM mistura_substancia AS ms
					 JOIN substancia AS s ON ms.mistura_id = s.id 
				 WHERE s.id = ?'
      );

      $sql->bindValue(1, $subs_id);

      $sql->execute();

      //retornando ids de misturas ou FALSE caso nao encontre nada
      return $sql->rowCount() > 0 ? $sql->fetchAll() : FALSE;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function buscarSubstanciasDeMisturaEspecifica(int $mist_id)
  {
    try {
      $conn = Connection::getConn();

      $sql = $sql = $conn->prepare(
        "SELECT substancia.* FROM substancia
					JOIN mistura_substancia on substancia.id = mistura_substancia.substancia_id
				 WHERE mistura_substancia.mistura_id = ?"
      );
      $sql->bindValue(1, $mist_id);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        $resultado = $sql->fetchAll();
        if ($resultado) {
          $res = array();
          foreach ($resultado as $r) {
            $nova_subs = Substancia::carregarObjeto("colunas_e_relacionamentos", $r);
            array_push($res, $nova_subs);
          }
          return $res;
        } else {
          return "Erro";
        }
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function buscarSubstanciaMaisUsadasEmMisturas(String $orderBy, String $orderDirection, ?int $resultadoStatus)
  {
    $conn = Connection::getConn();

    $resultFilter = isset($resultadoStatus) ? "and r.status = " . $resultadoStatus : "";
    $orderResult = $orderBy . " " . $orderDirection;

    $sql = $conn->prepare(sprintf('
      SELECT 
        s.id,
        s.principio_ativo,
        (SELECT count(*) FROM mistura inner join resultado r on r.id = mistura.resultado_id where mistura.substancia_id = s.id %s) as qtd
      FROM substancia s
      GROUP BY s.id
      ORDER BY %s 
    ', $resultFilter, $orderResult));

    $sql->bindValue(1, $orderDirection);

    $res = $sql->execute();

    //Verificando se sql deu certo e encontrou pelo menos 1 resultado
    if ($res == 1 && $sql->rowCount() > 0) {
      $subs = array();
      foreach ($sql->fetchAll() as $key => $value) {
        array_push($subs, array("id" => $value["id"], "principioAtivo" => $value["principio_ativo"], "count" => $value["qtd"]));
      }

      return $subs;
    } else {
      return [];
    }
  }

  //Função para atualizar uma substancia 
  protected static function atualizarSubstancia(Substancia $substancia)
  {
    try {
      $conn = Connection::getConn();

      $atualizar = $sql = $conn->prepare(
        ' UPDATE substancia
				SET 
				  principio_ativo         = ?
				  classe_id = ?
				WHERE
				  id = ?'
      );

      $atualizar->bindValue(1, $substancia->getPrincipioAtivo());
      $atualizar->bindValue(2, $substancia->getClasse_id());
      $atualizar->bindValue(3, $substancia->getId());

      $atualizar->execute();

      //Verificando a quantidade de linhas que foram alteradas pela query escrita no método "$sql = $conn->prepare('*string*');"
      return $atualizar->rowCount() == '0' ? FALSE : TRUE;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  //Função para excluir uma substancia pelo seu id
  protected static function excluirSubstancia(int $subs_id)
  {
    try {
      $conn = Connection::getConn();

      $delete = $conn->prepare(
        'DELETE FROM substancia
			   WHERE id = ?'
      );

      $delete->bindValue(1, $subs_id);

      $delete->execute();

      return $delete->rowCount() == '0' ? FALSE : TRUE;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }
}
