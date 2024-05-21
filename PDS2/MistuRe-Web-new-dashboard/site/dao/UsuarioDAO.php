<?php

require_once(__DIR__ . "/Connection.php");
require_once(__DIR__ . "/CRUD.interface.php");
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO implements CRUD
{

  public static function create($args)
  {
  }

  public static function read($args)
  {
    if ($args[0] == "user_id") {
      return self::buscarUsuarioPorId($args[1]);
    } else if ($args[0] == "login") {
      return self::buscarUsuarioPorEmailSenha($args[1], $args[2]);
    } else if ($args[0] == "findByProfile") {
      return self::buscarUsuarioPorPerfil($args[1]);
    }
  }

  public static function update($args)
  {
    return self::atualizarUsuario($args[0]);
  }

  public static function delete($args)
  {
  }

  //Métodos protegidos

  //Função para buscar usuário pelo seu id
  protected static function buscarUsuarioPorId(int $user_id)
  {
    $conn = Connection::getConn();

    $sql = $conn->prepare(
      "SELECT * FROM usuario
			 WHERE id = ?"
    );
    $sql->bindValue(1, $user_id);

    $res = $sql->execute();
    if ($res == 1) {
      if ($sql->rowCount() > 0)
        return Usuario::completeObject($sql->fetchAll()[0]);
      else
        return NULL;
    }
  }

  //Função para verificar login, buscando um usuário por email e senha
  protected static function buscarUsuarioPorEmailSenha(string $email, string $senha)
  {
    $conn = Connection::getConn();

    $sql = $conn->prepare(
      "SELECT * FROM usuario
				WHERE email = ? AND senha = ?"
    );
    $sql->bindValue(1, $email);
    $sql->bindValue(2, $senha);

    $res = $sql->execute();

    if ($res == 1) {
      if ($sql->rowCount() > 0)
        return Usuario::completeObject($sql->fetch());
      else
        return NULL;
    }
  }

  //Função que retorna todos os usuarios que tem a permissao informada no parametro
  protected static function buscarUsuarioPorPerfil(String $profile_name)
  {
    try {
      $conn = Connection::getConn();
      $query = "
			select u.* from usuario as u 
					join perfil as p on p.id = u.perfil_id
      where p.descricao = '{$profile_name}'
			";

      $sql = $conn->prepare($query);

      $res = $sql->execute();
      if ($res) {
        $users = array();
        foreach ($sql->fetchAll() as $r) {
          $usuario = Usuario::completeObject($r);
          array_push($users, $usuario);
        }
        return $users;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //Função para atualizar dados do usuário
  protected static function atualizarUsuario(Usuario $usuario)
  {
    try {
      $conn = Connection::getConn();

      $atualizar = $conn->prepare(
        '	UPDATE usuario
			   	SET
					email     = ?
					senha     = ?
					nome      = ?
					perfil_id = ?
				WHERE
					id = ?'
      );

      $atualizar->bindValue(1, $usuario->getEmail());
      $atualizar->bindValue(2, $usuario->getSenha());
      $atualizar->bindValue(3, $usuario->getNome());
      $atualizar->bindValue(4, $usuario->getPerfil());

      $atualizar->execute();

      //Verificando a quantidade de linhas que foram alteradas pela query escrita no método "$conn->prepare('*string*');"
      return $atualizar->rowCount() == '0' ? FALSE : TRUE;
    } catch (Exception $e) {
      Connection::showLog($e->getMessage());
    }
  }
}
