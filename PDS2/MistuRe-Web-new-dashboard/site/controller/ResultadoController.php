<?php

require_once(__DIR__ . "/../model/Log.php");
require_once(__DIR__ . "/../model/Resultado.php");
require_once(__DIR__ . "/../model/Referencia.php");
require_once(__DIR__ . "/../model/Mistura.php");
require_once(__DIR__ . "/../dao/ReferenciaDAO.php");
require_once(__DIR__ . "/../dao/LogDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/AppUserDAO.php");
require_once(__DIR__ . "/../dao/ResultadoDAO.php");
require_once(__DIR__ . "/../dao/MisturaDAO.php");
require_once(__DIR__ . "/../data-contract/ResultadoDC.php");
require_once(__DIR__ . "/../assets/php/Utils.php");
require_once(__DIR__ . "/../assets/php/Status.php");


if ($_SERVER["REQUEST_METHOD"] === "GET") {
  if (array_key_exists("filter", $_GET)) {
    if (!isset($_GET["userId"])) {
      session_start();

      if (!isset($_SESSION) || !isset($_SESSION["user_id"])) {
        http_response_code(401);
        echo json_encode(array("message" => "Usuário sem permissão para acessar o recurso!"), JSON_UNESCAPED_UNICODE);
        return;
      }

      $loggedUser = UsuarioDAO::read(array("user_id", $_SESSION["user_id"]));

      if (!isset($loggedUser)) {
        http_response_code(401);
        echo json_encode(array("message" => "Usuário sem permissão para acessar o recurso!"), JSON_UNESCAPED_UNICODE);
        return;
      }
    } else {
      $appUser = AppUserDAO::read(array("getById", $_GET["userId"]));

      if (!isset($appUser)) {
        http_response_code(401);
        echo json_encode(array("message" => "Usuário sem permissão para acessar o recurso!"), JSON_UNESCAPED_UNICODE);
        return;
      }
    }

    $filter = [];
    if (isset($_GET["subs"])) {
      $subs = json_decode($_GET["subs"], true);
      $subs_ordered = array();

      foreach ($subs as $key => $row) {
        $subs_ordered[$key] = $row['sub_id'];
      }

      array_multisort($subs_ordered, SORT_ASC, $subs);

      $filter["subs"] = $subs;
    } else
      $filter["subs"] = null;

    $filter["avaliador"] = isset($_GET["avaliador"]) ? $_GET["avaliador"] : null;
    $filter["pesquisador"] = isset($_GET["pesquisador"]) ? $_GET["pesquisador"] : null;
    $filter["link"] = isset($_GET["link"]) ? $_GET["link"] : null;
    $filter["status"] = isset($_GET["status"]) ? $_GET["status"] : null;

    $resultados = ResultadoDAO::read(array("filter", $filter));
    $resultados_dc = array();
    $resultados_ids = array();

    foreach ($resultados as $key => $res) {
      $novo_resultado_dc = new ResultadoDC($res);
      array_push($resultados_dc, $novo_resultado_dc);
      array_push($resultados_ids, $novo_resultado_dc->id);
    }

    if (isset($appUser)) {
      $log = new Log();
      $log->setUserId($appUser->getId());
      $log->setResponse(json_encode($resultados_ids));
      $log->setRequest(json_encode(array_filter($filter)));

      $res = LogDAO::create($log);
    }

    echo json_encode($resultados_dc, JSON_UNESCAPED_UNICODE);
  }

  if (array_key_exists("firstOnes", $_GET)) {
    require_once(__DIR__ . "/../dao/ResultadoDAO.php");
    require_once(__DIR__ . "/../data-contract/ResultadoDC.php");

    $quantidade_pendentes = (int) $_GET["firstOnes"];
    $resultados_pendentes = ResultadoDAO::read(array(
      "status",
      Resultado::converterStringParaStatus("pendente"),
      "data_cadastro ASC",
      $quantidade_pendentes
    ));

    $quantidade_aprovadas = isset($resultados_pendentes)
      ? $quantidade_pendentes - sizeof($resultados_pendentes)
      : $quantidade_pendentes;
    $resultados_aprovados = ResultadoDAO::read(array(
      "status",
      Resultado::converterStringParaStatus("aprovado"),
      "data_avaliacao DESC",
      $quantidade_aprovadas
    ));

    if (empty($resultados_pendentes) && empty($resultados_aprovados))
      echo "[]";
    else {
      $resultados_pendentes = isset($resultados_pendentes)
        ? $resultados_pendentes
        : array();
      $resultados_aprovados = isset($resultados_aprovados)
        ? $resultados_aprovados
        : array();

      $resultados = array_merge($resultados_pendentes, $resultados_aprovados);
      $resultados_dc = array();

      foreach ($resultados as $key => $res)
        array_push($resultados_dc, new ResultadoDC($res));

      echo json_encode($resultados_dc);
    }
  }

  if (array_key_exists("getOne", $_GET)) {
    require_once(__DIR__ . "/../dao/ResultadoDAO.php");
    require_once(__DIR__ . "/../data-contract/ResultadoCompletoDC.php");


    $res_id = (int) $_GET["getOne"];
    $resultado = ResultadoDAO::read(array("findById", $res_id));
    if ($resultado) {
      $resultadoDC = new ResultadoCompletoDC($resultado);
      echo json_encode($resultadoDC);
    } else
      echo "{}";
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
    $user = (new Utils())->getLoggedUser();
    if (!$user) return;

    $user_perfil = strtolower($user->getPerfil()->getDescricao());

    $ref_id =  $_POST["ref_id"];
    $link = $_POST["link"];
    $titulo = $_POST["titulo"];
    $pais = $_POST["pais"];
    $substancias_selecionadas = $_POST["substancias_selecionadas"];
    $cultura = $_POST["cultura"];
    $resultado = $_POST["resultado"];
    $comentario = $_POST["comentario"];

    $novo_resultado = new Resultado();
    if ($ref_id == null) {
      // Criando referencia
      $nova_referencia = new Referencia();
      $nova_referencia->setLink($link);
      $nova_referencia->setTitulo($titulo);
      $nova_referencia->setPais($pais);
      $ref_id = ReferenciaDAO::create(array($nova_referencia));
    }

    $novo_resultado->setDataCadastro(new DateTime());
    $novo_resultado->setResultado($resultado);
    $novo_resultado->setStatus(
      $user_perfil === "administrador" || $user_perfil === "avaliador"
        ? Status::Resultado_Status_Aprovada
        : Status::Resultado_Status_Pendente
    );
    $novo_resultado->setPesquisadorId($user->getId());
    $novo_resultado->setCulturaId($cultura);
    $novo_resultado->setReferenciaId($ref_id);
    $novo_resultado->setAvaliadorId(
      $user_perfil === "administrador" || $user_perfil === "avaliador"
        ? $user->getId()
        : null
    );
    $novo_resultado->setDataAvaliacao(
      $user_perfil === "administrador" || $user_perfil === "avaliador"
        ? $novo_resultado->getDataCadastro()
        : null
    );
    $novo_resultado->setComentario($comentario);

    $res_id = ResultadoDAO::create(array($novo_resultado));

    foreach ($substancias_selecionadas as $index => $sub) {
      $nova_mistura = new Mistura();
      $nova_mistura->setResultadoId($res_id);
      $nova_mistura->setSubstanciaId((int) $sub["value"]);
      $nova_mistura->setDosagemSubstancia((float) $sub["subDos"]);
      if (isset($sub["ncId"])) {
        $nova_mistura->setDosagemComercial((float) $sub["ncDos"]);
        $nova_mistura->setNomeComercialId((int) $sub["ncId"]);
      }
      MisturaDAO::create(array($nova_mistura));
    }
    echo json_encode(array("msg" => "Resultado cadastrado com êxito!"));
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  parse_str(file_get_contents('php://input'), $_PUT);

  if (array_key_exists("changeStatusTo", $_PUT)) {
    require_once(__DIR__ . '../../dao/ResultadoDAO.php');
    require_once(__DIR__ . '../../assets/php/Status.php');

    session_start();

    $user_id = $_SESSION["user_id"];
    $resultadoId = $_PUT["resultadoId"];
    $newStatus = $_PUT["changeStatusTo"];

    $res = ResultadoDAO::update(array("atualizarStatus", $resultadoId, $newStatus, $user_id));

    echo json_encode(array("res" => $res));
  }

  if (array_key_exists("evaluateReference", $_PUT)) {
    require_once(__DIR__ . '../../dao/ResultadoDAO.php');
    require_once(__DIR__ . '../../assets/php/Status.php');

    session_start();

    $user_id = $_SESSION["user_id"];
    $res_id = $_PUT["evaluateReference"];
    $status = $_PUT["status"] == "aprovar"
      ? Status::Resultado_Status_Aprovada
      : Status::Resultado_Status_Rejeitada;

    $res = ResultadoDAO::update(array("avaliarReferencia", $res_id, $status, $user_id));

    echo json_encode(array("res" => $res));
  }

  if (array_key_exists("update", $_PUT)) {
    $id = (int) $_PUT["id"];

    $referenciaId = $_PUT["referenciaId"] ?? false;
    $link = $_PUT["link"];
    $titulo = $_PUT["titulo"] ?? null;
    $pais = $_PUT["pais"];

    $culturaId = (int) $_PUT["culturaId"];
    $efeitoResultante = (int) $_PUT["resultado"];
    $pesquisadorId = (int) $_PUT["pesquisadorId"];
    $avaliadorId = isset($_PUT["avaliadorId"]) ? (int) $_PUT["avaliadorId"] : null;
    $comentario = isset($_PUT["comentario"]) ? $_PUT["comentario"] : null;
    $substancias_selecionadas = $_PUT["substancias_selecionadas"];

    $referencia = new Referencia();
    $referencia->setLink($link);
    $referencia->setTitulo($titulo);
    $referencia->setPais($pais);

    $resultado = new Resultado();
    $resultado->setId($id);
    $resultado->setCulturaId($culturaId);
    $resultado->setResultado($efeitoResultante);
    $resultado->setPesquisadorId($pesquisadorId);
    $resultado->setAvaliadorId($avaliadorId);
    $resultado->setComentario($comentario);

    if ($referenciaId) {
      $resultado->setReferenciaId($referenciaId);
      $referencia->setId($referenciaId);
      $res1 = ReferenciaDAO::update(array("update", $referencia));
    } else {
      $referencia->setId(ReferenciaDAO::create(array($referencia)));
      $resultado->setReferenciaId($referencia->getId());
      $res1 = true;
    }

    $res2 = ResultadoDAO::update(array("atualizarResultado", $resultado));

    // removing all subs and recreating them
    MisturaDAO::delete(array("deleteByResultId", $resultado->getId()));

    foreach ($substancias_selecionadas as $index => $sub) {
      $nova_mistura = new Mistura();
      $nova_mistura->setResultadoId($resultado->getId());
      $nova_mistura->setSubstanciaId((int) $sub["value"]);
      $nova_mistura->setDosagemSubstancia((float) $sub["subDos"]);

      $nova_mistura->setNomeComercialId(isset($sub["ncId"]) && (bool)$sub["ncId"] ? (int) $sub["ncId"] : null);
      $nova_mistura->setDosagemComercial(isset($sub["ncDos"]) && (bool)$sub["ncDos"] ? (float) $sub["ncDos"] : null);

      MisturaDAO::create(array($nova_mistura));
    }

    echo $res1 && $res2
      ? json_encode(array("msg" => "Resultado atualizado com sucesso!", "result" => $res1 && $res2))
      : json_encode(array("msg" => "Erro inesperado! Tente novamente!", "result" => $res1 && $res2));
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents('php://input'), $_DELETE);

  if (array_key_exists("deleteResult", $_DELETE)) {

    $res_id = $_DELETE["deleteResult"];

    $mist_delete = MisturaDAO::delete(array("deleteByResultId", $res_id));
    $res_delete = ResultadoDAO::delete(array($res_id));

    if ($mist_delete && $res_delete)
      echo json_encode(array("result" => true));
    else
      echo json_encode(array("result" => false));
  }
}
