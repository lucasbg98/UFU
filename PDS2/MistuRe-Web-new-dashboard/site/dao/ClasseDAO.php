<?php

require_once(__DIR__."/Connection.php");
require_once(__DIR__."/CRUD.interface.php");
require_once(__DIR__."/../model/Classe.php");

class ClasseDAO implements CRUD {

    public static function create ( $args ) {
        return self::inserirNovaClasse($args[0]);
    }

    public static function read ( $args ) {
        if($args[0] == "fetchAll"){
            return self::buscarTodasClasses(  );
        }
        else if($args[0] == "cla_id") {
          return self::buscarClasseEspecifica( $args[1] );
        }
    }
    
    public static function update ( $args ) {
        return self::atualizarClasse( $args[0] );
    }

    public static function delete ( $args ) {
        return self::excluirClasse ( $args[0] );
    }

    //Métodos protegidos

    //Função para criar uma nova categoria de substancia
    protected static function inserirNovaClasse( Classe $classe ) {
        try {
            $conn = Connection::getConn();

            $insert = $conn->prepare(
              'INSERT INTO classe (descricao, cor)
              VALUES ( ? , ? )'
            );

            $insert->bindValue(1,$classe->getDescricao());
            $insert->bindValue(2,$classe->getCor());

            return $insert->execute() ? $conn->lastInsertId():FALSE;
      
      } catch(Exception $e) {
        Connection::showLog($e->getMessage());
      }
    }

    //Função para realizar o update de uma categoria
    protected static function atualizarClasse( Classe $classe) {
        try {
            $conn = Connection::getConn();

            $update = $conn->prepare(
                'UPDATE classe
                 SET
                    descricao = ?
                    cor       = ?
                 WHERE
                    id = ?'
            );

            $update->bindValue(1,$classe->getDescricao());
            $update->bindValue(2,$classe->getCor());
            $update->bindValue(3,$classe->getId());

            $update->execute();
            
            //verificando a quantidade de linhas que foram atualizadas da tabela - se for zero provavelmente algo deu errado!
            return $update->rowCount() == '0' ? FALSE:TRUE;

        } catch(Exception $e) {
            Connection::showLog($e->getMessage());
        }
    }

    //Função para buscar todas as categorias existentes
    protected static function buscarTodasClasses (  ) {
        try {
            $conn = Connection::getConn();
      
            $sql = $conn->prepare(
              'SELECT * FROM classe'
            );
      
            $sql->execute();
            
            if($sql->rowCount() > 0) {
              $resultado = $sql->fetchAll();
              if($resultado) {
                $res = array();
                foreach($resultado as $r)
                {
                  $nova_classe = Classe::withRow($r);
                  array_push($res, $nova_classe);
                }
                
                return $res;
              }
              else {
                return "Erro";
              }
            }
            else
              echo "null";
                
        } catch(Exception $e) {
            Connection::showLog($e->getMessage());
        }
    }

    //Função pra buscar uma categoria pelo seu id
    protected static function buscarClasseEspecifica (int $cla_id) {
      try {
        $conn = Connection::getConn();
        
        $sql = $conn->prepare(
          "SELECT * FROM classe
           WHERE id = ?"
        );
        $sql->bindValue(1,$cla_id);
        
        $sql->execute();
        
        if( $sql->rowCount() > 0 ) {
          $resultado = $sql->fetch();//Pegando apenas 1 linha
          $classe = Classe::withRow($resultado);
          return $classe;
        }
  
      } catch(Exception $e) {
        Connection::showLog($e->getMessage());
      }
    }

    //Função para excluir uma categoria de substância
    protected static function excluirClasse ( int $cl_id ) {
      try {
        $conn = Connection::getConn();

        $delete = $conn->prepare(
          'DELETE FROM classe
          WHERE id = ?'
        );

          $delete->bindValue(1, $cl_id);

          $delete->execute();

          return $delete->rowCount() == '0' ? FALSE:TRUE;

      } catch ( Exception $e ) {
          Connection::showLog($e->getMessage());
      }
    }
}