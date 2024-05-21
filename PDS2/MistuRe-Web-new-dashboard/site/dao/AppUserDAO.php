<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/CRUD.interface.php");
require_once(__DIR__ . "/../model/AppUser.php");

class AppUserDAO implements CRUD
{
  public static function create($args)
  {
    return self::inserirNovoAppUser($args);
  }

  public static function read($args)
  {
    switch ($args[0]) {
      case "getById":
        return self::buscarUserPeloId($args[1]);
      case "getByEmail":
        return self::buscarUserPeloEmail($args[1]);
    }

    return null;
  }

  public static function update($args)
  {
    return self::atualizarAppUser($args);
  }

  public static function delete($args)
  {
  }

  protected static function buscarUserPeloEmail(String $email): ?AppUser
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        "SELECT * FROM app_user
				 WHERE LOWER(email) = LOWER(?)
				 LIMIT 1"
      );
      $sql->bindValue(1, $email);

      $sql->execute();

      if ($sql->rowCount() > 0) {
        $resultado = $sql->fetch(); //Pegando apenas 1 linha
        return AppUser::completeObject($resultado);
      }

      return null;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function buscarUserPeloId(String $id): ?AppUser
  {
    try {
      $conn = Connection::getConn();

      $sql = $conn->prepare(
        "SELECT * FROM app_user
				 WHERE id = ?"
      );
      $sql->bindValue(1, $id);

      $sql->execute();

      if ($sql->rowCount() > 0) {
        $resultado = $sql->fetch(); //Pegando apenas 1 linha
        return AppUser::completeObject($resultado);
      }

      return null;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function inserirNovoAppUser(AppUser $user): ?AppUser
  {
    try {
      $conn = Connection::getConn();

      $insert = $conn->prepare(
        'INSERT INTO app_user (uf, nome, email, cidade, perfil_id)
				 VALUES (LOWER(?), LOWER(?), LOWER(?), LOWER(?), ?)'
      );

      $insert->bindValue(1, $user->getUf());
      $insert->bindValue(2, $user->getNome());
      $insert->bindValue(3, $user->getEmail());
      $insert->bindValue(4, $user->getCidade());
      $insert->bindValue(5, $user->getPerfilId());


      if ($insert->execute()) {
        $user->setId(Connection::getConn()->lastInsertId());
        return $user;
      } else {
        return null;
      }
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }

  protected static function atualizarAppUser(AppUser $user)
  {
    try {
      $conn = Connection::getConn();

      $atualizar = $conn->prepare(
        'UPDATE app_user
				SET 
				  uf = UPPER(?),
				  nome = LOWER(?),
				  cidade = LOWER(?),
				  perfil_id = ?
				WHERE
				  id = ?'
      );

      $atualizar->bindValue(1, $user->getUf());
      $atualizar->bindValue(2, $user->getNome());
      $atualizar->bindValue(3, $user->getCidade());
      $atualizar->bindValue(4, $user->getPerfilId());
      $atualizar->bindValue(5, $user->getId());

      $atualizar->execute();

      //Verificando a quantidade de linhas que foram alteradas pela query escrita no método "$sql = $conn->prepare('*string*');"
      return $atualizar->rowCount() == 1 ? self::buscarUserPeloId($user->getId()) : null;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }
}
