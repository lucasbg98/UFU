<?php

require_once(__DIR__."/Connection.php");
require_once(__DIR__."/CRUD.interface.php");
require_once(__DIR__."/../model/Referencia.php");

class ReferenciaDAO implements CRUD {

    public static function create ( $args ) {
        return self::inserirNovaReferencia ( $args[0] );
    }
    
    public static function read ( $args ) {
		switch($args[0]) {
			case "findByLink": return self::buscarReferenciaPeloLink($args[1]);
			case "findById": 	return self::buscarReferenciaPorId($args[1]);
			case "status": 		return self::buscarReferenciasPorStatus( $args[1],$args[2], $args[3] );
		}
	}
    
    public static function update ( $args ) {
			switch($args[0]) {
				case "update": return self::atualizarReferencia($args[1]);
			}
		}

    public static function delete ( $args ) {
        return self::excluirReferencia ($args[0]);
	}
	
	//Métodos protegidos

	//Função para inserir uma referência para uma mistura já existente
	protected static function inserirNovaReferencia ( Referencia $nova_ref ): int {
		try {
			$conn = Connection::getConn();

			$insert = $conn->prepare(
				'INSERT INTO referencia (link, pais, titulo)
				 VALUES ( ?, ?, ?)'
			);

			$insert->bindValue(1,$nova_ref->getLink());
			$insert->bindValue(2,$nova_ref->getPais());
			$insert->bindValue(3,$nova_ref->getTitulo());
			$res = $insert->execute();
			
			if($res) {
				return $conn->lastInsertId();
			}
			else {
				return False;
			}            

        } catch(Exception $e) {
			return Status::Cadastro_Erro_No_Banco_De_Dados;
		}
	}

	//Método que retorna o objeto referencia completo com o id passado no parâmetro
	protected static function buscarReferenciaPorId ( int $ref_id ): Referencia {
		try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				'SELECT referencia.* FROM referencia
				WHERE referencia.id = ?'
			);

			$sql->bindValue(1, $ref_id);

			$res = $sql->execute();

			//Verificando se sql deu certo e encontrou pelo menos 1 resultado
			if($res == 1 && $sql->rowCount() > 0) {
				return Referencia::carregarObjeto("apenas_colunas", $sql->fetch());
			}
			else {
				$sql->debugDumpParams();
				echo "\nErro ao buscar mistura específica";
			}
		} catch(Exception $e) {
				echo $e->getMessage();
		}
	}

	protected static function buscarReferenciasPorStatus ( int $status, string $orderBy,  int $limit ): array {
		try {
			$conn = Connection::getConn();
			$query =
			" SELECT referencia.* FROM referencia
				WHERE referencia.status = {$status}
				ORDER BY {$orderBy}
				LIMIT {$limit}";
	  
			$sql = $conn->prepare($query);
			$sql->execute();
			
			$retorno = array();

			if($sql->rowCount() > 0) {
			  	$resultado = $sql->fetchAll();
			  	if($resultado) {
					foreach($resultado as $r)
					{
					  $nova_mistura = Referencia::carregarObjeto("colunas_e_relacionamentos", $r);
					  array_push($retorno, $nova_mistura);
					}
				}
			}	
			return $retorno;
		} catch(Exception $e) {
			Connection::showLog($e->getMessage());
		}
	}

	protected static function buscarReferenciaPeloLink(String $link) {
		try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				'SELECT referencia.* FROM referencia
				 WHERE referencia.link = ?'
			);

			$sql->bindValue(1, $link);

			$res = $sql->execute();
			
			//Verificando se sql deu certo e encontrou pelo menos 1 resultado
			if($res == 1 && $sql->rowCount() > 0) {
				return Referencia::carregarObjeto("apenas_colunas", $sql->fetch());
			}
			else {
				return false;
			}

		} catch(Exception $e) {
				echo $e->getMessage();
		}
	}

	protected static function atualizarReferencia(Referencia $ref) {
		try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				'UPDATE referencia
				 SET
				 	link = ?,
					pais = ?,
					titulo = ?
				 WHERE
				 	referencia.id = ?'
			);

			$sql->bindValue(1, $ref->getLink());
			$sql->bindValue(2, $ref->getPais());
			$sql->bindValue(3, $ref->getTitulo());
			$sql->bindValue(4, $ref->getId());
			$res = $sql->execute();

			//$sql->debugDumpParams();

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

	//Função para atualizar uma referência
	/*protected static function atualizarReferencia ( Referencia $ref ): bool {
		try {
			$conn = Connection::getConn();
	
			$atualizar = $conn->prepare(
			  '	UPDATE referencia
			   	SET
					titulo     = ?
					link       = ?
					mistura_id = ?
					resultado  = ?
					comentario = ?
					doi        = ?
				WHERE
					id = ?'
			);
	
			$atualizar->bindValue(1, $ref->getTitulo());
			$atualizar->bindValue(2, $ref->getLink());
			$atualizar->bindValue(3, $ref->getMistura_id());
			$atualizar->bindValue(4, $ref->getResultado());
			$atualizar->bindValue(5, $ref->getComentario());
			$atualizar->bindValue(6, $ref->getDoi());
			$atualizar->bindValue(7, $ref->getId());
	
			$atualizar->execute();
	
			//Verificando a quantidade de linhas que foram alteradas pela query escrita no método "$conn->prepare('*string*');"
			return $atualizar->rowCount() == '0' ? FALSE:TRUE;
	
		  } catch (Exception $e) {
			Connection::showLog($e->getMessage());
		  }
	}*/

	//Função para excluir uma referência pelo id da mesma
	protected static function excluirReferencia ( int $referencia_id ): bool {
		try {
			$conn = Connection::getConn();

			$delete = $conn->prepare(
				'DELETE FROM referencia
				 WHERE id = ?'
			);

			$delete->bindValue(1, $referencia_id);

			$delete->execute();

			return $delete->rowCount() == '0' ? FALSE:TRUE;

		} catch (Exception $e) {
			Connection::showLog($e->getMessage());
		}
	}

}