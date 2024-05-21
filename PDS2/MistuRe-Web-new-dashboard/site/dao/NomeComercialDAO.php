<?php

require_once(__DIR__."/../model/NomeComercial.php");
require_once(__DIR__."/Connection.php");

class NomeComercialDAO implements CRUD {

    public static function create ( $args ) {
        return self::inserirNovoNomeComercial ( $args[0] );
    }

    public static function read ( $args ) {
        if( $args[0] == "checkAvaiable" ) {
            return self::verificarNomeComercialRepetido ( $args[1] );
        }
        else if( $args[0] == "fetchAll" ) {
            return self::buscarTodosNomesComerciais (  );
        }
        else if( $args[0] == "subs_id" ) {
            return self::buscarNomesComerciaisDeSubstancia ( $args[1] );
        }
        else if( $args[0] == "nc_id" ) {
            return self::buscarNomeComercialPorId( $args[1] );
        }
    }

    public static function update ( $args ) {
        return self::atualizarNomeComercial ( $args[0] );
    }

    public static function delete ( $args ) {
        return self::excluirNomeComercialPeloIdDaSubstancia ( $args[0] );
    }

    //Métodos Protegidos

    //Função para criar inserir um novo nome comercial no banco
    protected static function inserirNovoNomeComercial ( NomeComercial $novo_nc ) {
        try {
            $conn = Connection::getConn();

            $insert = $conn->prepare(
                'INSERT INTO nome_comercial (descricao, substancia_id)
                 VALUES ( ?, ? )'
            );

            //atribuindo valores na string sql
            $insert->bindValue(1, $novo_nc->getDescricao());
            $insert->bindValue(2, $novo_nc->getSubstanciaId());

            //Executando a query
            if($insert->execute()) {
				return $conn->lastInsertId();//retornando ultimo id inserido no banco
			}
			else {
				return FALSE;
			}

        } catch ( Exception $e ) {
            Connection::showLog( $e->getMessage() );
        }
    }

    //Função que retorna todos os nomes comerciais
    protected static function buscarTodosNomesComerciais (  ) {
        try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				"SELECT * FROM nome_comercial "
			);

			$sql->execute();
			$apelidos = $sql->fetchAll();

            $res = [];
            foreach($apelidos as $a)
            {
                $res[] = NomeComercial::withRow($a);
            }
            
            if($res != null)
                return NomeComercial::jsonSerializeList($res);
            else
                return null;
                
		} catch(Exception $e) {
		  Connection::showLog($e->getMessage());
		}
    }

    //Função que retorna se o nome comercial passado no parâmetro já está cadastrado no banco de dados, se estiver repetido retorna TRUE
    protected static function verificarNomeComercialRepetido ( String $nc_descricao ) {
        try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				"SELECT * FROM nome_comercial where descricao = ?;"
			);
			$sql->bindValue(1,$nc_descricao);

            $sql->execute();
            return $sql->rowCount() > 0 ? TRUE:FALSE;
                
		} catch(Exception $e) {
		  Connection::showLog($e->getMessage());
		}
    }

    //Função para buscar todos os nomes comerciais de uma substancia a partir do id desta
    protected static function buscarNomesComerciaisDeSubstancia ( int $substancia_id ) {
        try {
			$conn = Connection::getConn();

			$sql = $conn->prepare(
				"SELECT * FROM nome_comercial
                 WHERE substancia_id = ?
                 ORDER BY nome_comercial.descricao ASC"
			);
			$sql->bindValue(1,$substancia_id);

			$sql->execute();
			$nomes = $sql->fetchAll();

            $res = [];
            foreach($nomes as $n)
            {
                array_push($res, NomeComercial::withRow($n));
            }
            
            if($res != null)
                return NomeComercial::jsonSerializeList($res);
            else
                return null;
                
		} catch(Exception $e) {
		  Connection::showLog($e->getMessage());
		}
    }

    protected static function buscarNomeComercialPorId( int $id ) {
        try {
			$conn = Connection::getConn();
			
			$sql = $sql = $conn->prepare(
				"SELECT * FROM nome_comercial
				 WHERE id = ?"
			);
			$sql->bindValue(1,$id);
			
			$sql->execute();
			
            $resultado = $sql->fetch();//Pegando apenas 1 linha
            return NomeComercial::withRow( $resultado );

		} catch(Exception $e) {
			Connection::showLog($e->getMessage());
		}
    }

    //Função para atualizar os dados de um nome comercial
    protected static function atualizarNomeComercial ( NomeComercial $nc) {
        try {
			$conn = Connection::getConn();
	
			$atualizar = $conn->prepare(
			  ' UPDATE nome_comercial
				SET 
				  descricao     = ?
				  substancia_id = ?
				WHERE
				  id = ?'
			);
	
			$atualizar->bindValue(1, $nc->getDescricao());
			$atualizar->bindValue(2, $nc->getSubstanciaId());
			$atualizar->bindValue(3, $nc->getId());
	
			$atualizar->execute();
	
			//Verificando a quantidade de linhas que foram alteradas pela query escrita no método "$conn->prepare('*string*');"
			return $atualizar->rowCount() == '0' ? FALSE:TRUE;
	
		  } catch (Exception $e) {
			Connection::showLog($e->getMessage());
		  }
    }

    //Função para excluir um nome comercial pelo seu id
    protected static function excluirNomeComercialPeloIdDaSubstancia (int $sub_id) {
        try {
			$conn = Connection::getConn();
	
			$delete = $conn->prepare(
			  'DELETE FROM nome_comercial
			   WHERE substancia_id = ?'
			);
	
			$delete->bindValue(1, $sub_id);
	
			$delete->execute();
	
			return $delete->rowCount() == '0';
	
		} catch ( Exception $e ) {
		    Connection::showLog($e->getMessage());
		}
    }

}