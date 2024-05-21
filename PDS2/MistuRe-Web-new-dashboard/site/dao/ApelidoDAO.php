<?php 

require_once(__DIR__."/Connection.php");
require_once(__DIR__."/CRUD.interface.php");
require_once(__DIR__."/../model/Apelido.php");

class ApelidoDAO implements CRUD {

	 public static function create ( $args ) {
		return self::inserirNovoApelido ( $args[0] );
    }

    public static function read (  $args ) {
			if($args[0] == "subs_id") {
				return self::buscarApelidosPorIdSubstancia($args[1]);
			}
    }
    
    public static function update ( $args ) {
			return self::atualizarApelido ( $args[0] );
    }

    public static function delete ( $args ) {
			return self::excluirApelidoPeloIdDaSubstancia ( $args[0] );
	}

	//Métodos protegidos

	//Função para inserir novo apelido para uma substância já existente
	protected static function inserirNovoApelido ( Apelido $apelido ) {
		try {
			$conn = Connection::getConn();

			$insert = $conn->prepare(
				'INSERT INTO apelido (descricao, substancia_id)
				VALUES ( ? , ? )'
			);

			$insert->bindValue(1,$apelido->getDescricao());
			$insert->bindValue(2,$apelido->getSubstanciaId());

			if($insert->execute()) {
				return $conn->lastInsertId();
			}
			else {
				return False;
			}
		} catch(Exception $e) {
			Connection::showLog($e->getMessage());
		}
	}
	
	//Busca quais são os apelidos da substância com id passado no parâmetro "subs_id"
	protected static function buscarApelidosPorIdSubstancia( int $sub_id ) {
		try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				"SELECT * FROM apelido
				 Where substancia_id = ?
				 ORDER BY apelido.descricao"
			);
			$sql->bindValue(1,$sub_id);

			$sql->execute();
			
			if($sql->rowCount() > 0)
			{
				$apelidos = $sql->fetchAll();
				$res = [];
				foreach($apelidos as $a)
				{
					$res[] = Apelido::withRow($a);
				}
				
				if($res != null)
					return Apelido::jsonSerializeList($res);
				else
					return null;
			}
		} catch(Exception $e) {
		  Connection::showLog($e->getMessage());
		}
	}

	//Função para atualizar as propriedades do apelido de uma substancia
	protected static function atualizarApelido ( Apelido $apelido ) {
		try {
			$conn = Connection::getConn();
	
			$atualizar = $conn->prepare(
			  '	UPDATE apelido
			   	SET
					descricao     = ?
					substancia_id = ?
				WHERE
					id = ?'
					
			);
	
			$atualizar->bindValue(1, $apelido->getDescricao());
			$atualizar->bindValue(2, $apelido->getSubstanciaId());
			$atualizar->bindValue(3, $apelido->getId());
	
			$atualizar->execute();
	
			//Verificando a quantidade de linhas que foram alteradas pela query escrita no método "$conn->prepare('*string*');"
			return $atualizar->rowCount() == '0' ? FALSE:TRUE;
	
		  } catch (Exception $e) {
			Connection::showLog($e->getMessage());
		  }
	}

	//Função para excluir um apelido de substância a partir de seu id
	protected static function excluirApelido ( int $apelido_id ) {
		try {
			$conn = Connection::getConn();
	
			$delete = $conn->prepare(
			  'DELETE FROM apelido
			   WHERE id = ?'
			);
	
			$delete->bindValue(1, $apelido_id);
	
			$delete->execute();
	
			return $delete->rowCount() == '0' ? FALSE:TRUE;
	
		} catch ( Exception $e ) {
			Connection::showLog($e->getMessage());
		}
	}

	protected static function excluirApelidoPeloIdDaSubstancia( int $subs_id ) {
		try {
			$conn = Connection::getConn();
	
			$delete = $conn->prepare(
			  'DELETE FROM apelido
			   WHERE substancia_id = ?'
			);
	
			$delete->bindValue(1, $subs_id);
	
			$delete->execute();
	
			return $delete->rowCount();
	
		} catch ( Exception $e ) {
			Connection::showLog($e->getMessage());
		}
	}
}