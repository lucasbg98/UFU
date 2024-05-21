<?php

require_once(__DIR__."/Connection.php");
require_once(__DIR__."/CRUD.interface.php");
require_once(__DIR__."/../model/Parceria.php");

class ParceriaDAO implements CRUD {
  public static function create( $args ) {
    return self::createPartnership($args[0]);
  }

  public static function read( $args ){
    switch($args[0]) {
      case "readAll": return self::getAll();
      case "getOne": return self::getById($args[1]);
    }
  }

  public static function update( $args ) {
		switch($args[0]) {
			case "updatePartnership": return self::updatePartnership($args[1]);
		}
  }

  public static function delete( $args ) {
    if($args[0] == "deleteById") return self::deleteById($args[1]);
  }

  protected static function createPartnership(Parceria $p) {
    try {
			$conn = Connection::getConn();

			$insert = $conn->prepare(
				'INSERT INTO parceria (nome, logo_url, periodo_inicial, periodo_final, link)
				 VALUES (?, ?, ?, ?, ?)'
			);

			$insert->bindValue(1,$p->getNome());
			$insert->bindValue(2,$p->getLogoUrl());
			$insert->bindValue(3,$p->getPeriodoInicial());
			$insert->bindValue(4,$p->getPeriodoFinal());
			$insert->bindValue(5,$p->getLink());
			
			$res = $insert->execute();
			
			if($res) {
				return $conn->lastInsertId();
			}
			else {
        echo $insert->debugDumpParams();
				return False;
			}            
		} catch(Exception $e) {
			return Status::Cadastro_Erro_No_Banco_De_Dados;
		}
  }

  protected static function getAll():?array {
      try {
        $conn = Connection::getConn();
        $date = new DateTime("now", new DateTimeZone('America/New_York'));
        $current_date = $date->format('Y-m-d');

        $query = "SELECT * FROM parceria 
          WHERE periodo_inicial <= '{$current_date}' and (periodo_final is null OR periodo_final >= '{$current_date}')
          ORDER BY periodo_inicial ASC ";

        $sql = $conn->prepare($query);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
          $resultado = array();
          foreach($sql->fetchAll() as $key => $p) {
            array_push($resultado, Parceria::carregarObjeto(
              'colunas', $p
            ));
          }
          return $resultado;
        }
        else return [];
      } catch (Exception $e) {
        echo $query;
      }
  }

  protected static function getById(int $id) {
		$conn = Connection::getConn();

		$sql = $conn->prepare(
			"SELECT * FROM parceria
			 WHERE id = ?"
		);
		$sql->bindValue(1, $id);

		$res = $sql->execute();
		if($res == 1) {
			if($sql->rowCount() > 0) 
				return Parceria::carregarObjeto("colunas", $sql->fetch());
			else
				return NULL;
		}
  }

  protected static function updatePartnership(Parceria $p) {
    try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				"UPDATE parceria
				 SET
					nome = ?,
					logo_url = ?,
					periodo_inicial = ?,
					periodo_final = ?,
					link = ?
				 WHERE
				 	id = ?"
			);

			$sql->bindValue(1, $p->getNome());
			$sql->bindValue(2, $p->getLogoUrl());
			$sql->bindValue(3, $p->getPeriodoInicial());
			$sql->bindValue(4, $p->getPeriodoFinal());
			$sql->bindValue(5, $p->getLink());
			$sql->bindValue(6, $p->getId());
			$res = $sql->execute();

			// $sql->debugDumpParams();

			if($res && $sql->rowCount() > 0) {
				return true;
			}
			else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
		}
  }
  
  protected static function deleteById(int $id) {
    try {
			$conn = Connection::getConn();
	
			$delete = $conn->prepare(
			  'DELETE FROM parceria
			   WHERE id = ?'
			);
	
			$delete->bindValue(1, $id);
	
			$delete->execute();
	
			return $delete->rowCount() == '0' ? FALSE:TRUE;
	
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
  }
}