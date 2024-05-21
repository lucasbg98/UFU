<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (array_key_exists("filter", $_GET)) {
    require_once(__DIR__ . "/../dao/MisturaDAO.php");
    require_once(__DIR__ . "/../data-contract/ReferenciaDC.php");
    require_once(__DIR__ . "/../data-contract/MisturaMobileDC.php");

    $filter = [];
    if ($_GET["subs"]) {
      $subs = json_decode($_GET["subs"]);
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
    $filter["cultura"] = isset($_GET["cultura"]) ? $_GET["cultura"] : null;
    $filter["pais"] = isset($_GET["pais"]) ? $_GET["pais"] : null;
    $filter["status"] = $_GET["status"];

    $misturas = MisturaDAO::read(array("filter", $filter));
    $misturas_dc = array();

    foreach ($misturas as $key => $ref) {
      $nova_mist_dc = new MisturaMobileDC($ref);
      array_push($misturas_dc, $nova_mist_dc);
    }

    // echo json_encode($misturas_dc);
  }
}
