<?php 

header('Content-Type: application/json; charset=utf-8');

require_once (__DIR__."/../model/Parceria.php");
require_once (__DIR__."/../dao/ParceriaDAO.php");
require_once (__DIR__."/../data-contract/ParceriaDC.php");
require_once (__DIR__."/../assets/php/LogoUpload.php");

if($_SERVER["REQUEST_METHOD"] === "GET") {
  if(array_key_exists("getAll", $_GET)) {
    $parcerias = ParceriaDAO::read(array("readAll"));

    $parcerias_dc = array();
      foreach($parcerias as $key => $p) {
        array_push($parcerias_dc, new ParceriaDC($p));
    }
    
    echo json_encode($parcerias_dc, JSON_UNESCAPED_SLASHES);
  }

  if(array_key_exists("getOne", $_GET)) {
    $id = $_GET["getOne"];
    $parceria = ParceriaDAO::read(array("getOne", $id));
    $parceria_dc = new ParceriaDC($parceria);

    echo json_encode($parceria_dc);
  }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {

  if(array_key_exists("update", $_POST)) {
    $id = (int) $_POST["id"];
    $nome = $_POST["nome"];
    $string_periodo_inicial = $_POST["periodo_inicial"];
    $string_periodo_final = isset($_POST["periodo_final"]) ? $_POST["periodo_final"] : null;
    $link = isset($_POST["link"]) ? $_POST["link"] : null;

    $periodo_inicial = implode("-", array_reverse(explode("/", $string_periodo_inicial)));
    $periodo_final = $string_periodo_final !== null
      ? implode("-", array_reverse(explode("/", $string_periodo_final)))
      : null;

    $p = new Parceria();
    $p->setId($id);
    $p->setNome($nome);
    $p->setPeriodoInicial($periodo_inicial);
    $p->setPeriodoFinal($periodo_final);
    $p->setLink($link);

    $parceria = ParceriaDAO::read(array("getOne", $id));
    if($_FILES["logo"]) {
      LogoUpload::deleteLogo($parceria->getLogoUrl());
      $res = LogoUpload::uploadLogo($_FILES["logo"]);
      if(!$res["ok"]) {
        echo json_encode($res);
        return;
      }
      else {
        $p->setLogoUrl($res["fileName"]);
      }
    }
    else {
      $p->setLogoUrl($parceria->getLogoUrl());
    }

    $aux = ParceriaDAO::update(array("updatePartnership", $p));

    echo json_encode(array(
      "ok" => $aux,
      "msg" => $aux ? "Parceria atualizada com sucesso!" : "Erro ao atualizar parceria! (internal)"
    ));
  }

  if(array_key_exists("save", $_POST)) {
    $res = LogoUpload::uploadLogo($_FILES["logo"]);
    if(!$res["ok"]) {
      echo json_encode($res);
      return;
    }
  
    $nome = $_POST["nome"];
    $logo_url = $res["fileName"];
    $string_periodo_inicial = $_POST["periodo_inicial"];
    $string_periodo_final = isset($_POST["periodo_final"]) ? $_POST["periodo_final"] : null;
    $link = isset($_POST["link"]) ? $_POST["link"] : null;
  
    $periodo_inicial = implode("-", array_reverse(explode("/", $string_periodo_inicial)));
    $periodo_final = $string_periodo_final !== null
      ? implode("-", array_reverse(explode("/", $string_periodo_final)))
      : null;
  
    $np = new Parceria();
    $np->setNome($nome);
    $np->setLogoUrl($logo_url);
    $np->setPeriodoInicial($periodo_inicial);
    $np->setPeriodoFinal($periodo_final);
    $np->setLink($link);
  
    $res["ok"] = ParceriaDAO::create(array($np));
    
    if($res["ok"]) {
      http_response_code(200);
      $res["msg"] = "Parceria criada com sucesso!";
    }
    else {
      http_response_code(400);
      $res["msg"] = "Falha ao criar parceria!";
    }
    
    echo json_encode($res);
    return;
  }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents('php://input'), $_DELETE);
  
  if(array_key_exists("deleteId", $_DELETE)) {
    require_once (__DIR__."/../dao/ParceriaDAO.php");

    $p_id = $_DELETE["deleteId"];
    $parceria = ParceriaDAO::read(array("getOne", $p_id));
    $path = __DIR__ ."/../temp/img/" .$parceria->getLogoUrl();
    
    unlink($path);
    $p_delete = ParceriaDAO::delete(array("deleteById", $p_id));

    if($p_delete)
      echo json_encode(array("ok"=> true));
    else
      echo json_encode(array("ok"=> false));
  }
}