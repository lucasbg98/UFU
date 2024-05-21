<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  //Imports Necessários ...

  //Models
  require_once(__DIR__ . "/../model/Substancia.php");
  require_once(__DIR__ . "/../model/NomeComercial.php");
  require_once(__DIR__ . "/../model/Classe.php");

  //DAO
  require_once(__DIR__ . "/../dao/SubstanciaDAO.php");
  require_once(__DIR__ . "/../dao/ApelidoDAO.php");
  require_once(__DIR__ . "/../dao/NomeComercialDAO.php");
  require_once(__DIR__ . "/../dao/ClasseDAO.php");

  //Outros
  require_once(__DIR__ . "/../assets/php/Status.php");

  //WebServices:

  //Busca as substâncias ordenadas pelas que mais (ou menos) foram usadas em misturas
  if (array_key_exists("filterByMixtureOccurence", $_GET)) {
    $orderBy = isset($_GET["orderBy"]) ? $_GET["orderBy"] : "qtd";
    $resultadoStatus = isset($_GET["resultStatus"]) ? $_GET["resultStatus"] : null;
    $orderDirection = isset($_GET["orderDirection"]) ? $_GET["orderDirection"] : "desc";

    $options = array("getSubsByMixtureOccurence", $orderBy, $orderDirection, $resultadoStatus);

    $subs = SubstanciaDAO::read($options);

    echo json_encode($subs);
  }

  //Busca todas as substancias bem como seus relacionamentos
  if (array_key_exists("fetchAll", $_GET)) {
    if (!isset($_GET["userId"])) {
      session_start();
      $loggedUserId = $_SESSION["user_id"];
    } else {
      $appUserId =  $_GET["userId"];
    }

    if (!isset($loggedUserId) && !isset($appUserId)) {
      http_response_code(401);
      return json_encode(array("message" => "Usuário sem permissão para acessar o recurso!"));
    }

    $subs = SubstanciaDAO::read(array("fetchAll"));

    if ($subs) {
      $list = Substancia::jsonSerializeList($subs);
      if (isset($list))
        echo json_encode($list, JSON_UNESCAPED_UNICODE);
      else
        echo "Erro";
    }
  }

  //Verifica se uma substância esta presente em pelo menos uma mistura
  if (array_key_exists("count_usability", $_GET)) {

    //Pegando id da substancia
    $subs_id = $_GET["subs_id"];

    try {

      //Método que busca os ids das misturas que contem a substancia com id "$subs_id"
      $ids = SubstanciaDAO::read(array("mist_id", $subs_id));

      echo json_encode($ids, JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //Exclui uma substância e seus relacionamentos a partir do id da mesma
  if (array_key_exists("delete", $_GET)) {
    //Pegando o id da substancia
    $subs_id = $_GET["subs_id"];

    try {
      //Criando o objeto substancia que será excluído
      $substancia = SubstanciaDAO::read(array("subs_id", $subs_id, "colunas_e_relacionamentos"));

      //Apagando apelidos
      foreach ($substancia->getApelidos() as $apelido) {
        ApelidoDAO::delete(array($apelido->getId()));
      }

      //Apagando nomes comerciais
      foreach ($substancia->getNomesComerciais() as $nome_comercial) {
        NomeComercialDAO::delete(array($nome_comercial->getId()));
      }

      //Excluindo a substancia propriamente dita
      $res["retorno"] = SubstanciaDAO::delete(array($substancia->getId()));

      echo json_encode($res, JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //Verifica se nome comercial pode ser cadastrado 
  if (array_key_exists("verifyName", $_GET)) {
    $nc_descricao = $_GET["nc_descricao"];

    //Retorna TRUE se o nome já estiver sido cadastrado no banco, portanto deve colocar o sinal "!", para retornar FALSE, indicando que o nome "nc_descricao" não pode ser cadastrado.
    echo json_encode(!NomeComercialDAO::read(array("checkAvaiable", $nc_descricao)));
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  try {
    //Imports necessários ...
    require_once(__DIR__ . "/../model/Substancia.php");
    require_once(__DIR__ . "/../model/NomeComercial.php");
    require_once(__DIR__ . "/../model/Apelido.php");

    //DAO
    require_once(__DIR__ . "/../dao/SubstanciaDAO.php");
    require_once(__DIR__ . "/../dao/NomeComercialDAO.php");
    require_once(__DIR__ . "/../dao/ApelidoDAO.php");

    //Outros
    require_once(__DIR__ . "/../assets/php/Status.php");

    //Pegando parametros POST ...

    //Obrigatórios
    $principio_ativo = filter_input(INPUT_POST, "principio_ativo", FILTER_SANITIZE_STRING);
    $classe_id = filter_input(INPUT_POST, "classe_id", FILTER_SANITIZE_NUMBER_INT);
    $nomes_comerciais = isset($_POST["nomes_comerciais"]) ? $_POST["nomes_comerciais"] : FALSE;

    //Opcionais
    $apelidos = isset($_POST["apelidos"]) ? $_POST["apelidos"] : FALSE;

    //Verificando se os parâmetros estão "ok"
    if ($principio_ativo && $classe_id && $nomes_comerciais) {

      //Criando o objeto substancia para salvá-lo no banco
      $nova_substancia = new Substancia();

      //Atribuindo valores
      $nova_substancia->setPrincipioAtivo($principio_ativo);
      $nova_substancia->setClasse_id($classe_id);

      //Inserindo subs no banco, este método retorna o id da nova substância inserida ou FALSE em situação de erro
      $nova_substancia_id = SubstanciaDAO::create(array($nova_substancia));

      if ($nova_substancia_id) {
        //Colocando o id da nova substancia
        $nova_substancia->setId($nova_substancia_id);

        //Criando array para mapear erros nos processos de salvar nomes comerciais e apelidos
        $erros = array();
        $erros["nomes_comerciais"] = array();
        $erros["apelidos"] = array();

        //Tratando os nomes comerciais, cada posição deste array é a descrição de um novo nome comercial
        if ($nomes_comerciais) {
          foreach ($nomes_comerciais as $nc_descricao) {
            //Criando o objeto nome comercial
            $novo_nc = new NomeComercial();
            $novo_nc->setSubstanciaId($nova_substancia->getId()); //pegando id da nova substancia
            $novo_nc->setDescricao($nc_descricao);

            if (!NomeComercialDAO::create(array($novo_nc))) { //verificando se deu erro
              array_push($erros["nomes_comerciais"], $nc_descricao);
            }
          }
        }

        //Tratando os apelidos da substancia (princípios ativos), cada posição do array é a descrição de um apelido
        if ($apelidos) {
          foreach ($apelidos as $ap_descricao) {
            //Criando o objeto apelido
            $novo_ap = new Apelido();
            $novo_ap->setSubstanciaId($nova_substancia->getId());
            $novo_ap->setDescricao($ap_descricao);

            if (!ApelidoDAO::create(array($novo_ap))) { // verificando se deu erro
              array_push($erros["apelidos"], $ap_descricao);
            }
          }
        }

        //Montando array de retorno
        if (empty($erros["nomes_comerciais"]) && empty($erros["apelidos"])) { //verificando se aconteceu algum erro
          $res["retorno"] = Status::Cadastro_Sucesso;
        } else {
          $res["retorno"] = 0;
          $res["erros"] = $erros;
        }
      } else {
        //Tratamento em caso de falha para salvar no banco
        $res["retorno"] = Status::Cadastro_Erro_No_Banco_De_Dados;
      }
    } else {
      //Tratamento em caso de parâmetros errados
      $res["retorno"] = Status::Wrong_Parameters;
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  } finally {
    //enviando json contendo resultado da operação
    if ($res)
      echo json_encode($res, JSON_UNESCAPED_UNICODE);
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents('php://input'), $_DELETE);

  if (array_key_exists("deleteSub", $_DELETE)) {
    require_once(__DIR__ . "/../dao/SubstanciaDAO.php");
    require_once(__DIR__ . "/../dao/ApelidoDAO.php");
    require_once(__DIR__ . "/../dao/NomeComercialDAO.php");
    require_once(__DIR__ . "/../dao/MisturaDAO.php");

    $res_id = $_DELETE["deleteSub"];
    $numberOfMixturesThatUsesSubstance = MisturaDAO::read(
      array("verifyMixtureThatUsesSubstance", $res_id)
    );
    if ($numberOfMixturesThatUsesSubstance > 0) {
      echo json_encode(array("result" => false));
      return;
    }

    ApelidoDAO::delete(array($res_id));
    NomeComercialDAO::delete(array($res_id));
    SubstanciaDAO::delete(array($res_id));

    echo json_encode(array("result" => true));
  }
}
